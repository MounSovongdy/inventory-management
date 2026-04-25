<?php
namespace App\Http\Controllers;

use App\Models\StockOut;
use App\Models\Product;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = StockOut::with(['product', 'user'])->get();
        return view('stock_outs.index', compact('stockOuts'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock_outs.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        if ($product->quantity < $validated['quantity']) {
            return redirect()->back()->withErrors(['quantity' => 'Not enough stock!']);
        }

        $validated['user_id'] = auth()->id();

        $stockOut = StockOut::create($validated);
        // Decrease product quantity
        $product->quantity -= $validated['quantity'];
        $product->save();
        return redirect()->route('stock-outs.index')->with('success', 'Stock out recorded successfully!');
    }
}
