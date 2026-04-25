@extends('layouts.app')
@section('title', 'Categories | Inventory Management System')
@section('page-title', 'Categories')
@section('page-subtitle', 'Organize products into clear groups for faster inventory tracking and reporting.')
@section('content')
<div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-950">Category List</h2>
            <p class="mt-1 text-sm text-slate-500">{{ number_format($categories->count()) }} categories available.</p>
        </div>
        <a href="{{ route('categories.create') }}" class="inline-flex items-center justify-center gap-2 rounded bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
            </svg>
            Add Category
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="whitespace-nowrap px-5 py-3">#</th>
                    <th class="whitespace-nowrap px-5 py-3">Name</th>
                    <th class="whitespace-nowrap px-5 py-3">Description</th>
                    <th class="whitespace-nowrap px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($categories as $category)
                    <tr class="transition hover:bg-slate-50">
                        <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-500">{{ $loop->iteration }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="rounded bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-700">{{ $category->name }}</span>
                        </td>
                        <td class="min-w-72 px-5 py-4 text-slate-600">
                            <p class="max-w-xl truncate">{{ $category->description ?: 'No description' }}</p>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center justify-center rounded border border-slate-200 px-3 py-1.5 text-xs font-bold text-slate-700 transition hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700">
                                    Edit
                                </a>
                                <form
                                    action="{{ route('categories.destroy', $category) }}"
                                    method="POST"
                                    @submit.prevent="confirmDelete($event.target, 'Delete category?', {{ Illuminate\Support\Js::from('Are you sure you want to delete ' . $category->name . '? This action cannot be undone.') }})"
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
                        <td colspan="4" class="px-5 py-12 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded bg-slate-100 text-slate-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 6.75h6.75v6.75H4.5V6.75Zm8.25 0h6.75v6.75h-6.75V6.75ZM4.5 15h6.75v2.25H4.5V15Zm8.25 0h6.75v2.25h-6.75V15Z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-base font-bold text-slate-950">No categories yet</h3>
                            <p class="mt-1 text-sm text-slate-500">Add your first category to organize products.</p>
                            <a href="{{ route('categories.create') }}" class="mt-4 inline-flex items-center justify-center rounded bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                                Add Category
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
