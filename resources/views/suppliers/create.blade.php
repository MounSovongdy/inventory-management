@extends('layouts.app')
@section('content')
<h1 class="text-xl font-bold mb-4">Add Supplier</h1>
<form method="POST" action="{{ route('suppliers.store') }}" class="bg-white p-6 rounded shadow max-w-md mx-auto">
    @csrf
    <div class="mb-4">
        <label class="block mb-1">Name</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Phone</label>
        <input type="text" name="phone" class="w-full border rounded px-3 py-2">
    </div>
    <div class="mb-4">
        <label class="block mb-1">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-2">
    </div>
    <div class="mb-4">
        <label class="block mb-1">Address</label>
        <input type="text" name="address" class="w-full border rounded px-3 py-2">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
    <a href="{{ route('suppliers.index') }}" class="ml-2 text-gray-600">Cancel</a>
</form>
@endsection
