@extends('layouts.app')
@section('content')
<h1 class="text-xl font-bold mb-4">Edit Product</h1>
<form method="POST" action="{{ route('products.update', $product) }}" class="bg-white p-6 rounded shadow max-w-md mx-auto">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block mb-1">Product Code</label>
        <input type="text" value="{{ $product->product_code }}" class="w-full rounded border bg-gray-100 px-3 py-2 text-gray-700" readonly>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Name</label>
        <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Category</label>
        <select name="category_id" class="w-full border rounded px-3 py-2" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Supplier</label>
        <select name="supplier_id" class="w-full border rounded px-3 py-2" required>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" @if($product->supplier_id == $supplier->id) selected @endif>{{ $supplier->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Quantity</label>
        <input type="number" name="quantity" value="{{ $product->quantity }}" class="w-full border rounded px-3 py-2" min="0" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Unit Price</label>
        <div class="relative">
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-sm font-semibold text-gray-500">$</span>
            <input type="number" name="unit_price" value="{{ $product->unit_price }}" class="w-full rounded border py-2 pl-8 pr-3" min="0" step="0.01" required>
        </div>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Description</label>
        <textarea name="description" class="w-full border rounded px-3 py-2">{{ $product->description }}</textarea>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    <a href="{{ route('products.index') }}" class="ml-2 text-gray-600">Cancel</a>
</form>
@endsection
