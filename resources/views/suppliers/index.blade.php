@extends('layouts.app')
@section('title', 'Suppliers | Inventory Management System')
@section('page-title', 'Suppliers')
@section('page-subtitle', 'Keep supplier contact details ready for purchasing, receiving, and product follow-up.')
@section('content')
<div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-950">Supplier List</h2>
            <p class="mt-1 text-sm text-slate-500">{{ number_format($suppliers->count()) }} suppliers available.</p>
        </div>
        <a href="{{ route('suppliers.create') }}" class="inline-flex items-center justify-center gap-2 rounded bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
            </svg>
            Add Supplier
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="whitespace-nowrap px-5 py-3">#</th>
                    <th class="whitespace-nowrap px-5 py-3">Name</th>
                    <th class="whitespace-nowrap px-5 py-3">Phone</th>
                    <th class="whitespace-nowrap px-5 py-3">Email</th>
                    <th class="whitespace-nowrap px-5 py-3">Address</th>
                    <th class="whitespace-nowrap px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($suppliers as $supplier)
                    <tr class="transition hover:bg-slate-50">
                        <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-500">{{ $loop->iteration }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <p class="font-semibold text-slate-950">{{ $supplier->name }}</p>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $supplier->phone ?: '-' }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            @if($supplier->email)
                                <a href="mailto:{{ $supplier->email }}" class="font-semibold text-blue-700 hover:text-blue-900">{{ $supplier->email }}</a>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="min-w-72 px-5 py-4 text-slate-600">
                            <p class="max-w-sm truncate">{{ $supplier->address ?: '-' }}</p>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('suppliers.edit', $supplier) }}" class="inline-flex items-center justify-center rounded border border-slate-200 px-3 py-1.5 text-xs font-bold text-slate-700 transition hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700">
                                    Edit
                                </a>
                                <form
                                    action="{{ route('suppliers.destroy', $supplier) }}"
                                    method="POST"
                                    @submit.prevent="confirmDelete($event.target, 'Delete supplier?', {{ Illuminate\Support\Js::from('Are you sure you want to delete ' . $supplier->name . '? This action cannot be undone.') }})"
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
                        <td colspan="6" class="px-5 py-12 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded bg-slate-100 text-slate-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0M18 9.75h3m-1.5-1.5v3" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-base font-bold text-slate-950">No suppliers yet</h3>
                            <p class="mt-1 text-sm text-slate-500">Add your first supplier to connect products with vendors.</p>
                            <a href="{{ route('suppliers.create') }}" class="mt-4 inline-flex items-center justify-center rounded bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                                Add Supplier
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
