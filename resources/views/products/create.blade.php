@extends('layouts.app')
@section('content')
@php
    $inputClass = 'mt-2 block w-full rounded border-stone-300 bg-white px-3 py-2.5 text-sm text-stone-900 shadow-sm focus:border-stone-500 focus:ring-stone-500';
    $labelClass = 'block text-sm font-semibold text-stone-800';
@endphp

<div class="mx-auto max-w-4xl">
    <div class="mb-6 flex flex-col gap-3 border-b border-stone-200 pb-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-medium uppercase tracking-wide text-stone-500">Products</p>
            <h1 class="mt-1 text-2xl font-bold text-stone-950">Add Product</h1>
        </div>
        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded border border-stone-300 bg-white px-4 py-2 text-sm font-semibold text-stone-700 shadow-sm transition hover:border-stone-900 hover:text-stone-950">
            Back to List
        </a>
    </div>

    <form method="POST" action="{{ route('products.store') }}" class="overflow-hidden rounded border border-stone-200 bg-white shadow-sm">
        @csrf

        <div class="border-b border-stone-200 bg-stone-100 px-6 py-4">
            <h2 class="text-base font-semibold text-stone-950">Product Information</h2>
            <p class="mt-1 text-sm text-stone-600">Enter the product details used for inventory and reports.</p>
        </div>

        <div class="grid gap-6 p-6 md:grid-cols-2">
            <div>
                <label for="product_code" class="{{ $labelClass }}">Product Code</label>
                <input id="product_code" type="text" value="{{ $productCode }}" class="{{ $inputClass }} bg-stone-100 text-stone-600" readonly>
                <p class="mt-2 text-xs text-stone-500">Generated automatically when you save.</p>
            </div>

            <div>
                <label for="name" class="{{ $labelClass }}">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" class="{{ $inputClass }}" required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="{{ $labelClass }}">Category</label>
                <select id="category_id" name="category_id" class="{{ $inputClass }}" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="supplier_id" class="{{ $labelClass }}">Supplier</label>
                <select id="supplier_id" name="supplier_id" class="{{ $inputClass }}" required>
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" @selected(old('supplier_id') == $supplier->id)>{{ $supplier->name }}</option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="quantity" class="{{ $labelClass }}">Quantity</label>
                <input id="quantity" type="number" name="quantity" value="{{ old('quantity') }}" class="{{ $inputClass }}" min="0" required>
                @error('quantity')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="unit_price" class="{{ $labelClass }}">Unit Price</label>
                <div class="relative mt-2">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-sm font-semibold text-slate-500">$</span>
                    <input id="unit_price" type="number" name="unit_price" value="{{ old('unit_price') }}" class="block w-full rounded border-stone-300 bg-white px-3 py-2.5 pl-8 text-sm text-stone-900 shadow-sm focus:border-stone-500 focus:ring-stone-500" min="0" step="0.01" required>
                </div>
                @error('unit_price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description" class="{{ $labelClass }}">Description</label>
                <textarea id="description" name="description" rows="4" class="{{ $inputClass }}">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 border-t border-stone-200 bg-stone-50 px-6 py-4 sm:flex-row sm:justify-end">
            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded border border-stone-300 bg-white px-5 py-2.5 text-sm font-semibold text-stone-700 transition hover:border-stone-900 hover:text-stone-950">
                Cancel
            </a>
            <button type="submit" class="inline-flex items-center justify-center rounded bg-stone-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-stone-700">
                Save Product
            </button>
        </div>
    </form>
</div>
@endsection
