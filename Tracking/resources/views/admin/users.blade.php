<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management - Admin Panel</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900">
    @php
        $now = now();
        $evalubeLogoExists = file_exists(public_path('images/evalube.png'));
    @endphp

    <div class="relative min-h-screen overflow-x-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="h-full w-full bg-gradient-to-b from-white via-slate-50 to-slate-100"></div>
            <div
                class="absolute inset-x-0 top-0 h-48 bg-gradient-to-b from-blue-100/20 via-blue-50/10 to-transparent blur-2xl">
            </div>
        </div>

        <button id="sidebarToggle" type="button"
            class="fixed left-4 top-9 z-50 inline-flex h-12 w-12 items-center justify-center rounded-lg border border-slate-200 bg-white text-blue-600 shadow-sm transition hover:bg-blue-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 cursor-pointer sm:left-6 sm:top-10 lg:left-8 lg:top-12"
            aria-label="Toggle navigation" aria-expanded="false">
            <span class="relative flex h-4 w-6 flex-col justify-between">
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
            </span>
        </button>


        <aside id="sidebar"
            class="fixed left-0 top-0 z-50 flex h-full w-72 -translate-x-full flex-col overflow-hidden border-r border-slate-200 bg-white/90 backdrop-blur-xl shadow-[4px_0_24px_rgba(0,0,0,0.02)] transition-transform duration-300 ease-in-out lg:w-80 font-sans">

            {{-- Branding Section --}}
            <div class="relative flex flex-col gap-6 overflow-y-auto px-6 py-8">
                <a href="{{ route('dashboard.main') }}"
                    class="group relative flex items-center gap-4 rounded-2xl bg-gradient-to-br from-slate-50 to-white p-4 shadow-sm border border-slate-100 transition-all hover:shadow-md hover:border-blue-100"
                    aria-label="Halaman utama">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white p-1 shadow-sm ring-1 ring-slate-900/5 group-hover:scale-105 transition-transform">
                        <img src="{{ asset('images/wgilogo.jpg') }}" alt="Logo PT. WGI"
                            class="h-full w-full rounded-lg object-contain">
                    </div>
                    <div class="space-y-0.5">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-blue-600">Tracking System</p>
                        <p
                            class="text-sm font-bold text-slate-800 leading-tight group-hover:text-blue-700 transition-colors">
                            PT. Wiraswasta Gemilang Indonesia</p>
                    </div>
                </a>

                {{-- Navigation --}}
                <div class="flex flex-col gap-1">
                    <div class="mb-4 flex items-center justify-between px-2">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Admin Panel</p>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-emerald-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Live
                        </span>
                    </div>

                    <nav class="space-y-2">
                        {{-- Dashboard Link --}}
                        <a href="{{ route('admin.dashboard') }}"
                            class="group flex items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-blue-50 hover:text-blue-600">
                            <span class="flex items-center gap-3">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 transition-colors group-hover:bg-blue-500 group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <span class="font-medium text-sm">Dashboard</span>
                            </span>
                        </a>

                        {{-- Administrator Menu Accordion --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleAdminMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 bg-blue-50 text-blue-700 font-bold transition-all hover:bg-blue-100">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500 text-white shadow-lg shadow-blue-500/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-blue-500/80">
                                            System</p>
                                        <p>Administrator</p>
                                    </div>
                                </span>
                                <svg id="adminToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-blue-400 transition-transform duration-300 group-hover:text-blue-600 rotate-180"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="adminSubmenu" class="space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('admin.users') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm transition-all bg-blue-50 text-blue-700 font-bold">
                                        <span>User Management</span>
                                        <div class="h-1 w-1 rounded-full bg-blue-600"></div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- POS 1 Link --}}
                        <a href="{{ route('pos1.dashboard') }}"
                            class="group flex items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-blue-50 hover:text-blue-600">
                            <span class="flex items-center gap-3">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 transition-colors group-hover:bg-blue-500 group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 012-2v0m12 0a2 2 0 012-2v0m-2 2a2 2 0 012-2m-2 2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a1 1 0 00-1 1v4" />
                                    </svg>
                                </div>
                                <div class="text-left font-medium text-sm">
                                    <p class="text-xs font-bold uppercase tracking-wider text-blue-500/80">POS 1</p>
                                    <p>Checkpoint Kedatangan</p>
                                </div>
                            </span>
                        </a>

                        {{-- POS 2 Link --}}
                        <a href="{{ route('pos2.dashboard') }}"
                            class="group flex items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-emerald-50 hover:text-emerald-600">
                            <span class="flex items-center gap-3">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div class="text-left font-medium text-sm">
                                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-500/80">POS 2</p>
                                    <p>Zona Distribusi</p>
                                </div>
                            </span>
                        </a>
                    </nav>
                </div>
            </div>

            {{-- Footer / Profile Section --}}
            <div class="mt-auto border-t border-slate-100 bg-slate-50/50 p-4">
                <div class="mb-4 flex items-center gap-3 rounded-xl bg-white p-3 shadow-sm border border-slate-100">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-700 font-bold border border-blue-200">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="truncate text-sm font-bold text-slate-900">{{ Auth::user()->name ?? 'Guest' }}</p>
                        <p class="truncate text-xs text-slate-500">{{ Auth::user()->email ?? '' }}</p>
                    </div>
                </div>

                <button type="button" onclick="showLogoutModal(true)"
                    class="flex w-full cursor-pointer items-center justify-center gap-2 rounded-xl bg-white border border-rose-100 px-4 py-2.5 text-sm font-semibold text-rose-600 shadow-sm transition-all duration-200 hover:bg-rose-600 hover:text-white hover:border-rose-600 hover:shadow-lg hover:-translate-y-0.5 active:scale-95">
                    Sign Out
                </button>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </aside>

        <div id="sidebarOverlay"
            class="fixed inset-0 z-30 bg-slate-900/10 opacity-0 transition-opacity duration-300 ease-in-out pointer-events-none">
        </div>

        <main class="relative flex min-h-screen flex-col pt-32 sm:pt-36 lg:pt-40">
            <section class="fixed inset-x-0 top-0 z-40">
                <div class="overflow-hidden border-b border-slate-200 bg-white text-slate-700 shadow-sm">
                    <div class="h-3 w-full bg-[#2736a3]"></div>
                    <div class="flex flex-wrap items-center gap-6 px-6 py-6 pl-20 sm:px-10 sm:pl-28">
                        <div class="flex min-w-[220px] flex-1 items-center gap-5 text-blue-900">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-full border border-blue-900/20 bg-white p-2 shadow-lg shadow-blue-900/20">
                                <img src="{{ asset('images/wgilogo.jpg') }}"
                                    alt="Logo PT. Wiraswasta Gemilang Indonesia" class="h-full w-full object-contain">
                            </div>
                            <div class="space-y-1">
                                <span
                                    class="block text-xs font-semibold uppercase tracking-[0.55em] text-slate-500">Tracking
                                    System</span>
                                <div class="text-lg font-bold italic leading-tight text-blue-900">
                                    <span class="block">PT Wiraswasta Gemilang</span>
                                    <span class="block whitespace-nowrap">Indonesia</span>
                                </div>
                            </div>
                        </div>
                        <div class="hidden h-14 w-0.5 bg-slate-900 sm:ml-5 sm:block lg:ml-10"></div>
                        <div class="flex min-w-[200px] flex-1 justify-center text-center sm:justify-start sm:text-left">
                            <span
                                class="text-base font-medium uppercase tracking-[0.45em] text-slate-500 whitespace-nowrap">
                                Tracking Information System
                            </span>
                        </div>
                        <div class="hidden h-14 w-0.5 bg-slate-900 sm:ml-7 sm:block lg:ml-16 xl:ml-20"></div>
                        <div class="flex min-w-[160px] flex-1 justify-center sm:justify-center">
                            @if ($evalubeLogoExists)
                                <img src="{{ asset('images/evalube.png') }}" alt="Evalube Lubricants"
                                    class="h-12 w-auto object-contain">
                            @else
                                <div class="flex flex-col items-center text-center sm:items-end sm:text-right">
                                    <span
                                        class="text-2xl font-black uppercase tracking-[0.25em] text-emerald-500 drop-shadow-sm">Evalube</span>
                                    <span
                                        class="text-xs font-semibold uppercase tracking-[0.5em] text-slate-500">Lubricants</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <header class="px-8 pt-8 sm:px-12 lg:px-24">
                <div
                    class="mx-auto rounded-3xl bg-gradient-to-r from-blue-600 to-blue-700 py-6 px-6 sm:px-10 shadow-2xl relative overflow-hidden group">
                    {{-- Decorative Elements --}}
                    <div
                        class="absolute -right-20 -top-20 h-56 w-56 rounded-full bg-white/10 blur-3xl group-hover:bg-white/20 transition-colors duration-700">
                    </div>
                    <div
                        class="absolute -left-20 -bottom-20 h-56 w-56 rounded-full bg-white/5 blur-3xl group-hover:bg-white/15 transition-colors duration-700">
                    </div>

                    <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-2xl space-y-3">
                            <div class="flex items-center gap-3">
                                <span
                                    class="rounded-full bg-white/10 px-4 py-1.5 text-[9px] font-bold uppercase tracking-[0.3em] text-white border border-white/20">
                                    Administrator Access
                                </span>
                                <div class="flex items-center gap-2">
                                    <span class="relative flex h-1.5 w-1.5">
                                        <span
                                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-white opacity-75"></span>
                                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-white"></span>
                                    </span>
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-white/80">System
                                        Active</span>
                                </div>
                            </div>
                            <h1 class="text-2xl font-black text-white sm:text-4xl leading-tight tracking-tight">
                                User <span class="text-blue-100 italic">Management</span>
                            </h1>
                            <p class="text-sm text-blue-50/80 leading-relaxed max-w-xl">
                                Kelola hak akses, perbarui informasi profil, dan pantau aktivitas pengguna dalam
                                ekosistem Tracking System PT. WGI.
                            </p>
                        </div>

                        <div class="flex flex-col items-center lg:items-end">
                            <button
                                class="px-8 py-4 bg-white text-blue-900 rounded-2xl font-bold shadow-xl transition-all hover:bg-blue-50 hover:-translate-y-1 active:scale-95 flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Register New User
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <section class="mx-auto w-full flex-1 px-8 py-10 sm:px-12 lg:px-24">
                <div class="mx-auto max-w-7xl">
                    {{-- Users Table --}}
                    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
                        <div
                            class="p-7 border-b border-slate-100 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-5 bg-gradient-to-br from-white to-slate-50/50">
                            <div class="space-y-0.5">
                                <h3 class="text-xl font-black text-slate-900 tracking-tight">Daftar Pengguna</h3>
                                <div class="flex items-center gap-2">
                                    <span class="flex h-1.5 w-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">
                                        {{ $users->total() }} Kontrol Akses Terdata
                                    </p>
                                </div>
                            </div>
                            <form action="{{ route('admin.users') }}" method="GET"
                                class="relative w-full lg:w-80 group">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-transform group-focus-within:scale-110">
                                    <svg class="h-4 w-4 text-slate-400 group-focus-within:text-blue-600 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari nama atau email..."
                                    class="w-full bg-slate-50/50 border-2 border-slate-100 rounded-xl py-2.5 pl-11 pr-4 text-xs font-bold text-slate-700 placeholder:text-slate-400 focus:bg-white focus:ring-8 focus:ring-blue-500/5 focus:border-blue-500 transition-all outline-none shadow-sm hover:border-slate-200">

                                @if(request('search'))
                                    <a href="{{ route('admin.users') }}"
                                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-rose-500 transition-colors">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </a>
                                @endif
                            </form>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="text-[10px] font-black uppercase tracking-[0.25em] text-slate-400 bg-slate-50/20 border-b border-slate-100">
                                        <th class="px-8 py-4">User Profile</th>
                                        <th class="px-8 py-4">Account Identity</th>
                                        <th class="px-8 py-4">Role/Access</th>
                                        <th class="px-8 py-4">Status</th>
                                        <th class="px-8 py-4 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach($users as $user)
                                        <tr
                                            class="group hover:bg-gradient-to-r hover:from-blue-50/40 hover:to-transparent transition-all duration-300">
                                            <td class="px-8 py-5">
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="relative h-11 w-11 shrink-0 overflow-hidden rounded-xl bg-gradient-to-br from-blue-600 to-indigo-700 p-0.5 shadow-md shadow-blue-100/50 group-hover:scale-105 transition-transform duration-300">
                                                        <div
                                                            class="flex h-full w-full items-center justify-center rounded-[0.65rem] bg-white transition-colors group-hover:bg-transparent">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-6 w-6 text-blue-700 transition-colors group-hover:text-white"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                                stroke-width="2.5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="space-y-0.5">
                                                        <p
                                                            class="text-sm font-black text-slate-900 leading-tight tracking-tight group-hover:text-blue-600 transition-colors">
                                                            {{ $user->name }}
                                                        </p>
                                                        <p class="text-[10px] font-bold text-slate-400 italic">
                                                            {{ $user->email }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5">
                                                <div class="space-y-0.5">
                                                    <p class="text-xs font-black text-slate-700 tracking-tight">
                                                        {{ $user->username ?? '-' }}
                                                    </p>
                                                    <p
                                                        class="text-[9px] font-bold text-slate-400 tracking-widest uppercase">
                                                        ID: #USR-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</p>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5 text-sm">
                                                @php
                                                    $roleStyles = [
                                                        'admin' => ['bg' => 'bg-blue-50/50', 'border' => 'border-blue-100/50', 'dot' => 'bg-blue-600', 'text' => 'text-blue-800', 'label' => 'Administrator'],
                                                        'pos1' => ['bg' => 'bg-emerald-50/50', 'border' => 'border-emerald-100/50', 'dot' => 'bg-emerald-600', 'text' => 'text-emerald-800', 'label' => 'Terminal POS 1'],
                                                        'pos2' => ['bg' => 'bg-indigo-50/50', 'border' => 'border-indigo-100/50', 'dot' => 'bg-indigo-600', 'text' => 'text-indigo-800', 'label' => 'Terminal POS 2'],
                                                        'hse' => ['bg' => 'bg-rose-50/50', 'border' => 'border-rose-100/50', 'dot' => 'bg-rose-600', 'text' => 'text-rose-800', 'label' => 'Safety & HSE'],
                                                        'scm' => ['bg' => 'bg-amber-50/50', 'border' => 'border-amber-100/50', 'dot' => 'bg-amber-600', 'text' => 'text-amber-800', 'label' => 'SCM Logistics'],
                                                    ];
                                                    $style = $roleStyles[$user->role] ?? $roleStyles['admin'];
                                                @endphp
                                                <div
                                                    class="inline-flex items-center gap-2 rounded-xl {{ $style['bg'] }} px-3 py-1.5 border {{ $style['border'] }} shadow-sm backdrop-blur-md">
                                                    <span
                                                        class="h-1.5 w-1.5 rounded-full {{ $style['dot'] }} shadow-[0_0_8px_rgba(0,0,0,0.1)]"></span>
                                                    <span
                                                        class="text-[9px] font-black {{ $style['text'] }} uppercase tracking-widest">{{ $style['label'] }}</span>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5">
                                                <div class="space-y-1">
                                                    <div class="flex items-center gap-2 text-slate-800">
                                                        <svg class="h-3 w-3 text-blue-500" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2.5"
                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        <p class="text-[10px] font-black uppercase tracking-wider">
                                                            {{ $user->created_at->format('d M y') }}
                                                        </p>
                                                    </div>
                                                    <div class="flex items-center gap-2 text-slate-400/80">
                                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <p class="text-[9px] font-bold text-emerald-500 animate-pulse">
                                                            Online</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5 text-center whitespace-nowrap">
                                                <div class="relative" x-data="{ open: false }">
                                                    <button @click="open = !open"
                                                        class="flex h-9 w-9 mx-auto items-center justify-center rounded-xl text-slate-400 hover:text-blue-600 transition-all duration-300 hover:bg-white hover:shadow-lg hover:shadow-blue-200/30 focus:outline-none border-2 border-transparent focus:border-blue-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01" />
                                                        </svg>
                                                    </button>

                                                    <!-- Dropdown Menu -->
                                                    <div x-show="open" @click.away="open = false"
                                                        x-transition:enter="transition ease-out duration-100"
                                                        x-transition:enter-start="transform opacity-0 scale-95"
                                                        x-transition:enter-end="transform opacity-100 scale-100"
                                                        x-transition:leave="transition ease-in duration-75"
                                                        x-transition:leave-start="transform opacity-100 scale-100"
                                                        x-transition:leave-end="transform opacity-0 scale-95"
                                                        class="absolute right-0 mt-3 z-[60] w-52 origin-top-right rounded-3xl border border-slate-100 bg-white/95 backdrop-blur-xl shadow-2xl shadow-blue-900/10 focus:outline-none overflow-hidden text-left p-1.5 ring-1 ring-slate-900/5">
                                                        <div class="relative">
                                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                                class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-all rounded-xl">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                                <span>Edit User Details</span>
                                                            </a>
                                                            <div class="my-1 border-t border-slate-50"></div>
                                                            <button type="button"
                                                                @click="open = false; confirmUserDelete('{{ $user->id }}', '{{ $user->name }}')"
                                                                class="flex w-full items-center gap-3 px-4 py-3 text-xs font-black text-rose-600 hover:bg-rose-50/80 transition-all rounded-2xl active:scale-95">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                                Delete User
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <form id="delete-user-form-{{ $user->id }}"
                                                        action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                        class="hidden">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div
                            class="px-8 py-6 border-t border-slate-50 bg-slate-50/30 flex items-center justify-between">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Showing <span
                                    class="text-blue-600">1</span> to
                                <span class="text-blue-600">{{ $users->count() }}</span> of <span
                                    class="text-blue-600">{{ $users->total() }}</span> entries
                            </p>
                            <div class="flex items-center gap-2">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    {{-- Logout Modal --}}
    <div id="logoutModal"
        class="fixed inset-0 z-[100] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="showLogoutModal(false)"></div>
        <div
            class="relative w-full max-w-sm rounded-3xl bg-white p-8 shadow-2xl transform scale-95 transition-all duration-300 border border-slate-100">
            <div class="mb-8 flex flex-col items-center text-center">
                <div
                    class="mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-rose-50 text-rose-500 border-4 border-rose-100/50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-slate-800">Ending Session?</h3>
                <p class="mt-2 text-sm text-slate-500 font-medium">Pastikan semua pekerjaan Anda telah tersimpan sebelum
                    keluar sistem.</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <button type="button" onclick="showLogoutModal(false)"
                    class="rounded-2xl border-2 border-slate-100 bg-white px-4 py-4 text-xs font-black uppercase tracking-widest text-slate-500 transition-all hover:bg-slate-50 hover:text-slate-800 active:scale-95">Batal</button>
                <button type="button" onclick="document.getElementById('logoutForm').submit()"
                    class="rounded-2xl bg-rose-600 px-4 py-4 text-xs font-black uppercase tracking-widest text-white shadow-xl shadow-rose-600/30 transition-all hover:bg-rose-700 active:scale-95">Ya,
                    Keluar</button>
            </div>
        </div>
    </div>

    {{-- Delete User Modal --}}
    <div id="deleteUserModal"
        class="fixed inset-0 z-[100] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="showDeleteUserModal(false)"></div>
        <div
            class="relative w-full max-w-sm rounded-[2.5rem] bg-white p-8 shadow-2xl transform scale-95 transition-all duration-300 border border-slate-100">
            <div class="mb-8 flex flex-col items-center text-center">
                <div
                    class="mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-rose-50 text-rose-500 border-4 border-rose-100/50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Hapus Pengguna?</h3>
                <p class="mt-2 text-sm text-slate-500 font-medium">Apakah anda yakin ingin menghapus user <span
                        id="deleteUserName" class="font-bold text-slate-900"></span>? Tindakan ini tidak dapat
                    dibatalkan.</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <button type="button" onclick="showDeleteUserModal(false)"
                    class="rounded-2xl border-2 border-slate-100 bg-white px-4 py-4 text-xs font-black uppercase tracking-widest text-slate-500 transition-all hover:bg-slate-50 hover:text-slate-800 active:scale-95 cursor-pointer">Batal</button>
                <button type="button" id="confirmUserDeleteBtn"
                    class="rounded-2xl bg-rose-600 px-4 py-4 text-xs font-black uppercase tracking-widest text-white shadow-xl shadow-rose-600/30 transition-all hover:bg-rose-700 active:scale-95 cursor-pointer">Ya,
                    Hapus</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            const toggleSidebar = (forceOpen = null) => {
                const isOpen = forceOpen !== null ? forceOpen : sidebar.classList.contains('translate-x-0');
                if (!isOpen) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    overlay.classList.remove('pointer-events-none');
                    overlay.classList.remove('opacity-0');
                    overlay.classList.add('pointer-events-auto', 'opacity-100');
                    toggleButton.setAttribute('aria-expanded', 'true');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                    overlay.classList.remove('pointer-events-auto', 'opacity-100');
                    overlay.classList.add('pointer-events-none', 'opacity-0');
                    toggleButton.setAttribute('aria-expanded', 'false');
                }
            };

            toggleButton.addEventListener('click', () => toggleSidebar());
            overlay.addEventListener('click', () => toggleSidebar(true));

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && sidebar.classList.contains('translate-x-0')) {
                    toggleSidebar(true);
                }
            });
        });

        function toggleAdminMenu() {
            const submenu = document.getElementById('adminSubmenu');
            const icon = document.getElementById('adminToggleIcon');
            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                submenu.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        function showLogoutModal(show) {
            const modal = document.getElementById('logoutModal');
            const content = modal.querySelector('div.relative');
            if (show) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                setTimeout(() => content.classList.replace('scale-95', 'scale-100'), 10);
            } else {
                content.classList.replace('scale-100', 'scale-95');
                setTimeout(() => modal.classList.add('opacity-0', 'pointer-events-none'), 200);
            }
        }

        let deleteUserId = null;

        function confirmUserDelete(id, name) {
            deleteUserId = id;
            document.getElementById('deleteUserName').textContent = name;
            showDeleteUserModal(true);
        }

        function showDeleteUserModal(show) {
            const modal = document.getElementById('deleteUserModal');
            const content = modal.querySelector('div.relative');
            if (show) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                setTimeout(() => content.classList.replace('scale-95', 'scale-100'), 10);
            } else {
                content.classList.replace('scale-100', 'scale-95');
                setTimeout(() => modal.classList.add('opacity-0', 'pointer-events-none'), 200);
            }
        }

        document.getElementById('confirmUserDeleteBtn').addEventListener('click', () => {
            if (deleteUserId) {
                document.getElementById('delete-user-form-' + deleteUserId).submit();
            }
        });
    </script>
</body>

</html>