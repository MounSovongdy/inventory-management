<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function productReport()
    {
        $products = Product::with(['category', 'supplier'])
            ->withSum('stockIns as total_stock_in', 'quantity')
            ->withSum('stockOuts as total_stock_out', 'quantity')
            ->get();

        return view('reports.products', compact('products'));
    }

    public function stockInReport()
    {
        $stockIns = StockIn::with(['product.category', 'product.supplier', 'user'])->get();

        return view('reports.stock_ins', compact('stockIns'));
    }

    public function stockOutReport()
    {
        $stockOuts = StockOut::with(['product.category', 'product.supplier', 'user'])->get();

        return view('reports.stock_outs', compact('stockOuts'));
    }
}
