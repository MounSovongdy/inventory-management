@extends('layouts.app')
@section('title', 'Products | Inventory Management System')
@section('page-title', 'Products')
@section('page-subtitle', 'Track product codes, suppliers, pricing, and live inventory quantities in one table.')
@section('content')
<div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-950">Product List</h2>
            <p class="mt-1 text-sm text-slate-500">{{ number_format($products->count()) }} products available.</p>
        </div>
        <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center gap-2 rounded bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
            </svg>
            Add Product
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="whitespace-nowrap px-5 py-3">#</th>
                    <th class="whitespace-nowrap px-5 py-3">Code</th>
                    <th class="whitespace-nowrap px-5 py-3">Name</th>
                    <th class="whitespace-nowrap px-5 py-3">Category</th>
                    <th class="whitespace-nowrap px-5 py-3">Supplier</th>
                    <th class="whitespace-nowrap px-5 py-3">Quantity</th>
                    <th class="whitespace-nowrap px-5 py-3">Unit Price</th>
                    <th class="whitespace-nowrap px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($products as $product)
                    <tr class="transition hover:bg-slate-50">
                        <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-500">{{ $loop->iteration }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="rounded bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-700">{{ $product->product_code }}</span>
                        </td>
                        <td class="min-w-48 px-5 py-4">
                            <p class="font-semibold text-slate-950">{{ $product->name }}</p>
                            @if($product->description)
                                <p class="mt-1 max-w-xs truncate text-xs text-slate-500">{{ $product->description }}</p>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $product->category?->name ?? '-' }}</td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $product->supplier?->name ?? '-' }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            @php
                                $stockClass = $product->quantity > 10
                                    ? 'bg-emerald-50 text-emerald-700 ring-emerald-200'
                                    : ($product->quantity > 0 ? 'bg-amber-50 text-amber-700 ring-amber-200' : 'bg-red-50 text-red-700 ring-red-200');
                            @endphp
                            <span class="inline-flex rounded px-2.5 py-1 text-xs font-bold ring-1 {{ $stockClass }}">
                                {{ number_format($product->quantity) }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 font-semibold text-slate-700">${{ number_format($product->unit_price, 2) }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center justify-center rounded border border-slate-200 px-3 py-1.5 text-xs font-bold text-slate-700 transition hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700">
                                    Edit
                                </a>
                                <form
                                    action="{{ route('products.destroy', $product) }}"
                                    method="POST"
                                    @submit.prevent="confirmDelete($event.target, 'Delete product?', {{ Illuminate\Support\Js::from('Are you sure you want to delete ' . $product->name . '? This action cannot be undone.') }})"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center rounded border border-red-200 px-3 py-1.5 text-xs font-bold text-red-700 transition hover:bg-red-50">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-5 py-12 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded bg-slate-100 text-slate-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 8.25-9-5.25-9 5.25 9 5.25 9-5.25Zm0 0v7.5l-9 5.25-9-5.25v-7.5" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-base font-bold text-slate-950">No products yet</h3>
                            <p class="mt-1 text-sm text-slate-500">Add your first product to start tracking inventory.</p>
                            <a href="{{ route('products.create') }}" class="mt-4 inline-flex items-center justify-center rounded bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                                Add Product
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
