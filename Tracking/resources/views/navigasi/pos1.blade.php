<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS 1 Dashboard - Checkpoint Kedatangan</title>
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
                    aria-label="Kembali ke halaman utama">
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
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Navigasi Pos 1</p>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-blue-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                            Live
                        </span>
                    </div>

                    <nav class="space-y-2">
                        {{-- Active Dashboard Link --}}
                        <a href="{{ route('pos1.dashboard') }}"
                            class="flex items-center justify-between rounded-xl bg-blue-600 px-4 py-3 text-white shadow-lg shadow-blue-500/30 transition-all hover:bg-blue-700 hover:shadow-blue-600/40 hover:-translate-y-0.5">
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

                        {{-- Antrian Link --}}
                        <a href="#"
                            class="group flex items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-slate-50 hover:text-blue-600">
                            <span class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-slate-400 transition-colors group-hover:text-blue-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                </svg>
                                <span class="font-medium text-sm">Daftar Antrian</span>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-300 transition-transform group-hover:translate-x-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        {{-- HSE Menu Accordion --}}
                        <div class="space-y-1 pt-2">
                            <button type="button" onclick="toggleHSEMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-emerald-50/50 hover:text-emerald-700">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100/50 text-emerald-600 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                            <path fill-rule="evenodd"
                                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-xs font-bold uppercase tracking-wider text-emerald-500/80">HSE
                                        </p>
                                        <p>Safety & Environment</p>
                                    </div>
                                </span>
                                <svg id="hseToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-emerald-400 transition-transform duration-300 group-hover:text-emerald-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="hseSubmenu" class="hidden space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('hse.input') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>Input Data Baru</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('hse.daftar') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>Daftar Laporan</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
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
            class="fixed inset-0 z-40 bg-slate-900/10 opacity-0 transition-opacity duration-300 ease-in-out pointer-events-none">
        </div>

        <main class="relative flex min-h-screen flex-col pt-32 sm:pt-36 lg:pt-40">
            <section class="fixed inset-x-0 top-0 z-40">
                <div class="overflow-hidden border-b border-slate-200 bg-white text-slate-700 shadow-sm">
                    <div class="h-3 w-full bg-[#2736a3]"></div>
                    <div class="flex flex-wrap items-center gap-6 px-6 py-6 pl-20 sm:px-10 sm:pl-28">
                        <a href="{{ route('dashboard.main') }}"
                            class="flex min-w-[220px] flex-1 items-center gap-5 text-blue-900 transition hover:opacity-80"
                            aria-label="Kembali ke halaman utama">
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
                        </a>
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



            <section class="relative mx-auto w-full flex-1 px-8 py-12 sm:px-12 lg:px-24">
                {{-- Hero Section --}}
                <div
                    class="mb-12 rounded-3xl bg-gradient-to-r from-blue-600 to-blue-700 p-10 text-white shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -mb-10 -ml-10 h-64 w-64 rounded-full bg-white/10 blur-3xl">
                    </div>

                    <div class="relative z-10 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                        <div>
                            <div class="mb-2 flex items-center gap-2">
                                <span
                                    class="rounded-full bg-blue-500/30 px-3 py-1 text-xs font-bold uppercase tracking-wider backdrop-blur-sm border border-white/20">
                                    Dashboard Utama
                                </span>
                                <span class="flex h-2 w-2 rounded-full bg-blue-400"></span>
                                <span class="text-xs font-medium text-blue-100">Sistem Online</span>
                            </div>
                            <h1 class="text-4xl font-bold leading-tight sm:text-5xl">
                                Selamat Datang di <br />
                                <span class="text-blue-200">Checkpoint Pos 1</span>
                            </h1>
                            <p class="mt-4 max-w-xl text-lg text-blue-100/90 font-light">
                                Kelola validasi kendaraan dan pemeriksaan HSE dengan efisien. Pantau aktivitas terkini
                                dan akses menu cepat di satu tempat.
                            </p>
                        </div>

                        <div
                            class="flex flex-col gap-4 rounded-2xl bg-white/10 p-6 backdrop-blur-md border border-white/20 min-w-[280px]">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-widest text-blue-200">Waktu Operasional
                                </p>
                                <p id="heroTime" class="text-3xl font-bold tracking-tight">{{ $now->format('H:i') }}
                                    <span class="text-lg font-medium text-blue-300">WIB</span>
                                </p>
                            </div>
                            <div class="h-px w-full bg-white/20"></div>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-widest text-blue-200">Tanggal</p>
                                <p class="text-lg font-medium">{{ $now->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Stats Grid --}}
                <div class="mb-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Stat Card 1 -->
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white p-6 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl">
                        <div
                            class="absolute right-0 top-0 h-24 w-24 translate-x-8 translate-y-[-20%] rounded-full bg-blue-50 transition-all group-hover:scale-110">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Kendaraan</p>
                            <p class="mt-2 text-3xl font-bold text-slate-900">24</p>
                            <div class="mt-2 flex items-center text-xs font-medium text-blue-600">
                                <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                +12% dari kemarin
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 2 -->
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white p-6 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl">
                        <div
                            class="absolute right-0 top-0 h-24 w-24 translate-x-8 translate-y-[-20%] rounded-full bg-blue-50 transition-all group-hover:scale-110">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Validasi OK</p>
                            <p class="mt-2 text-3xl font-bold text-slate-900">100%</p>
                            <div class="mt-2 flex items-center text-xs font-medium text-slate-400">
                                Semua dokumen lengkap
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 3 -->
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white p-6 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl">
                        <div
                            class="absolute right-0 top-0 h-24 w-24 translate-x-8 translate-y-[-20%] rounded-full bg-amber-50 transition-all group-hover:scale-110">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100 text-amber-600 shadow-sm group-hover:bg-amber-600 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Peringatan HSE</p>
                            <p class="mt-2 text-3xl font-bold text-slate-900">0</p>
                            <div class="mt-2 flex items-center text-xs font-medium text-blue-600">
                                Aman terkendali
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 4 -->
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white p-6 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl">
                        <div
                            class="absolute right-0 top-0 h-24 w-24 translate-x-8 translate-y-[-20%] rounded-full bg-indigo-50 transition-all group-hover:scale-110">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Avg. Waktu</p>
                            <p class="mt-2 text-3xl font-bold text-slate-900">5 <span
                                    class="text-base font-medium text-slate-500">Menit</span></p>
                            <div class="mt-2 flex items-center text-xs font-medium text-blue-600">
                                <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                Lebih cepat 2m
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Two Column Layout: Quick Actions & Activity --}}
                <div class="grid gap-8 lg:grid-cols-12">
                    {{-- Left Column: Quick Actions & Menus --}}
                    <div class="lg:col-span-8 space-y-8">
                        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                            <div class="mb-6 flex items-center justify-between">
                                <div>
                                    <h2 class="text-xl font-bold text-slate-900">Akses Cepat</h2>
                                    <p class="text-sm text-slate-500">Jalan pintas untuk tugas harian Anda</p>
                                </div>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <a href="{{ route('hse.input') }}"
                                    class="group relative flex items-center gap-4 overflow-hidden rounded-2xl border-2 border-slate-100 bg-white p-5 transition-all hover:border-blue-500 hover:shadow-md hover:shadow-emerald-500/10">
                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 group-hover:text-blue-700">Input HSE Baru
                                        </h3>
                                        <p class="text-xs text-slate-500">Catat pemeriksaan keselamatan</p>
                                    </div>
                                </a>

                                <a href="{{ route('hse.daftar') }}"
                                    class="group relative flex items-center gap-4 overflow-hidden rounded-2xl border-2 border-slate-100 bg-white p-5 transition-all hover:border-blue-500 hover:shadow-md hover:shadow-blue-500/10">
                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 group-hover:text-blue-700">Daftar Laporan
                                        </h3>
                                        <p class="text-xs text-slate-500">Lihat history data HSE</p>
                                    </div>
                                </a>

                                <button
                                    class="group relative flex items-center gap-4 overflow-hidden rounded-2xl border-2 border-slate-100 bg-slate-50 p-5 transition-all hover:border-slate-300">
                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-slate-200 text-slate-500 transition-colors group-hover:bg-slate-600 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 4.25A2.25 2.25 0 0 1 5.25 2h9.5A2.25 2.25 0 0 1 17 4.25v11.5A2.25 2.25 0 0 1 14.75 18h-9.5A2.25 2.25 0 0 1 3 15.75V4.25Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900">Daftar Antrian</h3>
                                        <p class="text-xs text-slate-500">Segera Hadir</p>
                                    </div>
                                </button>

                                <button
                                    class="group relative flex items-center gap-4 overflow-hidden rounded-2xl border-2 border-slate-100 bg-slate-50 p-5 transition-all hover:border-slate-300">
                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-slate-200 text-slate-500 transition-colors group-hover:bg-slate-600 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900">Bantuan</h3>
                                        <p class="text-xs text-slate-500">Dokumentasi & Panduan</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Activity or Info --}}
                    <div class="lg:col-span-4 space-y-8">
                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-slate-500">Aktivitas Terkini
                            </h3>
                            <div class="relative pl-6 border-l-2 border-slate-100 space-y-8">
                                <div class="relative">
                                    <span
                                        class="absolute -left-[29px] top-1 flex h-4 w-4 items-center justify-center rounded-full bg-blue-100 ring-4 ring-white">
                                        <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                                    </span>
                                    <p class="text-sm font-semibold text-slate-900">Sistem Siap</p>
                                    <p class="text-xs text-slate-500">Hari ini, {{ $now->format('H:i') }}</p>
                                </div>
                                <div class="relative">
                                    <span
                                        class="absolute -left-[29px] top-1 flex h-4 w-4 items-center justify-center rounded-full bg-blue-100 ring-4 ring-white">
                                        <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                                    </span>
                                    <p class="text-sm font-semibold text-slate-900">Login Petugas</p>
                                    <p class="text-xs text-slate-500">{{ Auth::user()->name }} masuk ke sistem</p>
                                </div>
                                <div class="relative">
                                    <span
                                        class="absolute -left-[29px] top-1 flex h-4 w-4 items-center justify-center rounded-full bg-slate-100 ring-4 ring-white">
                                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                                    </span>
                                    <p class="text-sm font-semibold text-slate-900">Maintenance</p>
                                    <p class="text-xs text-slate-500">Kemarin, 14:00</p>
                                </div>
                            </div>
                        </div>

                        <article
                            class="rounded-3xl bg-gradient-to-br from-slate-900 to-slate-800 p-6 text-white shadow-lg">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <h3 class="font-bold">Info Penting</h3>
                            </div>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                Pastikan APD lengkap saat memasuki area produksi. Gunakan formulir HSE untuk melaporkan
                                ketidaksesuaian.
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
                // WIB is UTC+7
                const wibOffset = 7 * 60; // 7 hours in minutes
                const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
                const wibTime = new Date(utc + (wibOffset * 60000));

                // Format time
                const hours = String(wibTime.getHours()).padStart(2, '0');
                const minutes = String(wibTime.getMinutes()).padStart(2, '0');
                const timeString = `${hours}:${minutes}`;

                // Format date
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                const dayName = days[wibTime.getDay()];
                const day = String(wibTime.getDate()).padStart(2, '0');
                const month = months[wibTime.getMonth()];
                const year = wibTime.getFullYear();
                const dateString = `${day} ${month} ${year}`;

                // Update DOM elements for old header (if they still exist)
                const timeElement = document.getElementById('currentTime');
                const dateElement = document.getElementById('currentDate');
                if (timeElement) {
                    timeElement.textContent = `${timeString} WIB`;
                }
                if (dateElement) {
                    dateElement.textContent = dateString;
                }

                // Update DOM elements for Hero Section
                const heroTimeElement = document.getElementById('heroTime');
                if (heroTimeElement) {
                    // Update content while preserving the "WIB" span styling
                    heroTimeElement.innerHTML = `${timeString} <span class="text-lg font-medium text-blue-300">WIB</span>`;
                }
            }

            // Update immediately
            updateWIBTime();

            // Update every second
            setInterval(updateWIBTime, 1000);
        });

        // Toggle HSE menu (global function)
        function toggleHSEMenu() {
            const submenu = document.getElementById('hseSubmenu');
            const icon = document.getElementById('hseToggleIcon');
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
</body>

</html>