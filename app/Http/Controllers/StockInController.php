<?php
namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\Product;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index()
    {
        $stockIns = StockIn::with(['product', 'user'])->get();
        return view('stock_ins.index', compact('stockIns'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock_ins.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        $stockIn = StockIn::create($validated);
        // Increase product quantity
        $product = Product::findOrFail($validated['product_id']);
        $product->quantity += $validated['quantity'];
        $product->save();
        return redirect()->route('stock-ins.index')->with('success', 'Stock in recorded successfully!');
    }
}
