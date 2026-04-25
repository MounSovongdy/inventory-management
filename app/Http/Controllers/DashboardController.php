<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $currentStock = Product::sum('quantity');
        return view('dashboard', compact('totalProducts', 'totalCategories', 'totalSuppliers', 'currentStock'));
    }
}
