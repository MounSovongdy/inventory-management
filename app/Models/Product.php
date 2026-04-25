<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code', 'name', 'category_id', 'supplier_id', 'quantity', 'unit_price', 'description'
    ];

    public static function generateProductCode(): string
    {
        $lastNumber = static::query()
            ->where('product_code', 'like', 'PRD-%')
            ->pluck('product_code')
            ->map(function (string $code): int {
                return preg_match('/^PRD-(\d+)$/', $code, $matches) ? (int) $matches[1] : 0;
            })
            ->max() ?? 0;

        do {
            $lastNumber++;
            $code = 'PRD-' . str_pad((string) $lastNumber, 6, '0', STR_PAD_LEFT);
        } while (static::where('product_code', $code)->exists());

        return $code;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stockIns()
    {
        return $this->hasMany(StockIn::class);
    }

    public function stockOuts()
    {
        return $this->hasMany(StockOut::class);
    }
}
