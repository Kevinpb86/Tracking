<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS 2 Dashboard - Zona Distribusi</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

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
                class="absolute inset-x-0 top-0 h-48 bg-gradient-to-b from-emerald-100/20 via-emerald-50/10 to-transparent blur-2xl">
            </div>
        </div>

        <button id="sidebarToggle" type="button"
            class="fixed left-4 top-9 z-50 inline-flex h-12 w-12 items-center justify-center rounded-lg border border-slate-200 bg-white text-emerald-600 shadow-sm transition hover:bg-emerald-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2 cursor-pointer sm:left-6 sm:top-10 lg:left-8 lg:top-12"
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
                    class="group relative flex items-center gap-4 rounded-2xl bg-gradient-to-br from-slate-50 to-white p-4 shadow-sm border border-slate-100 transition-all hover:shadow-md hover:border-emerald-100"
                    aria-label="Kembali ke halaman utama">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white p-1 shadow-sm ring-1 ring-slate-900/5 group-hover:scale-105 transition-transform">
                        <img src="{{ asset('images/wgilogo.jpg') }}" alt="Logo PT. WGI"
                            class="h-full w-full rounded-lg object-contain">
                    </div>
                    <div class="space-y-0.5">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-600">Tracking System</p>
                        <p
                            class="text-sm font-bold text-slate-800 leading-tight group-hover:text-emerald-700 transition-colors">
                            PT. Wiraswasta Gemilang Indonesia</p>
                    </div>
                </a>

                {{-- Navigation --}}
                <div class="flex flex-col gap-1">
                    <div class="mb-4 flex items-center justify-between px-2">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Navigasi Pos 2</p>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-emerald-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Live
                        </span>
                    </div>

                    <nav class="space-y-2">
                        {{-- Active Dashboard Link --}}
                        <a href="{{ route('pos2.dashboard') }}"
                            class="flex items-center justify-between rounded-xl bg-emerald-600 px-4 py-3 text-white shadow-lg shadow-emerald-500/30 transition-all hover:bg-emerald-700 hover:shadow-emerald-600/40 hover:-translate-y-0.5">
                            <span class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                </svg>
                                <span class="font-semibold text-sm">Dashboard</span>
                            </span>
                            <div class="h-1.5 w-1.5 rounded-full bg-white/90"></div>
                        </a>

                        {{-- Cek Barang Menu (Adapted from Antrian/CekKendaraan Logic) --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleCekBarangMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-emerald-50/50 hover:text-emerald-700">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100/50 text-emerald-600 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                            <path fill-rule="evenodd"
                                                d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-xs font-bold uppercase tracking-wider text-emerald-500/80">Cek
                                            Barang
                                        </p>
                                        <p>Distribution Check</p>
                                    </div>
                                </span>
                                <svg id="cekBarangToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-emerald-400 transition-transform duration-300 group-hover:text-emerald-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="cekBarangSubmenu" class="hidden space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('cek-barang.create') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>Form Distribusi</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 text-slate-400 group-hover:text-emerald-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('cek-barang.index') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>History Distribusi</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Cek DO Menu Accordion --}}
                        <div class="space-y-1 pt-2">
                            <button type="button" onclick="toggleCekDOMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-emerald-50/50 hover:text-emerald-700">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100/50 text-emerald-600 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm1 2h6v1H7V4zm-1 2a1 1 0 011 1v.01a1 1 0 11-2 0V7a1 1 0 011-1zm2 0h6v2H9V6zm-2 4a1 1 0 011 1v.01a1 1 0 11-2 0V11a1 1 0 011-1zm2 0h6v2H9v-2zm-2 4a1 1 0 011 1v.01a1 1 0 11-2 0V15a1 1 0 011-1zm2 0h6v2H9v-2z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-xs font-bold uppercase tracking-wider text-emerald-500/80">Cek
                                            DO
                                        </p>
                                        <p>Delivery Order Check</p>
                                    </div>
                                </span>
                                <svg id="cekDOToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-emerald-400 transition-transform duration-300 group-hover:text-emerald-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="cekDOSubmenu" class="hidden space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('scm.do-item.index') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>History DO</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 text-slate-400 group-hover:text-emerald-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Tracking Menu Accordion --}}
                        <div class="space-y-1 pt-2">
                            <button type="button" onclick="toggleTrackingMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-emerald-50/50 hover:text-emerald-700">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100/50 text-emerald-600 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-xs font-bold uppercase tracking-wider text-emerald-500/80">
                                            Tracking
                                        </p>
                                        <p>Vehicle Monitoring</p>
                                    </div>
                                </span>
                                <svg id="trackingToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-emerald-400 transition-transform duration-300 group-hover:text-emerald-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="trackingSubmenu" class="hidden space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('tracking.index') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>History Tracking</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 text-slate-400 group-hover:text-emerald-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            {{-- Footer / Profile Section --}}
            <div class="mt-auto border-t border-slate-100 bg-slate-50/50 p-4">
                <div class="mb-4 flex items-center gap-3 rounded-xl bg-white p-3 shadow-sm border border-slate-100">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 font-bold border border-emerald-200">
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
            class="fixed inset-0 z-40 bg-slate-900/10 opacity-0 transition-opacity duration-300 ease-in-out pointer-events-none">
        </div>

        <main class="relative flex min-h-screen flex-col pt-32 sm:pt-36 lg:pt-40">
            <section class="fixed inset-x-0 top-0 z-40">
                <div class="overflow-hidden border-b border-slate-200 bg-white text-slate-700 shadow-sm">
                    <div class="h-3 w-full bg-[#2736a3]"></div>
                    <div class="flex flex-wrap items-center gap-6 px-6 py-6 pl-20 sm:px-10 sm:pl-28">
                        <a href="{{ route('dashboard.main') }}"
                            class="flex min-w-[220px] flex-1 items-center gap-5 text-emerald-900 transition hover:opacity-80"
                            aria-label="Kembali ke halaman utama">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-full border border-emerald-900/20 bg-white p-2 shadow-lg shadow-emerald-900/20">
                                <img src="{{ asset('images/wgilogo.jpg') }}"
                                    alt="Logo PT. Wiraswasta Gemilang Indonesia" class="h-full w-full object-contain">
                            </div>
                            <div class="space-y-1">
                                <span
                                    class="block text-xs font-semibold uppercase tracking-[0.55em] text-slate-500">Tracking
                                    System</span>
                                <div class="text-lg font-bold italic leading-tight text-emerald-900">
                                    <span class="block">PT Wiraswasta Gemilang</span>
                                    <span class="block whitespace-nowrap">Indonesia</span>
                                </div>
                            </div>
                        </a>
                        <div class="hidden h-14 w-0.5 bg-slate-900 sm:ml-5 sm:block lg:ml-10"></div>
                        <div class="flex min-w-[200px] flex-1 justify-center text-center sm:justify-start sm:text-left">
                            <span
                                class="text-base font-medium uppercase tracking-[0.45em] text-slate-500 whitespace-nowrap">
                                Tracking Information System
                            </span>
                        </div>
                        <div class="hidden h-14 w-0.5 bg-slate-900 sm:ml-7 sm:block lg:ml-16 xl:ml-20"></div>
                        <div class="flex min-w-[160px] flex-1 justify-center sm:justify-end">
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

            {{-- Hero Section - Compact Premium Design --}}
            <header class="px-8 pt-8 sm:px-12 lg:px-24">
                <div
                    class="mx-auto rounded-3xl bg-gradient-to-r from-emerald-600 to-emerald-700 py-8 px-6 sm:px-10 shadow-2xl relative overflow-hidden group">
                    {{-- Decorative Elements --}}
                    <div
                        class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-white/10 blur-3xl group-hover:bg-white/20 transition-colors duration-700">
                    </div>
                    <div
                        class="absolute -left-16 -bottom-16 h-48 w-48 rounded-full bg-white/5 blur-3xl group-hover:bg-white/15 transition-colors duration-700">
                    </div>

                    <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-xl space-y-3">
                            <div class="flex items-center gap-3">
                                <span
                                    class="rounded-full bg-white/10 px-3 py-1 text-[8px] font-bold uppercase tracking-[0.3em] text-white border border-white/20">
                                    Distribution Zone
                                </span>
                                <div class="flex items-center gap-2">
                                    <span class="relative flex h-1.5 w-1.5">
                                        <span
                                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-white opacity-75"></span>
                                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-white"></span>
                                    </span>
                                    <span class="text-[8px] font-bold uppercase tracking-widest text-white/80">POS 2
                                        Active</span>
                                </div>
                            </div>
                            <h1 class="text-2xl font-black text-white sm:text-4xl leading-tight tracking-tight">
                                Integrated Monitoring<br><span class="text-emerald-100 italic">Distribution
                                    Center</span>
                            </h1>
                            <p class="text-sm text-emerald-50/80 leading-relaxed max-w-lg">
                                Selamat datang di Pusat Kendali POS 2. Kelola pemeriksaan barang,
                                validasi distribusi, dan quality control PT. WGI secara tersentralisasi.
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-2 lg:w-64">
                            <div
                                class="rounded-2xl border border-white/10 bg-white/10 backdrop-blur-md p-3 text-center hover:bg-white/20 transition-colors">
                                <p class="text-[8px] font-bold uppercase tracking-widest text-emerald-100/70 mb-1">Local
                                    Time</p>
                                <p id="heroTime" class="text-lg font-black text-white">00:00</p>
                            </div>
                            <div
                                class="rounded-2xl border border-white/10 bg-white/10 backdrop-blur-md p-3 text-center hover:bg-white/20 transition-colors">
                                <p class="text-[8px] font-bold uppercase tracking-widest text-emerald-100/70 mb-1">
                                    Region
                                </p>
                                <p class="text-lg font-black text-white">WIB</p>
                            </div>
                            <div
                                class="col-span-2 rounded-2xl border border-white/10 bg-white/10 backdrop-blur-md p-3 flex items-center justify-between hover:bg-white/20 transition-colors">
                                <div class="text-left">
                                    <p class="text-[8px] font-bold uppercase tracking-widest text-emerald-100/70">
                                        Current
                                        Date</p>
                                    <p class="text-[10px] font-bold text-white">{{ $now->format('d F Y') }}</p>
                                </div>
                                <div
                                    class="h-7 w-7 rounded-xl bg-white/20 flex items-center justify-center text-white shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
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

            {{-- Main Content --}}
            <section class="relative mx-auto w-full flex-1 px-8 py-16 sm:px-12 lg:px-24">
                <div class="grid gap-8 lg:grid-cols-3">
                    {{-- Stats Cards --}}
                    <div class="lg:col-span-2 grid gap-6 sm:grid-cols-2">
                        <article
                            class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Total
                                        Distribusi</p>
                                    <p class="mt-1 text-3xl font-black text-slate-900 tracking-tight">
                                        {{ number_format($totalDistribusi) }}
                                    </p>
                                    <p class="mt-2 text-xs text-slate-500 flex items-center gap-1">
                                        <span class="text-emerald-500 font-bold">Total Terdata</span> di sistem
                                    </p>
                                </div>
                            </div>
                        </article>

                        <article
                            class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Hari Ini</p>
                                    <p class="mt-1 text-3xl font-black text-slate-900 tracking-tight">
                                        {{ $distribusiToday }}
                                    </p>
                                    <p class="mt-2 text-xs text-slate-500">
                                        Pemeriksaan di <span
                                            class="text-blue-500 font-bold">{{ now()->format('d M') }}</span>
                                    </p>
                                </div>
                            </div>
                        </article>

                        <article
                            class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Kepatuhan</p>
                                    <p class="mt-1 text-3xl font-black text-slate-900 tracking-tight">
                                        {{ $lolosPercentage }}%
                                    </p>
                                    <p class="mt-2 text-xs text-slate-500">
                                        Status <span class="text-emerald-500 font-bold">Lolos</span> pemeriksaan
                                    </p>
                                </div>
                            </div>
                        </article>

                        <article
                            class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-purple-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Sistem</p>
                                    <p class="mt-1 text-3xl font-black text-slate-900 tracking-tight">Aktif</p>
                                    <p class="mt-2 text-xs text-slate-500">
                                        Data <span class="text-purple-500 font-bold">Terintegrasi</span> real-time
                                    </p>
                                </div>
                            </div>
                        </article>



                        @include('navigasi.pos2_charts')
                    </div>

                    {{-- Info Panel & Quick Nav --}}
                    <div class="space-y-6">
                        {{-- Quick Navigation --}}
                        <article class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
                            <h3
                                class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Akses Cepat
                            </h3>
                            <div class="grid gap-4">
                                <a href="{{ route('cek-barang.create') }}"
                                    class="group flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-emerald-600 hover:border-emerald-500 transition-all duration-300">
                                    <div
                                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p
                                            class="text-sm font-bold text-slate-800 group-hover:text-white transition-colors">
                                            Input Distribusi</p>
                                        <p
                                            class="text-[10px] font-medium text-slate-400 group-hover:text-emerald-100 transition-colors tracking-wide">
                                            Pemeriksaan Barang Baru</p>
                                    </div>
                                </a>

                                <a href="{{ route('cek-barang.index') }}"
                                    class="group flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-blue-600 hover:border-blue-500 transition-all duration-300">
                                    <div
                                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white text-blue-600 shadow-sm group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p
                                            class="text-sm font-bold text-slate-800 group-hover:text-white transition-colors">
                                            History Distribusi</p>
                                        <p
                                            class="text-[10px] font-medium text-slate-400 group-hover:text-blue-100 transition-colors tracking-wide">
                                            Rekap Data & Laporan</p>
                                    </div>
                                </a>
                            </div>
                        </article>

                        <article class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
                            <h3
                                class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Pengingat HSE
                            </h3>
                            <div class="space-y-4">
                                <div class="flex gap-4">
                                    <div class="h-1.5 w-1.5 mt-1.5 rounded-full bg-emerald-500 shrink-0"></div>
                                    <p class="text-xs font-bold text-slate-600 leading-relaxed">
                                        Wajib verifikasi <span class="text-emerald-600 font-extrabold">Seal
                                            Tangki</span> sebelum proses bongkar.
                                    </p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="h-1.5 w-1.5 mt-1.5 rounded-full bg-blue-500 shrink-0"></div>
                                    <p class="text-xs font-bold text-slate-600 leading-relaxed">
                                        Pastikan <span class="text-blue-600 font-extrabold">Grounding</span> terpasang
                                        sempurna pada unit tangki.
                                    </p>
                                </div>
                            </div>
                        </article>

                        <article
                            class="rounded-3xl bg-gradient-to-br from-emerald-600 to-emerald-800 p-6 shadow-xl shadow-emerald-500/20 relative overflow-hidden group">
                            <div
                                class="absolute -right-4 -bottom-4 h-24 w-24 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700">
                            </div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-emerald-200/80 mb-2">
                                Network Status</h3>
                            <p class="text-xl font-black text-white mb-2 italic">✓ Secure & Sync</p>
                            <p class="text-[10px] font-bold text-emerald-100/90 leading-relaxed">
                                Koneksi ke server pusat terjamin aman. Seluruh data diverifikasi secara berkala.
                            </p>
                        </article>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal"
        class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div
            class="relative w-full max-w-sm scale-95 transform overflow-hidden rounded-2xl bg-white text-center shadow-2xl transition-all duration-300">
            <div class="p-8">
                <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-rose-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-rose-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <h3 class="mb-2 text-xl font-bold text-slate-900">Konfirmasi Keluar</h3>
                <p class="text-sm text-slate-500">Apakah Anda yakin ingin mengakhiri sesi ini? Anda harus login kembali
                    untuk mengakses sistem.</p>
            </div>
            <div class="grid grid-cols-2 border-t border-slate-100 bg-slate-50">
                <button onclick="closeLogoutModal()"
                    class="cursor-pointer border-r border-slate-100 px-6 py-4 text-sm font-semibold text-slate-600 transition hover:bg-white hover:text-slate-900 focus:outline-none">
                    Batal
                </button>
                <button onclick="document.getElementById('logoutForm').submit()"
                    class="cursor-pointer px-6 py-4 text-sm font-bold text-rose-600 transition hover:bg-rose-50 focus:outline-none">
                    Ya, Keluar
                </button>
            </div>
        </div>
    </div>

    <script>
        function showLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.remove('hidden');
            // Trigger reflow to enable transition
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            modal.querySelector('div').classList.remove('scale-95');
            modal.querySelector('div').classList.add('scale-100');
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.add('opacity-0');
            modal.querySelector('div').classList.remove('scale-100');
            modal.querySelector('div').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Wait for transition
        }

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
                const wibOffset = 7 * 60;
                const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
                const wibTime = new Date(utc + (wibOffset * 60000));

                const hours = String(wibTime.getHours()).padStart(2, '0');
                const minutes = String(wibTime.getMinutes()).padStart(2, '0');
                const timeString = `${hours}:${minutes}`;

                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ];
                const day = String(wibTime.getDate()).padStart(2, '0');
                const month = months[wibTime.getMonth()];
                const year = wibTime.getFullYear();
                const dateString = `${day} ${month} ${year}`;

                const timeElement = document.getElementById('currentTime');
                const heroTimeElement = document.getElementById('heroTime');
                const dateElement = document.getElementById('currentDate');
                if (timeElement) timeElement.textContent = timeString;
                if (heroTimeElement) heroTimeElement.textContent = timeString;
                if (dateElement) dateElement.textContent = dateString;
            }

            updateWIBTime();
            setInterval(updateWIBTime, 1000);
        });

        // Toggle Cek DO menu (global function)
        function toggleCekDOMenu() {
            const submenu = document.getElementById('cekDOSubmenu');
            const icon = document.getElementById('cekDOToggleIcon');
            if (submenu && icon) {
                if (submenu.classList.contains('hidden')) {
                    submenu.classList.remove('hidden');
                    icon.classList.add('rotate-180');
                } else {
                    submenu.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            }
        }

        // Toggle Cek Barang menu
        function toggleCekBarangMenu() {
            const submenu = document.getElementById('cekBarangSubmenu');
            const icon = document.getElementById('cekBarangToggleIcon');
            if (submenu && icon) {
                if (submenu.classList.contains('hidden')) {
                    submenu.classList.remove('hidden');
                    icon.classList.add('rotate-180');
                } else {
                    submenu.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            }
        }

        // Toggle Tracking menu
        function toggleTrackingMenu() {
            const submenu = document.getElementById('trackingSubmenu');
            const icon = document.getElementById('trackingToggleIcon');
            if (submenu && icon) {
                if (submenu.classList.contains('hidden')) {
                    submenu.classList.remove('hidden');
                    icon.classList.add('rotate-180');
                } else {
                    submenu.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            }
        }
    </script>

    {{-- Chart.js Library --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Distribution Trends Chart
            const trendsCtx = document.getElementById('distributionTrendsChart');
            if (trendsCtx) {
                const monthLabels = @json($monthLabels ?? []);
                const monthlyDistribusi = @json($monthlyDistribusi ?? []);
                const monthlyLolos = @json($monthlyLolos ?? []);
                const monthlyDitahan = @json($monthlyDitahan ?? []);

                new Chart(trendsCtx, {
                    type: 'line',
                    data: {
                        labels: monthLabels,
                        datasets: [
                            {
                                label: 'Total Distribusi',
                                data: monthlyDistribusi,
                                borderColor: '#10b981',
                                backgroundColor: (context) => {
                                    const ctx = context.chart.ctx;
                                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                                    gradient.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
                                    gradient.addColorStop(1, 'rgba(16, 185, 129, 0.0)');
                                    return gradient;
                                },
                                borderWidth: 4,
                                pointRadius: 6,
                                pointBackgroundColor: '#10b981',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 3,
                                pointHoverRadius: 9,
                                pointHoverBorderWidth: 4,
                                fill: true,
                                tension: 0.4
                            },
                            {
                                label: 'Lolos',
                                data: monthlyLolos,
                                borderColor: '#14b8a6',
                                backgroundColor: (context) => {
                                    const ctx = context.chart.ctx;
                                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                                    gradient.addColorStop(0, 'rgba(20, 184, 166, 0.2)');
                                    gradient.addColorStop(1, 'rgba(20, 184, 166, 0.0)');
                                    return gradient;
                                },
                                borderWidth: 3,
                                pointRadius: 5,
                                pointBackgroundColor: '#14b8a6',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointHoverRadius: 8,
                                fill: true,
                                tension: 0.4
                            },
                            {
                                label: 'Ditahan',
                                data: monthlyDitahan,
                                borderColor: '#f59e0b',
                                backgroundColor: (context) => {
                                    const ctx = context.chart.ctx;
                                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                                    gradient.addColorStop(0, 'rgba(245, 158, 11, 0.2)');
                                    gradient.addColorStop(1, 'rgba(245, 158, 11, 0.0)');
                                    return gradient;
                                },
                                borderWidth: 3,
                                pointRadius: 5,
                                pointBackgroundColor: '#f59e0b',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointHoverRadius: 8,
                                fill: true,
                                tension: 0.4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                align: 'end',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    font: {
                                        size: 13,
                                        family: 'Inter, sans-serif',
                                        weight: '700'
                                    },
                                    padding: 20,
                                    color: '#334155',
                                    boxWidth: 8,
                                    boxHeight: 8
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(15, 23, 42, 0.95)',
                                padding: 16,
                                cornerRadius: 12,
                                titleFont: {
                                    size: 14,
                                    family: 'Inter, sans-serif',
                                    weight: '700'
                                },
                                bodyFont: {
                                    size: 15,
                                    family: 'Inter, sans-serif',
                                    weight: 'bold'
                                },
                                borderColor: 'rgba(148, 163, 184, 0.2)',
                                borderWidth: 1,
                                displayColors: true,
                                boxPadding: 6,
                                callbacks: {
                                    label: function (context) {
                                        return ' ' + context.parsed.y + ' distribusi';
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
                                        size: 12,
                                        family: 'Inter, sans-serif',
                                        weight: '600'
                                    },
                                    color: '#64748b'
                                },
                                grid: {
                                    color: 'rgba(148, 163, 184, 0.15)',
                                    drawBorder: false,
                                    lineWidth: 1
                                }
                            },
                            x: {
                                ticks: {
                                    font: {
                                        size: 12,
                                        family: 'Inter, sans-serif',
                                        weight: '600'
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

            // Initialize Quality Breakdown Donut Chart
            const qualityCtx = document.getElementById('qualityBreakdownChart');
            if (qualityCtx) {
                const lolosCount = {{ $lolosCount ?? 0 }};
                const ditahanCount = {{ $ditahanCount ?? 0 }};
                const ditolakCount = {{ $ditolakCount ?? 0 }};

                new Chart(qualityCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Lolos', 'Ditahan', 'Ditolak'],
                        datasets: [{
                            data: [lolosCount, ditahanCount, ditolakCount],
                            backgroundColor: [
                                'rgba(16, 185, 129, 0.8)',
                                'rgba(245, 158, 11, 0.8)',
                                'rgba(239, 68, 68, 0.8)'
                            ],
                            borderColor: [
                                '#10b981',
                                '#f59e0b',
                                '#ef4444'
                            ],
                            borderWidth: 3,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '65%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(15, 23, 42, 0.95)',
                                padding: 12,
                                cornerRadius: 10,
                                titleFont: {
                                    size: 13,
                                    family: 'Inter, sans-serif',
                                    weight: '700'
                                },
                                bodyFont: {
                                    size: 14,
                                    family: 'Inter, sans-serif',
                                    weight: 'bold'
                                },
                                callbacks: {
                                    label: function (context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = total > 0 ? Math.round((context.parsed / total) * 100) : 0;
                                        return ' ' + context.parsed + ' (' + percentage + '%)';
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>