@extends('layouts.app')
@section('title', 'Users | Inventory Management System')
@section('page-title', 'User Management')
@section('page-subtitle', 'Create, update, and remove user accounts that can sign in to the inventory system.')
@section('content')
<div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-950">User List</h2>
            <p class="mt-1 text-sm text-slate-500">{{ number_format($users->count()) }} users available.</p>
        </div>
        <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center gap-2 rounded bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
            </svg>
            Add User
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="whitespace-nowrap px-5 py-3">#</th>
                    <th class="whitespace-nowrap px-5 py-3">Name</th>
                    <th class="whitespace-nowrap px-5 py-3">Email</th>
                    <th class="whitespace-nowrap px-5 py-3">Role</th>
                    <th class="whitespace-nowrap px-5 py-3">Created</th>
                    <th class="whitespace-nowrap px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($users as $user)
                    <tr class="transition hover:bg-slate-50">
                        <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-500">{{ $loop->iteration }}</td>
                        <td class="min-w-48 px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 items-center justify-center rounded bg-slate-900 text-xs font-bold text-white">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-950">{{ $user->name }}</p>
                                    @if($user->is(auth()->user()))
                                        <p class="mt-0.5 text-xs font-semibold text-emerald-700">Current user</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <a href="mailto:{{ $user->email }}" class="font-semibold text-blue-700 hover:text-blue-900">{{ $user->email }}</a>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4">
                            @php
                                $roleClass = $user->role === 'admin'
                                    ? 'bg-emerald-50 text-emerald-700 ring-emerald-200'
                                    : 'bg-slate-100 text-slate-700 ring-slate-200';
                            @endphp
                            <span class="inline-flex rounded px-2.5 py-1 text-xs font-bold capitalize ring-1 {{ $roleClass }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $user->created_at?->format('M d, Y') }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center justify-center rounded border border-slate-200 px-3 py-1.5 text-xs font-bold text-slate-700 transition hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700">
                                    Edit
                                </a>
                                @if($user->is(auth()->user()))
                                    <button type="button" class="inline-flex cursor-not-allowed items-center justify-center rounded border border-slate-200 px-3 py-1.5 text-xs font-bold text-slate-400" disabled>
                                        Delete
                                    </button>
                                @else
                                    <form
                                        action="{{ route('users.destroy', $user) }}"
                                        method="POST"
                                        @submit.prevent="confirmDelete($event.target, 'Delete user?', {{ Illuminate\Support\Js::from('Are you sure you want to delete ' . $user->name . '? This action cannot be undone.') }})"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center rounded border border-red-200 px-3 py-1.5 text-xs font-bold text-red-700 transition hover:bg-red-50">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded bg-slate-100 text-slate-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 7.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM9 20.25a5.25 5.25 0 0 1 10.5 0" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-base font-bold text-slate-950">No users yet</h3>
                            <p class="mt-1 text-sm text-slate-500">Add your first user account to manage access.</p>
                            <a href="{{ route('users.create') }}" class="mt-4 inline-flex items-center justify-center rounded bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                                Add User
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
