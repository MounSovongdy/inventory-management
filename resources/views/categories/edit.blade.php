@extends('layouts.app')
@section('content')
<h1 class="text-xl font-bold mb-4">Edit Category</h1>
<form method="POST" action="{{ route('categories.update', $category) }}" class="bg-white p-6 rounded shadow max-w-md mx-auto">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block mb-1">Name</label>
        <input type="text" name="name" value="{{ $category->name }}" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Description</label>
        <textarea name="description" class="w-full border rounded px-3 py-2">{{ $category->description }}</textarea>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    <a href="{{ route('categories.index') }}" class="ml-2 text-gray-600">Cancel</a>
</form>
@endsection
