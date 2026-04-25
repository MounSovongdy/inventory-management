<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);
    Route::resource('stock-ins', StockInController::class)->only(['index', 'create', 'store']);
    Route::resource('stock-outs', StockOutController::class)->only(['index', 'create', 'store']);
    Route::resource('users', UserController::class)->except(['show']);
    // Reports
    Route::get('/reports/products', [ReportController::class, 'productReport'])->name('reports.products');
    Route::get('/reports/stock-ins', [ReportController::class, 'stockInReport'])->name('reports.stock_ins');
    Route::get('/reports/stock-outs', [ReportController::class, 'stockOutReport'])->name('reports.stock_outs');
});
