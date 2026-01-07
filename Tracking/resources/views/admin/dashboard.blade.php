<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Tracking System</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                        {{-- Active Admin Dashboard Link --}}
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center justify-between rounded-xl bg-blue-600 px-4 py-3 text-white shadow-lg shadow-blue-500/30 transition-all hover:bg-blue-700 hover:shadow-blue-600/40 hover:-translate-y-0.5">
                            <span class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="font-semibold text-sm">Admin Dashboard</span>
                            </span>
                            <div class="h-1.5 w-1.5 rounded-full bg-white/90"></div>
                        </a>

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
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-300 transition-transform group-hover:translate-x-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-300 transition-transform group-hover:translate-x-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        {{-- SCM Menu Accordion --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleSCMMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-purple-50 hover:text-purple-600">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-purple-600 transition-colors group-hover:bg-purple-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-xs font-bold uppercase tracking-wider text-purple-500/80">SCM</p>
                                        <p>Supply Chain Management</p>
                                    </div>
                                </span>
                                <svg id="scmToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-purple-400 transition-transform duration-300 group-hover:text-purple-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="scmSubmenu" class="hidden space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('scm.do-item.input') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-purple-50 hover:text-purple-700">
                                        <span>DO Item</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- HSE Menu Accordion --}}

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

                <button type="button" onclick="showLogoutModal()"
                    class="flex w-full cursor-pointer items-center justify-center gap-2 rounded-xl bg-white border border-rose-100 px-4 py-2.5 text-sm font-semibold text-rose-600 shadow-sm transition-all duration-200 hover:bg-rose-600 hover:text-white hover:border-rose-600 hover:shadow-lg hover:-translate-y-0.5 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:scale-110"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
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
                                    Enterprise Dashboard
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
                                Integrated Monitoring<br><span class="text-blue-100 italic">Control Center</span>
                            </h1>
                            <p class="text-sm text-blue-50/80 leading-relaxed max-w-xl">
                                Selamat datang kembali, <span
                                    class="text-white font-semibold">{{ Auth::user()->name }}</span>.
                                Pantau dan kelola seluruh operasional logistik secara real-time dari satu
                                platform terintegrasi.
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-3 lg:w-72">
                            <div
                                class="rounded-2xl border border-white/10 bg-white/10 backdrop-blur-md p-4 text-center hover:bg-white/20 transition-colors">
                                <p class="text-[9px] font-bold uppercase tracking-widest text-blue-100/70 mb-1.5">Local
                                    Time</p>
                                <p id="currentTime" class="text-xl font-black text-white">00:00</p>
                            </div>
                            <div
                                class="rounded-2xl border border-white/10 bg-white/10 backdrop-blur-md p-4 text-center hover:bg-white/20 transition-colors">
                                <p class="text-[9px] font-bold uppercase tracking-widest text-blue-100/70 mb-1.5">Region
                                </p>
                                <p class="text-xl font-black text-white">WIB</p>
                            </div>
                            <div
                                class="col-span-2 rounded-2xl border border-white/10 bg-white/10 backdrop-blur-md p-4 flex items-center justify-between hover:bg-white/20 transition-colors">
                                <div class="text-left">
                                    <p class="text-[9px] font-bold uppercase tracking-widest text-blue-100/70">
                                        Current Date</p>
                                    <p id="currentDate" class="text-xs font-bold text-white">01 January 2026</p>
                                </div>
                                <div
                                    class="h-8 w-8 rounded-xl bg-white/20 flex items-center justify-center text-white shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <section class="relative mx-auto w-full flex-1 px-8 py-10 sm:px-12 lg:px-24">
                <div class="mx-auto max-w-7xl">
                    {{-- Core Operation Cards --}}
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 mb-16">
                        {{-- POS 1 - BLUE --}}
                        <div
                            class="group relative overflow-hidden rounded-[2.5rem] bg-white border border-slate-200 p-8 shadow-sm transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                            <div
                                class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <div class="relative z-10 space-y-6">
                                <div class="flex items-center justify-between">
                                    <div
                                        class="flex h-16 w-16 items-center justify-center rounded-[1.5rem] bg-blue-600 text-white shadow-xl shadow-blue-500/20 group-hover:scale-110 transition-transform duration-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Total
                                            Records</span>
                                        <span
                                            class="text-3xl font-black text-slate-900">{{ number_format($pos1_count ?? 0) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900">POS 1 Operations</h3>
                                    <p class="mt-2 text-sm text-slate-500 leading-relaxed">Checkpoint utama validasi
                                        kedatangan kendaraan dan pemeriksaan dokumen muat.</p>
                                </div>
                                <div class="flex items-center gap-3 py-4 border-y border-slate-50">
                                    <div class="flex-1">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                            Today's Traffic</p>
                                        <p class="text-xl font-bold text-blue-600">+{{ $pos1_today ?? 0 }} <span
                                                class="text-[10px] font-medium text-slate-400">vehicles</span></p>
                                    </div>
                                    <div class="h-8 w-px bg-slate-100"></div>
                                    <div class="flex-1 text-right">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                            Status</p>
                                        <span
                                            class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Normal
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- POS 2 - EMERALD --}}
                        <div
                            class="group relative overflow-hidden rounded-[2.5rem] bg-white border border-slate-200 p-8 shadow-sm transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                            <div
                                class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-emerald-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <div class="relative z-10 space-y-6">
                                <div class="flex items-center justify-between">
                                    <div
                                        class="flex h-16 w-16 items-center justify-center rounded-[1.5rem] bg-emerald-600 text-white shadow-xl shadow-emerald-500/20 group-hover:scale-110 transition-transform duration-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Total
                                            Checks</span>
                                        <span
                                            class="text-3xl font-black text-slate-900">{{ number_format($pos2_count ?? 0) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900">POS 2 Distribution</h3>
                                    <p class="mt-2 text-sm text-slate-500 leading-relaxed">Zona kontrol distribusi untuk
                                        pengawasan muatan dan kelaikan kendaraan jalan.</p>
                                </div>
                                <div class="flex items-center gap-3 py-4 border-y border-slate-50">
                                    <div class="flex-1">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                            Today's Check</p>
                                        <p class="text-xl font-bold text-emerald-600">{{ $pos2_today ?? 0 }} <span
                                                class="text-[10px] font-medium text-slate-400">reports</span></p>
                                    </div>
                                    <div class="h-8 w-px bg-slate-100"></div>
                                    <div class="flex-1 text-right">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                            Compliance</p>
                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.64.304 1.24.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>High
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SCM - PURPLE --}}
                        <div
                            class="group relative overflow-hidden rounded-[2.5rem] bg-white border border-slate-200 p-8 shadow-sm transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                            <div
                                class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <div class="relative z-10 space-y-6">
                                <div class="flex items-center justify-between">
                                    <div
                                        class="flex h-16 w-16 items-center justify-center rounded-[1.5rem] bg-purple-600 text-white shadow-xl shadow-purple-500/20 group-hover:scale-110 transition-transform duration-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Total
                                            Items</span>
                                        <span
                                            class="text-3xl font-black text-slate-900">{{ number_format($scm_count ?? 0) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900">SCM Ecosystem</h3>
                                    <p class="mt-2 text-sm text-slate-500 leading-relaxed">Manajemen rantai pasokan
                                        termasuk penginputan item Delivery Order (DO).</p>
                                </div>
                                <div class="flex items-center gap-3 py-4 border-y border-slate-50">
                                    <div class="flex-1">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                            Input Today</p>
                                        <p class="text-xl font-bold text-purple-600">{{ $scm_today ?? 0 }} <span
                                                class="text-[10px] font-medium text-slate-400">items</span></p>
                                    </div>
                                    <div class="h-8 w-px bg-slate-100"></div>
                                    <div class="flex-1 text-right">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                            Data Health</p>
                                        <span
                                            class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M11.3 1.047a1 1 0 01.4 0l7 3a1 1 0 01.488.608l1 6a1 1 0 01-.456 1.025l-6 4a1 1 0 01-1.11 0l-6-4a1 1 0 01-.456-1.025l1-6a1 1 0 01.488-.608l7-3zM10 12a2 2 0 100-4 2 2 0 000 4z"
                                                    clip-rule="evenodd" />
                                            </svg>Verified
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-8 lg:grid-cols-3">
                        {{-- Analytics Column --}}
                        <div class="lg:col-span-2 space-y-8">

                            <div class="grid gap-8 sm:grid-cols-2">
                                <article class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-bold text-slate-900">Operational Insight</h3>
                                            <p class="text-xs text-slate-500 italic">Latest optimization tip</p>
                                        </div>
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed border-l-4 border-amber-400 pl-4">
                                        Koordinasi antar POS 1 dan POS 2 minggu ini meningkat 15%. Pastikan sinkronisasi
                                        data tetap terjaga untuk menghindari antrian panjang di area distribsusi.
                                    </p>
                                </article>

                                <article class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-bold text-slate-900">HSE Protocol</h3>
                                            <p class="text-xs text-slate-500 italic">Safety reminder</p>
                                        </div>
                                    </div>
                                    <p
                                        class="text-sm text-slate-600 leading-relaxed border-l-4 border-emerald-400 pl-4">
                                        Seluruh pengawas POS wajib menggunakan APD lengkap sesuai standar K3.
                                        Kedisiplinan adalah kunci keselamatan bersama di area PT. WGI.
                                    </p>
                                </article>
                            </div>
                        </div>

                        {{-- Right Column - Quick Tools --}}
                        <div class="space-y-8">
                            <article class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                                <h3 class="text-[10px] font-bold uppercase tracking-[0.4em] text-slate-400 mb-6">Quick
                                    Actions</h3>
                                <div class="space-y-3">
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-slate-900 hover:text-white transition-all duration-300 group">
                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-slate-400 group-hover:bg-white/10 group-hover:text-blue-400 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-bold">System Admin Panel</span>
                                    </a>
                                    <button onclick="window.print()"
                                        class="w-full flex items-center gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-slate-900 hover:text-white transition-all duration-300 group">
                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-slate-400 group-hover:bg-white/10 group-hover:text-emerald-400 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-bold">Print Operasional Report</span>
                                    </button>
                                </div>
                            </article>

                            <article
                                class="rounded-[2.5rem] bg-gradient-to-br from-blue-600 to-blue-800 p-8 text-white shadow-xl shadow-blue-500/20">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 mb-6 backdrop-blur-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Mobile Optimized</h3>
                                <p class="text-sm text-blue-100 leading-relaxed mb-6">
                                    Akses dashboard utama via smartphone untuk pemantauan lapangan yang lebih fleksibel.
                                </p>
                                <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/10">
                                    <div class="flex items-center justify-between gap-4">
                                        <span
                                            class="text-xs font-bold uppercase tracking-widest text-blue-200 italic">Version
                                            2.4.0</span>
                                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
        </main>
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

            // Real-time clock for WIB timezone
            function updateWIBTime() {
                const now = new Date();
                // WIB is UTC+7
                const wibOffset = 7 * 60; // 7 hours in minutes
                const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
                const wibTime = new Date(utc + (wibOffset * 60000));

                // Format time
                const hours = String(wibTime.getHours()).padStart(2, '0');
                const minutes = String(wibTime.getMinutes()).padStart(2, '0');
                const timeString = `${hours}:${minutes} WIB`;

                // Format date
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                const dayName = days[wibTime.getDay()];
                const day = String(wibTime.getDate()).padStart(2, '0');
                const month = months[wibTime.getMonth()];
                const year = wibTime.getFullYear();
                const dateString = `${day} ${month} ${year}`;

                // Update DOM
                const timeElement = document.getElementById('currentTime');
                const dateElement = document.getElementById('currentDate');
                if (timeElement) {
                    timeElement.textContent = timeString;
                }
                if (dateElement) {
                    dateElement.textContent = dateString;
                }
            }

            // Update immediately
            updateWIBTime();

            // Update every second
            setInterval(updateWIBTime, 1000);


            // Initialize HSE Line Chart
            const ctx = document.getElementById('hseLineChart');
            if (ctx) {
                // Get data from backend
                const monthLabels = @json($monthLabels ?? []);
                const monthlyData = @json($monthlyData ?? []);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: monthLabels,
                        datasets: [{
                            label: 'Jumlah Laporan HSE',
                            data: monthlyData,
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderWidth: 3,
                            pointRadius: 5,
                            pointBackgroundColor: '#10b981',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointHoverRadius: 7,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 12,
                                        family: 'Inter, sans-serif',
                                        weight: '600'
                                    },
                                    padding: 15,
                                    color: '#475569'
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(15, 23, 42, 0.9)',
                                padding: 12,
                                titleFont: {
                                    size: 13,
                                    family: 'Inter, sans-serif'
                                },
                                bodyFont: {
                                    size: 14,
                                    family: 'Inter, sans-serif',
                                    weight: 'bold'
                                },
                                borderColor: '#10b981',
                                borderWidth: 1,
                                displayColors: false,
                                callbacks: {
                                    label: function (context) {
                                        return context.parsed.y + ' laporan';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 5,
                                    font: {
                                        size: 11,
                                        family: 'Inter, sans-serif'
                                    },
                                    color: '#64748b'
                                },
                                grid: {
                                    color: '#e2e8f0',
                                    drawBorder: false
                                }
                            },
                            x: {
                                ticks: {
                                    font: {
                                        size: 11,
                                        family: 'Inter, sans-serif'
                                    },
                                    color: '#64748b'
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        });

        // HSE Menu Toggle Function
        function toggleHSEMenu() {
            const submenu = document.getElementById('hseSubmenu');
            const icon = document.getElementById('hseToggleIcon');

            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                submenu.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // SCM Menu Toggle Function
        function toggleSCMMenu() {
            const submenu = document.getElementById('scmSubmenu');
            const icon = document.getElementById('scmToggleIcon');

            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                submenu.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        // Logout Modal Function
        function showLogoutModal() {
            if (confirm('Apakah Anda yakin ingin keluar dari sistem?')) {
                document.getElementById('logoutForm').submit();
            }
        }
    </script>
</body>

</html>