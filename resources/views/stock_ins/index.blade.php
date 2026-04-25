@extends('layouts.app')
@section('title', 'Stock In | Inventory Management System')
@section('page-title', 'Stock In')
@section('page-subtitle', 'Review inbound stock records and the quantities added to inventory.')
@section('content')
<div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-950">Stock In Records</h2>
            <p class="mt-1 text-sm text-slate-500">{{ number_format($stockIns->count()) }} inbound records available.</p>
        </div>
        <a href="{{ route('stock-ins.create') }}" class="inline-flex items-center justify-center gap-2 rounded bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
            </svg>
            Add Stock In
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="whitespace-nowrap px-5 py-3">#</th>
                    <th class="whitespace-nowrap px-5 py-3">Product</th>
                    <th class="whitespace-nowrap px-5 py-3">Quantity</th>
                    <th class="whitespace-nowrap px-5 py-3">Stock In By</th>
                    <th class="whitespace-nowrap px-5 py-3">Date</th>
                    <th class="whitespace-nowrap px-5 py-3">Note</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($stockIns as $stockIn)
                    <tr class="transition hover:bg-slate-50">
                        <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-500">{{ $loop->iteration }}</td>
                        <td class="min-w-52 px-5 py-4">
                            <p class="font-semibold text-slate-950">{{ $stockIn->product?->name ?? 'Deleted product' }}</p>
                            @if($stockIn->product?->product_code)
                                <p class="mt-1 text-xs font-semibold text-slate-500">{{ $stockIn->product->product_code }}</p>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="inline-flex rounded bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">
                                +{{ number_format($stockIn->quantity) }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <p class="font-semibold text-slate-950">{{ $stockIn->user?->name ?? 'Unknown' }}</p>
                            @if($stockIn->user?->email)
                                <p class="mt-1 text-xs text-slate-500">{{ $stockIn->user->email }}</p>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $stockIn->date }}</td>
                        <td class="min-w-72 px-5 py-4 text-slate-600">
                            <p class="max-w-md truncate">{{ $stockIn->note ?: '-' }}</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded bg-slate-100 text-slate-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75v11.25m0 0 4.5-4.5M12 15l-4.5-4.5M4.5 18.75h15" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-base font-bold text-slate-950">No stock in records yet</h3>
                            <p class="mt-1 text-sm text-slate-500">Record incoming stock to update product quantities.</p>
                            <a href="{{ route('stock-ins.create') }}" class="mt-4 inline-flex items-center justify-center rounded bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                                Add Stock In
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
