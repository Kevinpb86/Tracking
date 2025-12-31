<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracking Dashboard - Main View</title>
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
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Main Dashboard</p>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-emerald-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Live
                        </span>
                    </div>

                    <nav class="space-y-2">
                        {{-- Active Dashboard Link --}}
                        <a href="{{ route('dashboard.main') }}"
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
                        <a href="{{ route('dashboard.main') }}"
                            class="flex min-w-[220px] flex-1 items-center gap-5 text-blue-900 transition hover:opacity-80"
                            aria-label="Halaman utama">
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

            <header class="px-8 pt-12 sm:px-12 lg:px-24">
                <div
                    class="mx-auto rounded-[2rem] bg-gradient-to-br from-blue-600 via-blue-600 to-blue-700 p-10 shadow-2xl">
                    <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                        <div class="max-w-2xl space-y-6">
                            <div class="flex items-center gap-3">
                                <p class="text-xs font-semibold uppercase tracking-[0.45em] text-blue-100">
                                    Dashboard Utama
                                </p>
                                <div class="flex items-center gap-2">
                                    <span class="relative flex h-2 w-2">
                                        <span
                                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex h-2 w-2 rounded-full bg-green-300"></span>
                                    </span>
                                    <span class="text-xs font-medium text-green-200">Sistem Online</span>
                                </div>
                            </div>
                            <h1 class="text-4xl font-bold text-white sm:text-5xl leading-tight">
                                Selamat Datang di<br>Admin Dashboard
                            </h1>
                            <p class="text-base text-blue-50 leading-relaxed">
                                Kelola validasi kendaraan dan pemeriksaan HSE dengan efisien.<br>
                                Pantau aktivitas terkini dan akses menu cepat di satu tempat.
                            </p>
                        </div>
                        <div
                            class="flex-1 space-y-4 rounded-2xl border border-white/20 bg-white/10 backdrop-blur-sm p-6 text-sm lg:ml-8 lg:max-w-sm">
                            <div class="space-y-3">
                                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-blue-100">
                                    Waktu Operasional
                                </p>
                                <div class="text-4xl font-bold text-white">
                                    <span id="currentTime">{{ $now->format('H:i') }}</span>
                                    <span class="text-2xl font-medium text-blue-200">WIB</span>
                                </div>
                            </div>
                            <div class="border-t border-white/20 pt-3 space-y-2">
                                <div class="flex items-center justify-between text-blue-50">
                                    <span class="text-xs uppercase tracking-[0.25em]">Tanggal</span>
                                    <span id="currentDate"
                                        class="text-sm font-semibold text-white">{{ $now->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center justify-between text-blue-50">
                                    <span class="text-xs uppercase tracking-[0.25em]">Pengguna</span>
                                    <span
                                        class="text-sm font-semibold text-white">{{ Auth::user()->name ?? 'Guest User' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <section class="relative mx-auto w-full flex-1 px-8 py-16 sm:px-12 lg:px-24">
                <div class="grid gap-8 lg:grid-cols-3">
                    {{-- Left Column - Overview (1 column) --}}
                    <div class="space-y-8">
                        <article class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                            <div class="mb-6">
                                <h2 class="text-xs font-semibold uppercase tracking-[0.35em] text-blue-600">Pos Overview
                                </h2>
                                <p class="mt-2 text-2xl font-bold text-slate-900">Informasi Pos</p>
                                <p class="mt-4 text-sm text-slate-600">
                                    Setiap pos dioptimalkan untuk memantau arus kendaraan dan aktivitas distribusi.
                                    Ketuk menu untuk menavigasi proses operasional masing-masing pos.
                                </p>
                            </div>
                            <div class="space-y-4">
                                <div class="rounded-2xl border border-blue-100 bg-blue-50 p-5 text-sm">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500 text-white font-bold text-sm">
                                            1
                                        </div>
                                        <p class="text-xs uppercase tracking-[0.3em] text-blue-500 font-semibold">POS 1
                                        </p>
                                    </div>
                                    <p class="font-bold text-blue-900 text-base mb-1">Pusat Pemeriksaan Kedatangan</p>
                                    <p class="text-xs text-blue-700">
                                        Validasi dokumen dan kelengkapan kendaraan sebelum memasuki area utama.
                                    </p>
                                </div>
                                <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5 text-sm">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500 text-white font-bold text-sm">
                                            2
                                        </div>
                                        <p class="text-xs uppercase tracking-[0.3em] text-emerald-500 font-semibold">POS
                                            2</p>
                                    </div>
                                    <p class="font-bold text-emerald-900 text-base mb-1">Zona Pengawasan Distribusi</p>
                                    <p class="text-xs text-emerald-700">
                                        Memastikan proses muat dan bongkar berjalan sesuai standar keselamatan.
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>

                    {{-- Main Content Column (2 columns) --}}
                    <div class="lg:col-span-2 space-y-8">
                        {{-- HSE Line Chart --}}
                        <article class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                            <div class="mb-6">
                                <h2 class="text-xs font-semibold uppercase tracking-[0.35em] text-emerald-600">Grafik
                                    HSE</h2>
                                <p class="mt-2 text-2xl font-bold text-slate-900">Tren Laporan HSE Bulanan</p>
                                <p class="mt-2 text-sm text-slate-600">
                                    Visualisasi jumlah laporan HSE per bulan dalam 6 bulan terakhir.
                                </p>
                            </div>
                            <div class="relative h-80">
                                <canvas id="hseLineChart"></canvas>
                            </div>
                        </article>

                        {{-- Insight Section (moved here) --}}
                        <article class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                            <div class="mb-6">
                                <h2 class="text-xs font-semibold uppercase tracking-[0.35em] text-blue-600">Insight</h2>
                                <p class="mt-2 text-lg font-bold text-slate-900">Catatan Singkat</p>
                                <p class="mt-2 text-xs text-slate-600">
                                    Gunakan insight berikut sebagai pengingat saat menjalankan aktivitas operasional
                                    harian.
                                </p>
                            </div>
                            <div class="space-y-3">
                                <div class="rounded-xl border-l-4 border-amber-400 bg-amber-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.3em] text-amber-600 font-semibold mb-1">
                                        Prioritas</p>
                                    <p class="text-sm font-semibold text-amber-900">Koordinasi antar pos mempercepat
                                        alur distribusi.</p>
                                </div>
                                <div class="rounded-xl border-l-4 border-emerald-400 bg-emerald-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.3em] text-emerald-600 font-semibold mb-1">
                                        Keselamatan</p>
                                    <p class="text-sm font-semibold text-emerald-900">Periksa ulang kelengkapan HSE
                                        sebelum proses bongkar.</p>
                                </div>
                            </div>
                        </article>

                        {{-- Status Real-Time --}}
                        <article class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
                                <div>
                                    <h2 class="text-xs font-semibold uppercase tracking-[0.35em] text-blue-600">
                                        Status Real-Time
                                    </h2>
                                    <p class="mt-2 text-2xl font-bold text-slate-900">Aktivitas Operasional</p>
                                </div>
                                <button type="button" onclick="window.location.reload()"
                                    class="inline-flex items-center gap-2 rounded-xl bg-blue-50 px-4 py-2.5 text-xs font-bold uppercase tracking-wide text-blue-600 transition hover:bg-blue-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Refresh
                                </button>
                            </div>

                            <div class="grid gap-5 sm:grid-cols-2">
                                <div class="rounded-xl bg-blue-50 p-6">
                                    <div class="flex items-start gap-4">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs uppercase tracking-[0.3em] text-blue-500 font-semibold">
                                                Kedatangan</p>
                                            <p class="mt-2 text-2xl font-bold text-blue-900">Terpantau</p>
                                            <p class="mt-2 text-xs text-blue-700">
                                                Data kendaraan yang memasuki area plant tercatat secara sistematis.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="rounded-xl bg-emerald-50 p-6">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p
                                                class="text-xs uppercase tracking-[0.3em] text-emerald-500 font-semibold">
                                                Keamanan</p>
                                            <p class="mt-2 text-2xl font-bold text-emerald-900">Terkendali</p>
                                            <p class="mt-2 text-xs text-emerald-700">
                                                SOP keselamatan diterapkan di seluruh pos untuk memastikan kepatuhan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="rounded-xl bg-amber-50 p-6">
                                    <div class="flex items-start gap-4">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs uppercase tracking-[0.3em] text-amber-500 font-semibold">
                                                Penjadwalan</p>
                                            <p class="mt-2 text-2xl font-bold text-amber-900">Efisien</p>
                                            <p class="mt-2 text-xs text-amber-700">
                                                Sistem memberikan jadwal otomatis agar tidak terjadi penumpukan
                                                kendaraan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="rounded-xl bg-purple-50 p-6">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs uppercase tracking-[0.3em] text-purple-500 font-semibold">
                                                Laporan</p>
                                            <p class="mt-2 text-2xl font-bold text-purple-900">Real-Time</p>
                                            <p class="mt-2 text-xs text-purple-700">
                                                Catatan aktivitas tersinkronisasi otomatis sehingga mudah dianalisis.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
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