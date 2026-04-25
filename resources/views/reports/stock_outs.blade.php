@extends('layouts.app')
@section('title', 'Stock Out Report | Inventory Management System')
@section('page-title', 'Stock Out Report')
@section('page-subtitle', 'Review detailed outbound stock movement by product, category, supplier, and date.')
@section('content')
<div class="mb-4 flex flex-wrap gap-2">
    <a href="{{ route('reports.products') }}" class="rounded border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-950">Product Report</a>
    <a href="{{ route('reports.stock_ins') }}" class="rounded border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-950">Stock In Report</a>
    <a href="{{ route('reports.stock_outs') }}" class="rounded bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Stock Out Report</a>
</div>

<div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-950">Stock Out Report</h2>
            <p class="mt-1 text-sm text-slate-500">{{ number_format($stockOuts->count()) }} outbound records included.</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="whitespace-nowrap px-5 py-3">#</th>
                    <th class="whitespace-nowrap px-5 py-3">Code</th>
                    <th class="whitespace-nowrap px-5 py-3">Product</th>
                    <th class="whitespace-nowrap px-5 py-3">Category</th>
                    <th class="whitespace-nowrap px-5 py-3">Supplier</th>
                    <th class="whitespace-nowrap px-5 py-3">Quantity</th>
                    <th class="whitespace-nowrap px-5 py-3">Stock Out By</th>
                    <th class="whitespace-nowrap px-5 py-3">Date</th>
                    <th class="whitespace-nowrap px-5 py-3">Note</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($stockOuts as $stockOut)
                    <tr class="transition hover:bg-slate-50">
                        <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-500">{{ $loop->iteration }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="rounded bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-700">{{ $stockOut->product?->product_code ?? '-' }}</span>
                        </td>
                        <td class="min-w-48 px-5 py-4">
                            <p class="font-semibold text-slate-950">{{ $stockOut->product?->name ?? 'Deleted product' }}</p>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $stockOut->product?->category?->name ?? '-' }}</td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $stockOut->product?->supplier?->name ?? '-' }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="inline-flex rounded bg-red-50 px-2.5 py-1 text-xs font-bold text-red-700 ring-1 ring-red-200">
                                -{{ number_format($stockOut->quantity) }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <p class="font-semibold text-slate-950">{{ $stockOut->user?->name ?? 'Unknown' }}</p>
                            @if($stockOut->user?->email)
                                <p class="mt-1 text-xs text-slate-500">{{ $stockOut->user->email }}</p>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $stockOut->date }}</td>
                        <td class="min-w-72 px-5 py-4 text-slate-600">
                            <p class="max-w-md truncate">{{ $stockOut->note ?: '-' }}</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-5 py-12 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded bg-slate-100 text-slate-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25V9m0 0 4.5 4.5M12 9l-4.5 4.5M4.5 5.25h15" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-base font-bold text-slate-950">No stock out report data yet</h3>
                            <p class="mt-1 text-sm text-slate-500">Outbound records will appear here after stock is issued.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
