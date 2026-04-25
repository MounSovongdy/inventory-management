@extends('layouts.app')
@section('content')
<h1 class="text-xl font-bold mb-4">Add Stock In</h1>
<form method="POST" action="{{ route('stock-ins.store') }}" class="bg-white p-6 rounded shadow max-w-md mx-auto">
    @csrf
    <div class="mb-4">
        <label class="block mb-1">Product</label>
        <select name="product_id" class="w-full border rounded px-3 py-2" required>
            <option value="">Select Product</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Quantity</label>
        <input type="number" name="quantity" class="w-full border rounded px-3 py-2" min="1" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Date</label>
        <input type="date" name="date" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Note</label>
        <input type="text" name="note" class="w-full border rounded px-3 py-2">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
    <a href="{{ route('stock-ins.index') }}" class="ml-2 text-gray-600">Cancel</a>
</form>
@endsection
