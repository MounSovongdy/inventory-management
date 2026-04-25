@extends('layouts.app')
@section('title', 'Dashboard | Inventory Management System')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Monitor stock health, product coverage, suppliers, and core inventory counts at a glance.')
@section('content')
<div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
    <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-slate-500">Total Products</p>
                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-950">{{ number_format($totalProducts) }}</p>
            </div>
            <div class="flex h-11 w-11 items-center justify-center rounded bg-blue-50 text-blue-700">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 8.25-9-5.25-9 5.25 9 5.25 9-5.25Zm0 0v7.5l-9 5.25-9-5.25v-7.5" />
                </svg>
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="mt-5 inline-flex text-sm font-semibold text-blue-700 hover:text-blue-900">View products</a>
    </div>

    <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-slate-500">Total Categories</p>
                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-950">{{ number_format($totalCategories) }}</p>
            </div>
            <div class="flex h-11 w-11 items-center justify-center rounded bg-amber-50 text-amber-700">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 6.75h6.75v6.75H4.5V6.75Zm8.25 0h6.75v6.75h-6.75V6.75ZM4.5 15h6.75v2.25H4.5V15Zm8.25 0h6.75v2.25h-6.75V15Z" />
                </svg>
            </div>
        </div>
        <a href="{{ route('categories.index') }}" class="mt-5 inline-flex text-sm font-semibold text-amber-700 hover:text-amber-900">Manage categories</a>
    </div>

    <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-slate-500">Total Suppliers</p>
                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-950">{{ number_format($totalSuppliers) }}</p>
            </div>
            <div class="flex h-11 w-11 items-center justify-center rounded bg-purple-50 text-purple-700">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0M18 9.75h3m-1.5-1.5v3" />
                </svg>
            </div>
        </div>
        <a href="{{ route('suppliers.index') }}" class="mt-5 inline-flex text-sm font-semibold text-purple-700 hover:text-purple-900">Review suppliers</a>
    </div>

    <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-slate-500">Current Stock</p>
                <p class="mt-3 text-3xl font-bold tracking-tight text-slate-950">{{ number_format($currentStock) }}</p>
            </div>
            <div class="flex h-11 w-11 items-center justify-center rounded bg-emerald-50 text-emerald-700">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75v11.25m0 0 4.5-4.5M12 15l-4.5-4.5M4.5 18.75h15" />
                </svg>
            </div>
        </div>
        <a href="{{ route('stock-ins.index') }}" class="mt-5 inline-flex text-sm font-semibold text-emerald-700 hover:text-emerald-900">Open stock log</a>
    </div>
</div>

<div class="mt-6 grid gap-6 xl:grid-cols-3">
    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm xl:col-span-2">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-950">Inventory Actions</h2>
                <p class="mt-1 text-sm text-slate-500">Use the most common workflows without leaving the dashboard.</p>
            </div>
        </div>
        <div class="mt-5 grid gap-3 sm:grid-cols-2">
            <a href="{{ route('products.create') }}" class="flex items-center justify-between rounded border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:border-blue-300 hover:bg-blue-50 hover:text-blue-800">
                Add new product
                <span aria-hidden="true">+</span>
            </a>
            <a href="{{ route('stock-ins.create') }}" class="flex items-center justify-between rounded border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-800">
                Record stock in
                <span aria-hidden="true">+</span>
            </a>
            <a href="{{ route('stock-outs.create') }}" class="flex items-center justify-between rounded border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:border-red-300 hover:bg-red-50 hover:text-red-800">
                Record stock out
                <span aria-hidden="true">+</span>
            </a>
            <a href="{{ route('reports.products') }}" class="flex items-center justify-between rounded border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50 hover:text-slate-950">
                View reports
                <span aria-hidden="true">></span>
            </a>
        </div>
    </div>

    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold text-slate-950">Stock Summary</h2>
        <p class="mt-1 text-sm leading-6 text-slate-500">Current stock is calculated from all product quantities and updates when stock in or stock out records are added.</p>
        <div class="mt-5 rounded bg-slate-50 p-4">
            <p class="text-sm font-semibold text-slate-500">Average units per product</p>
            <p class="mt-2 text-2xl font-bold text-slate-950">
                {{ $totalProducts ? number_format($currentStock / $totalProducts, 1) : '0.0' }}
            </p>
        </div>
    </div>
</div>
@endsection
