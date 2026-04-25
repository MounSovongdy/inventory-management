<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventory Management System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased">
    @auth
        @php
            $navLinks = [
                [
                    'label' => 'Dashboard',
                    'route' => 'dashboard',
                    'active' => 'dashboard',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h6.75V3.75H3.75V12Zm9.75 8.25h6.75V3.75H13.5v16.5ZM3.75 20.25h6.75V15H3.75v5.25Z" />',
                ],
                [
                    'label' => 'Products',
                    'route' => 'products.index',
                    'active' => 'products.*',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="m21 8.25-9-5.25-9 5.25m18 0-9 5.25m9-5.25v7.5l-9 5.25m0-7.5L3 8.25m9 5.25v7.5M3 8.25v7.5l9 5.25" />',
                ],
                [
                    'label' => 'Categories',
                    'route' => 'categories.index',
                    'active' => 'categories.*',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 6.75h6.75v6.75H4.5V6.75Zm8.25 0h6.75v6.75h-6.75V6.75ZM4.5 15h6.75v2.25H4.5V15Zm8.25 0h6.75v2.25h-6.75V15Z" />',
                ],
                [
                    'label' => 'Suppliers',
                    'route' => 'suppliers.index',
                    'active' => 'suppliers.*',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0M18 9.75h3m-1.5-1.5v3" />',
                ],
                [
                    'label' => 'Stock In',
                    'route' => 'stock-ins.index',
                    'active' => 'stock-ins.*',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75v11.25m0 0 4.5-4.5M12 15l-4.5-4.5M4.5 18.75h15" />',
                ],
                [
                    'label' => 'Stock Out',
                    'route' => 'stock-outs.index',
                    'active' => 'stock-outs.*',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25V9m0 0 4.5 4.5M12 9l-4.5 4.5M4.5 5.25h15" />',
                ],
                [
                    'label' => 'Reports',
                    'route' => 'reports.products',
                    'active' => 'reports.*',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3.75h8.25l4.5 4.5v12H6.75v-16.5Zm8.25 0v4.5h4.5M9 13.5h6M9 16.5h6M9 10.5h3" />',
                ],
            ];

            if (auth()->user()?->isAdmin()) {
                $navLinks[] = [
                    'label' => 'Users',
                    'route' => 'users.index',
                    'active' => 'users.*',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 7.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.75 8.25a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm14.25 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0ZM9 20.25a5.25 5.25 0 0 1 10.5 0M1.5 18.75a4.5 4.5 0 0 1 6.75-3.9m14.25 3.9a4.5 4.5 0 0 0-6.75-3.9" />',
                ];
            }

            $currentNav = collect($navLinks)->first(fn ($link) => request()->routeIs($link['active']));
            $pageTitle = trim($__env->yieldContent('page-title')) ?: ($currentNav['label'] ?? 'Dashboard');
            $pageSubtitle = trim($__env->yieldContent('page-subtitle')) ?: 'Manage stock, suppliers, and reporting from one workspace.';
        @endphp

        <div
            x-data="{
                sidebarOpen: false,
                deleteModalOpen: false,
                deleteForm: null,
                deleteTitle: 'Delete item?',
                deleteMessage: 'This action cannot be undone.',
                deleteSubmitting: false,
                confirmDelete(form, title, message) {
                    this.deleteForm = form;
                    this.deleteTitle = title || 'Delete item?';
                    this.deleteMessage = message || 'This action cannot be undone.';
                    this.deleteSubmitting = false;
                    this.deleteModalOpen = true;
                },
                cancelDelete() {
                    this.deleteModalOpen = false;
                    this.deleteForm = null;
                    this.deleteSubmitting = false;
                },
                submitDelete() {
                    if (!this.deleteForm) {
                        return;
                    }

                    this.deleteSubmitting = true;
                    this.deleteForm.submit();
                }
            }"
            class="min-h-screen lg:flex"
        >
            <aside class="fixed inset-y-0 left-0 z-50 hidden w-72 border-r border-slate-800 bg-slate-950 text-white lg:flex lg:flex-col">
                <div class="flex h-20 items-center gap-3 border-b border-white/10 px-6">
                    <div class="flex h-10 w-10 items-center justify-center rounded bg-emerald-400 text-base font-bold text-slate-950">
                        IM
                    </div>
                    <div>
                        <a href="{{ route('dashboard') }}" class="block text-base font-bold leading-5 tracking-tight">
                            Inventory
                        </a>
                        <p class="text-xs font-medium text-slate-400">Management System</p>
                    </div>
                </div>

                <nav class="flex-1 space-y-1 px-4 py-6">
                    @foreach($navLinks as $link)
                        <a
                            href="{{ route($link['route']) }}"
                            class="group flex items-center gap-3 rounded px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs($link['active']) ? 'bg-emerald-400 text-slate-950 shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}"
                        >
                            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                {!! $link['icon'] !!}
                            </svg>
                            <span>{{ $link['label'] }}</span>
                        </a>
                    @endforeach
                </nav>

                <div class="border-t border-white/10 p-4">
                    <div class="rounded-lg bg-white/5 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Signed in</p>
                        <p class="mt-1 truncate text-sm font-semibold text-white">{{ auth()->user()->name ?? auth()->user()->email }}</p>
                        <p class="truncate text-xs text-slate-400">{{ auth()->user()->email }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded border border-white/10 px-4 py-2.5 text-sm font-semibold text-slate-200 transition hover:border-red-300/40 hover:bg-red-400/10 hover:text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m-3-3h9m0 0-3-3m3 3-3 3" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            <div x-cloak x-show="sidebarOpen" class="fixed inset-0 z-40 lg:hidden" role="dialog" aria-modal="true">
                <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-slate-950/60" @click="sidebarOpen = false"></div>
                <aside x-show="sidebarOpen" x-transition class="fixed inset-y-0 left-0 flex w-72 max-w-[85vw] flex-col bg-slate-950 text-white shadow-2xl">
                    <div class="flex h-20 items-center justify-between border-b border-white/10 px-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded bg-emerald-400 text-base font-bold text-slate-950">
                                IM
                            </div>
                            <div>
                                <p class="text-base font-bold leading-5">Inventory</p>
                                <p class="text-xs font-medium text-slate-400">Management System</p>
                            </div>
                        </div>
                        <button type="button" class="rounded p-2 text-slate-300 hover:bg-white/10 hover:text-white" @click="sidebarOpen = false" aria-label="Close menu">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <nav class="flex-1 space-y-1 px-4 py-6">
                        @foreach($navLinks as $link)
                            <a
                                href="{{ route($link['route']) }}"
                                class="flex items-center gap-3 rounded px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs($link['active']) ? 'bg-emerald-400 text-slate-950' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}"
                                @click="sidebarOpen = false"
                            >
                                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
                                    {!! $link['icon'] !!}
                                </svg>
                                <span>{{ $link['label'] }}</span>
                            </a>
                        @endforeach
                    </nav>
                </aside>
            </div>

            <div class="flex min-h-screen flex-1 flex-col lg:pl-72">
                <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
                    <div class="flex min-h-20 items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
                        <div class="flex min-w-0 items-center gap-4">
                            <button type="button" class="rounded border border-slate-200 bg-white p-2 text-slate-600 shadow-sm transition hover:border-slate-400 hover:text-slate-950 lg:hidden" @click="sidebarOpen = true" aria-label="Open menu">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase tracking-wide text-emerald-700">Inventory Workspace</p>
                                <h1 class="mt-1 truncate text-xl font-bold tracking-tight text-slate-950 sm:text-2xl">{{ $pageTitle }}</h1>
                            </div>
                        </div>

                        <div class="hidden items-center gap-3 md:flex">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-slate-950">{{ auth()->user()->name ?? 'User' }}</p>
                                <p class="text-xs text-slate-500">{{ now()->format('M d, Y') }}</p>
                            </div>
                            <div class="flex h-10 w-10 items-center justify-center rounded bg-slate-900 text-sm font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->name ?? auth()->user()->email, 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </header>

                <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
                    <div class="mb-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                        <p class="max-w-3xl text-sm leading-6 text-slate-600">{{ $pageSubtitle }}</p>
                    </div>

                    @if(session('success'))
                        <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            <ul class="list-disc space-y-1 pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </main>

                <footer class="border-t border-slate-200 bg-white px-4 py-4 text-sm text-slate-500 sm:px-6 lg:px-8">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <p>&copy; {{ date('Y') }} Inventory Management System.</p>
                        <p>Built for stock control, purchasing, and reports.</p>
                    </div>
                </footer>
            </div>

            <div
                x-cloak
                x-show="deleteModalOpen"
                class="fixed inset-0 z-[70] flex items-center justify-center px-4 py-6"
                role="dialog"
                aria-modal="true"
                aria-labelledby="delete-modal-title"
                @keydown.escape.window="cancelDelete()"
            >
                <div x-show="deleteModalOpen" x-transition.opacity class="absolute inset-0 bg-slate-950/60" @click="cancelDelete()"></div>

                <div x-show="deleteModalOpen" x-transition class="relative w-full max-w-md overflow-hidden rounded-lg border border-slate-200 bg-white shadow-2xl">
                    <div class="flex items-start gap-4 p-6">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded bg-red-50 text-red-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4.5m0 3h.008v.008H12V16.5Zm8.25 3H3.75L12 4.5l8.25 15Z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h2 id="delete-modal-title" class="text-lg font-bold text-slate-950" x-text="deleteTitle"></h2>
                            <p class="mt-2 text-sm leading-6 text-slate-600" x-text="deleteMessage"></p>
                        </div>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            class="inline-flex items-center justify-center rounded border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-900 hover:text-slate-950 disabled:cursor-not-allowed disabled:opacity-70"
                            @click="cancelDelete()"
                            :disabled="deleteSubmitting"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            class="inline-flex items-center justify-center gap-2 rounded bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700 disabled:cursor-not-allowed disabled:opacity-80"
                            @click="submitDelete()"
                            :disabled="deleteSubmitting"
                        >
                            <svg x-show="deleteSubmitting" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4Z"></path>
                            </svg>
                            <span x-text="deleteSubmitting ? 'Deleting...' : 'Yes, Delete'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <main class="flex min-h-screen items-center justify-center px-4 py-10">
            <div class="w-full max-w-md">
                @if($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    @endauth
</body>
</html>
