@extends('layouts.app')
@section('title', 'Product Report | Inventory Management System')
@section('page-title', 'Product Report')
@section('page-subtitle', 'Compare product stock movement, current quantity, suppliers, and unit pricing.')
@section('content')
<div class="mb-4 flex flex-wrap gap-2">
    <a href="{{ route('reports.products') }}" class="rounded bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Product Report</a>
    <a href="{{ route('reports.stock_ins') }}" class="rounded border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-950">Stock In Report</a>
    <a href="{{ route('reports.stock_outs') }}" class="rounded border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-950">Stock Out Report</a>
</div>

<div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-950">Product Stock Report</h2>
            <p class="mt-1 text-sm text-slate-500">{{ number_format($products->count()) }} products included.</p>
        </div>
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
                    <th class="whitespace-nowrap px-5 py-3">Stock In</th>
                    <th class="whitespace-nowrap px-5 py-3">Stock Out</th>
                    <th class="whitespace-nowrap px-5 py-3">Current Stock</th>
                    <th class="whitespace-nowrap px-5 py-3">Unit Price</th>
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
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $product->category?->name ?? '-' }}</td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $product->supplier?->name ?? '-' }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="inline-flex rounded bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">
                                {{ number_format($product->total_stock_in ?? 0) }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="inline-flex rounded bg-red-50 px-2.5 py-1 text-xs font-bold text-red-700 ring-1 ring-red-200">
                                {{ number_format($product->total_stock_out ?? 0) }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4">
                            @php
                                $stockClass = $product->quantity > 10
                                    ? 'bg-blue-50 text-blue-700 ring-blue-200'
                                    : ($product->quantity > 0 ? 'bg-amber-50 text-amber-700 ring-amber-200' : 'bg-red-50 text-red-700 ring-red-200');
                            @endphp
                            <span class="inline-flex rounded px-2.5 py-1 text-xs font-bold ring-1 {{ $stockClass }}">
                                {{ number_format($product->quantity) }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 font-semibold text-slate-700">${{ number_format($product->unit_price, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-5 py-12 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded bg-slate-100 text-slate-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3.75h8.25l4.5 4.5v12H6.75v-16.5Zm8.25 0v4.5h4.5M9 13.5h6M9 16.5h6M9 10.5h3" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-base font-bold text-slate-950">No report data yet</h3>
                            <p class="mt-1 text-sm text-slate-500">Products will appear here after they are created.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
