<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">
        {{-- Mobile overlay --}}
        <div
            x-show="sidebarOpen"
            x-transition.opacity
            class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden"
            @click="sidebarOpen = false"
            style="display: none;"
        ></div>

        {{-- Sidebar --}}
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-100 transform transition-transform duration-200 lg:translate-x-0 lg:static lg:flex lg:flex-col"
        >
            <div class="flex items-center justify-between h-16 px-5 border-b border-slate-700">
                <a href="{{ route('dashboard') }}" class="font-semibold tracking-wide text-white">Admin Panel</a>
                <button type="button" class="lg:hidden text-slate-300" @click="sidebarOpen = false" aria-label="Close sidebar">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-6 text-sm">
                <div>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center px-3 py-2 rounded-md {{ request()->routeIs('dashboard') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        Dashboard
                    </a>
                </div>

                <div>
                    <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">CMS</p>
                    <div class="space-y-1">
                        <a href="{{ route('admin.cms.home.edit') }}"
                           class="block px-3 py-2 rounded-md {{ request()->routeIs('admin.cms.home.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Home
                        </a>
                        <a href="{{ route('admin.cms.header.edit') }}"
                           class="block px-3 py-2 rounded-md {{ request()->routeIs('admin.cms.header.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Header
                        </a>
                        <a href="{{ route('admin.cms.footer.edit') }}"
                           class="block px-3 py-2 rounded-md {{ request()->routeIs('admin.cms.footer.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Footer
                        </a>
                    </div>
                </div>

                <div>
                    <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">Settings</p>
                    <div class="space-y-1">
                        <a href="{{ route('admin.settings.site.edit') }}"
                           class="block px-3 py-2 rounded-md {{ request()->routeIs('admin.settings.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Site Settings
                        </a>
                    </div>
                </div>
            </nav>

            <div class="border-t border-slate-700 p-4 text-sm">
                <div class="text-slate-300 truncate mb-2">{{ Auth::user()->name }}</div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('profile.edit') }}" class="text-slate-400 hover:text-white">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-white">Log out</button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Main --}}
        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-16 bg-white border-b border-gray-200 flex items-center px-4 sm:px-6 gap-4">
                <button type="button" class="lg:hidden text-gray-600" @click="sidebarOpen = true" aria-label="Open sidebar">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-lg font-semibold text-gray-800">@yield('heading', 'Admin')</h1>
                <div class="ms-auto">
                    <a href="{{ url('/') }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-800">View site</a>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if (session('status'))
                    <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded-md bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
