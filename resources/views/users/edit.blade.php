@extends('layouts.app')
@section('title', 'Edit User | Inventory Management System')
@section('page-title', 'Edit User')
@section('page-subtitle', 'Update account details, role, or set a new password for this user.')
@section('content')
@php
    $inputClass = 'mt-2 block w-full rounded border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-slate-500 focus:ring-slate-500';
    $labelClass = 'block text-sm font-semibold text-slate-800';
@endphp

<div class="mx-auto max-w-3xl">
    <div class="mb-6 flex flex-col gap-3 border-b border-slate-200 pb-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-medium uppercase tracking-wide text-slate-500">Users</p>
            <h2 class="mt-1 text-2xl font-bold text-slate-950">Edit User</h2>
        </div>
        <a href="{{ route('users.index') }}" class="inline-flex items-center justify-center rounded border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-900 hover:text-slate-950">
            Back to List
        </a>
    </div>

    <form method="POST" action="{{ route('users.update', $user) }}" class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        @csrf
        @method('PUT')

        <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950">Account Information</h3>
            <p class="mt-1 text-sm text-slate-600">Leave password fields empty if you do not want to change the password.</p>
        </div>

        <div class="grid gap-6 p-6 md:grid-cols-2">
            <div>
                <label for="name" class="{{ $labelClass }}">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="{{ $inputClass }}" required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="{{ $labelClass }}">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="{{ $inputClass }}" required>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="{{ $labelClass }}">Role</label>
                <select id="role" name="role" class="{{ $inputClass }}" required>
                    <option value="user" @selected(old('role', $user->role) === 'user')>User</option>
                    <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                </select>
                @error('role')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="{{ $labelClass }}">Created</label>
                <div class="{{ $inputClass }} bg-slate-100 text-slate-600">
                    {{ $user->created_at?->format('M d, Y h:i A') }}
                </div>
            </div>

            <div>
                <label for="password" class="{{ $labelClass }}">New Password</label>
                <input id="password" type="password" name="password" class="{{ $inputClass }}">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="{{ $labelClass }}">Confirm New Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="{{ $inputClass }}">
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">
            <a href="{{ route('users.index') }}" class="inline-flex items-center justify-center rounded border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-slate-900 hover:text-slate-950">
                Cancel
            </a>
            <button type="submit" class="inline-flex items-center justify-center rounded bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">
                Update User
            </button>
        </div>
    </form>
</div>
@endsection
