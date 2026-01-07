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

                        {{-- Antrian Menu Accordion --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleAntrianMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-blue-50/50 hover:text-blue-700">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100/50 text-blue-600 transition-colors group-hover:bg-blue-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-xs font-bold uppercase tracking-wider text-blue-500/80">Antrian
                                        </p>
                                        <p>Queue Management</p>
                                    </div>
                                </span>
                                <svg id="antrianToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-blue-400 transition-transform duration-300 group-hover:text-blue-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="antrianSubmenu" class="hidden space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('pos1.antrian.input') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>Input Antrian</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('pos1.antrian.daftar') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>History Antrian</span>
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

                        {{-- Cek Kendaraan Menu Accordion --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleCekKendaraanMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-blue-50/50 hover:text-blue-700">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100/50 text-blue-600 transition-colors group-hover:bg-blue-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-xs font-bold uppercase tracking-wider text-blue-500/80">Cek
                                            Kendaraan
                                        </p>
                                        <p>Vehicle Inspection</p>
                                    </div>
                                </span>
                                <svg id="cekKendaraanToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-blue-400 transition-transform duration-300 group-hover:text-blue-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="cekKendaraanSubmenu" class="hidden space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('cek-kendaraan.input') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>Input Pemeriksaan</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('cek-kendaraan.daftar') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>History Pemeriksaan</span>
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
                                        <span>Input HSE</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('hse.daftar') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>History Laporan</span>
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

                        {{-- Tracking Menu Accordion --}}
                        <div class="space-y-1 pt-2">
                            <button type="button" onclick="toggleTrackingMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-blue-50/50 hover:text-blue-800">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100/50 text-blue-600 transition-colors group-hover:bg-blue-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                            <path fill-rule="evenodd"
                                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-xs font-bold uppercase tracking-wider text-blue-500/80">
                                            Tracking
                                        </p>
                                        <p>Vehicle Monitoring</p>
                                    </div>
                                </span>
                                <svg id="trackingToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-blue-400 transition-transform duration-300 group-hover:text-blue-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="trackingSubmenu" class="hidden space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('tracking.create') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>Form Tracking</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('tracking.index') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>History Tracking</span>
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
                {{-- Hero Section - PREMIUM REDESIGN --}}
                <div
                    class="mb-8 rounded-3xl bg-gradient-to-r from-blue-600 to-blue-700 py-8 px-6 sm:px-10 shadow-2xl relative overflow-hidden group">
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
                                    Checkpoint Station
                                </span>
                                <div class="flex items-center gap-2">
                                    <span class="relative flex h-1.5 w-1.5">
                                        <span
                                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-white opacity-75"></span>
                                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-white"></span>
                                    </span>
                                    <span class="text-[8px] font-bold uppercase tracking-widest text-white/80">POS 1
                                        Active</span>
                                </div>
                            </div>
                            <h1 class="text-2xl font-black text-white sm:text-4xl leading-tight tracking-tight">
                                Integrated Monitoring<br><span class="text-blue-100 italic">Terminal Arrival</span>
                            </h1>
                            <p class="text-sm text-blue-50/80 leading-relaxed max-w-lg">
                                Selamat datang di Pusat Kendali POS 1. Kelola validasi kendaraan,
                                pemeriksaan HSE, dan antrian logistik PT. WGI secara tersentralisasi.
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-2 lg:w-64">
                            <div
                                class="rounded-2xl border border-white/10 bg-white/10 backdrop-blur-md p-3 text-center hover:bg-white/20 transition-colors">
                                <p class="text-[8px] font-bold uppercase tracking-widest text-blue-100/70 mb-1">Local
                                    Time</p>
                                <p id="heroTime" class="text-lg font-black text-white">00:00</p>
                            </div>
                            <div
                                class="rounded-2xl border border-white/10 bg-white/10 backdrop-blur-md p-3 text-center hover:bg-white/20 transition-colors">
                                <p class="text-[8px] font-bold uppercase tracking-widest text-blue-100/70 mb-1">Region
                                </p>
                                <p class="text-lg font-black text-white">WIB</p>
                            </div>
                            <div
                                class="col-span-2 rounded-2xl border border-white/10 bg-white/10 backdrop-blur-md p-3 flex items-center justify-between hover:bg-white/20 transition-colors">
                                <div class="text-left">
                                    <p class="text-[8px] font-bold uppercase tracking-widest text-blue-100/70">Current
                                        Date</p>
                                    <p class="text-[10px] font-bold text-white">{{ $now->format('d F Y') }}</p>
                                </div>
                                <div
                                    class="h-7 w-7 rounded-xl bg-white/20 flex items-center justify-center text-white shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Stats Grid - PREMIUM REDESIGN --}}
                <div class="mb-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Stat Card 1: Total Kendaraan -->
                    <div
                        class="group relative overflow-hidden rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div
                            class="absolute -right-6 -top-6 h-28 w-28 rounded-full bg-blue-50/50 transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-200 transition-transform group-hover:rotate-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                </svg>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Kendaraan
                                </p>
                                <div class="flex items-baseline gap-2">
                                    <p class="text-3xl font-black text-slate-900 tracking-tight">24</p>
                                    <span class="text-xs font-bold text-blue-600">+12%</span>
                                </div>
                                <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-blue-600 rounded-full" style="width: 65%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 2: Validasi OK -->
                    <div
                        class="group relative overflow-hidden rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div
                            class="absolute -right-6 -top-6 h-28 w-28 rounded-full bg-emerald-50/50 transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500 text-white shadow-lg shadow-emerald-100 transition-transform group-hover:rotate-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Validasi OK</p>
                                <div class="flex items-baseline gap-2">
                                    <p class="text-3xl font-black text-slate-900 tracking-tight">100%</p>
                                    <span class="text-[10px] font-medium text-emerald-600">Perfect</span>
                                </div>
                                <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-500 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 3: Peringatan HSE -->
                    <div
                        class="group relative overflow-hidden rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div
                            class="absolute -right-6 -top-6 h-28 w-28 rounded-full bg-amber-50 transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-500 text-white shadow-lg shadow-amber-100 transition-transform group-hover:rotate-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Peringatan HSE
                                </p>
                                <div class="flex items-baseline gap-2">
                                    <p class="text-3xl font-black text-slate-900 tracking-tight">0</p>
                                    <span class="text-[10px] font-medium text-blue-500">Secured</span>
                                </div>
                                <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-blue-400 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 4: Avg. Waktu -->
                    <div
                        class="group relative overflow-hidden rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div
                            class="absolute -right-6 -top-6 h-28 w-28 rounded-full bg-indigo-50 transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-100 transition-transform group-hover:rotate-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Avg. Service
                                    Time</p>
                                <div class="flex items-baseline gap-2">
                                    <p class="text-3xl font-black text-slate-900 tracking-tight">5.2</p>
                                    <span class="text-xs font-bold text-indigo-600">min</span>
                                </div>
                                <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 rounded-full" style="width: 45%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- HSE Compliance Trends Chart --}}
                <div class="mb-10">
                    <article
                        class="group relative overflow-hidden rounded-[2.5rem] border border-slate-200 bg-gradient-to-br from-white via-blue-50/30 to-indigo-50/30 p-10 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-slate-300/50 transition-all duration-500">
                        {{-- Decorative Background Elements --}}
                        <div
                            class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-gradient-to-br from-blue-400/10 to-indigo-400/10 blur-3xl group-hover:scale-110 transition-transform duration-700">
                        </div>
                        <div
                            class="absolute -left-20 -bottom-20 h-64 w-64 rounded-full bg-gradient-to-tr from-indigo-400/10 to-blue-400/10 blur-3xl group-hover:scale-110 transition-transform duration-700">
                        </div>

                        <div class="relative z-10">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg shadow-blue-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-blue-600">
                                            HSE Analytics</h2>
                                    </div>
                                    <p class="text-2xl font-black text-slate-900 tracking-tight">HSE Compliance Trends
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1 font-medium">Perbandingan supir lulus vs tidak
                                        lulus - 6 bulan terakhir</p>
                                </div>
                                <div
                                    class="flex items-center gap-2 rounded-xl bg-white/80 backdrop-blur-sm border border-slate-200/50 p-1 shadow-sm">
                                    <button
                                        class="px-4 py-2 text-xs font-bold text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md shadow-blue-200">Monthly</button>
                                    <button
                                        class="px-4 py-2 text-xs font-bold text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-lg transition-all">Weekly</button>
                                </div>
                            </div>

                            {{-- Chart Container with Premium Styling --}}
                            <div
                                class="relative rounded-2xl bg-white/60 backdrop-blur-sm border border-slate-200/50 p-6 shadow-inner">
                                <div class="relative h-[400px]">
                                    <canvas id="hseLineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                {{-- Two Column Layout: Quick Actions & Activity --}}
                <div class="grid gap-8 lg:grid-cols-12">
                    {{-- Left Column: Quick Actions & Menus --}}
                    <div class="lg:col-span-8 space-y-8">
                        <div
                            class="rounded-[2.5rem] border border-slate-200 bg-white p-10 shadow-sm relative overflow-hidden">
                            <div
                                class="absolute right-0 top-0 h-40 w-40 bg-blue-50/50 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl">
                            </div>

                            <div class="mb-10 flex items-center justify-between relative z-10">
                                <div>
                                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Operations Control
                                    </h2>
                                    <p class="text-sm font-medium text-slate-500">Akses cepat modul operasional Terminal
                                        POS 1</p>
                                </div>
                                <div
                                    class="h-12 w-12 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                    </svg>
                                </div>
                            </div>

                            <div class="grid gap-6 sm:grid-cols-2 relative z-10">
                                {{-- HSE Entry --}}
                                <a href="{{ route('hse.input') }}"
                                    class="group relative flex flex-col gap-4 rounded-3xl border border-slate-100 bg-white p-6 transition-all duration-300 hover:border-blue-200 hover:shadow-xl hover:-translate-y-1">
                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-blue-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3
                                            class="font-black text-slate-900 group-hover:text-blue-600 transition-colors">
                                            Input HSE Baru</h3>
                                        <p class="text-xs font-medium text-slate-400 leading-relaxed mt-1">Registrasi
                                            pemeriksaan kesehatan dan keselamatan kerja.</p>
                                    </div>
                                    <div class="mt-2 flex items-center justify-between">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-blue-500">Security
                                            Check</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 text-slate-300 group-hover:text-blue-500 transition-colors"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </div>
                                </a>

                                {{-- HSE List --}}
                                <a href="{{ route('hse.daftar') }}"
                                    class="group relative flex flex-col gap-4 rounded-3xl border border-slate-100 bg-white p-6 transition-all duration-300 hover:border-blue-200 hover:shadow-xl hover:-translate-y-1">
                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition-colors group-hover:bg-indigo-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-indigo-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3
                                            class="font-black text-slate-900 group-hover:text-indigo-600 transition-colors">
                                            History Laporan</h3>
                                        <p class="text-xs font-medium text-slate-400 leading-relaxed mt-1">Pantau dan
                                            kelola riwayat pemeriksaan berkala.</p>
                                    </div>
                                    <div class="mt-2 flex items-center justify-between">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-indigo-500">Data
                                            Logs</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 text-slate-300 group-hover:text-indigo-500 transition-colors"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </div>
                                </a>

                                {{-- Vehicle Check --}}
                                <a href="{{ route('cek-kendaraan.input') }}"
                                    class="group relative flex flex-col gap-4 rounded-3xl border border-slate-100 bg-white p-6 transition-all duration-300 hover:border-sky-200 hover:shadow-xl hover:-translate-y-1">
                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-sky-50 text-sky-600 transition-colors group-hover:bg-sky-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-sky-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                            <path
                                                d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v8.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0017 7h-3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3
                                            class="font-black text-slate-900 group-hover:text-sky-600 transition-colors">
                                            Cek Kendaraan</h3>
                                        <p class="text-xs font-medium text-slate-400 leading-relaxed mt-1">Validasi
                                            kelayakan dan keamanan armada pengangkut.</p>
                                    </div>
                                    <div class="mt-2 flex items-center justify-between">
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-sky-500">Fleet
                                            Control</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 text-slate-300 group-hover:text-sky-500 transition-colors"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </div>
                                </a>

                                {{-- Help/Support --}}
                                <a href="#"
                                    class="group relative flex flex-col gap-4 rounded-3xl border border-slate-100 bg-slate-50 p-6 transition-all duration-300 hover:border-slate-200 hover:shadow-xl hover:-translate-y-1">
                                    <div
                                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white border border-slate-100 text-slate-400 transition-all group-hover:bg-slate-900 group-hover:text-white group-hover:shadow-lg group-hover:shadow-slate-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3
                                            class="font-black text-slate-900 group-hover:text-slate-900 transition-colors">
                                            Bantuan Sistem</h3>
                                        <p class="text-xs font-medium text-slate-400 leading-relaxed mt-1">Panduan
                                            penggunaan dan support teknis operasional.</p>
                                    </div>
                                    <div class="mt-2 flex items-center justify-between">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Documentation</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 text-slate-300 group-hover:text-slate-900 transition-colors"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Activity or Info --}}
                    <div class="lg:col-span-4 space-y-6">
                        <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                            <div class="mb-8 flex items-center justify-between">
                                <h3 class="text-sm font-black uppercase tracking-widest text-slate-400">Live Activity
                                </h3>
                                <span class="flex h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
                            </div>

                            <div
                                class="space-y-8 relative before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-100">
                                <div class="relative pl-8">
                                    <div
                                        class="absolute left-0 top-1 h-6 w-6 rounded-full bg-blue-600 border-4 border-white shadow-md">
                                    </div>
                                    <p class="text-sm font-black text-slate-800 tracking-tight">System Operational</p>
                                    <p class="text-[10px] font-bold text-blue-500 uppercase tracking-widest mt-0.5">
                                        Today, {{ $now->format('H:i') }}</p>
                                </div>
                                <div class="relative pl-8">
                                    <div
                                        class="absolute left-0 top-1 h-6 w-6 rounded-full bg-slate-200 border-4 border-white shadow-md">
                                    </div>
                                    <p class="text-sm font-bold text-slate-600 tracking-tight">Session Authenticated</p>
                                    <p class="text-[10px] font-medium text-slate-400 mt-0.5">{{ Auth::user()->name }}
                                        Logged In</p>
                                </div>
                                <div class="relative pl-8">
                                    <div
                                        class="absolute left-0 top-1 h-6 w-6 rounded-full bg-slate-100 border-4 border-white shadow-md">
                                    </div>
                                    <p class="text-sm font-bold text-slate-400 tracking-tight">Security Protocol Active
                                    </p>
                                    <p class="text-[10px] font-medium text-slate-400 mt-0.5">Terminal Standard Applied
                                    </p>
                                </div>
                            </div>

                            <button
                                class="mt-10 w-full rounded-2xl bg-slate-50 border border-slate-100 py-3 text-xs font-bold text-slate-500 hover:bg-slate-100 transition-colors">
                                View Security Logs
                            </button>
                        </div>

                        <div
                            class="group relative overflow-hidden rounded-[2.5rem] bg-slate-900 p-8 text-white shadow-xl">
                            <div
                                class="absolute -right-10 -top-10 h-32 w-32 bg-blue-600/20 rounded-full blur-2xl group-hover:bg-blue-600/30 transition-colors duration-500">
                            </div>

                            <div class="relative z-10">
                                <div
                                    class="mb-6 flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 border border-white/20 backdrop-blur-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-black tracking-tight mb-3">Core Policy</h3>
                                <p class="text-sm text-slate-400 leading-relaxed mb-6 font-medium">
                                    Pastikan seluruh armada mematuhi standar HSE demi keamanan operasional PT. WGI.
                                    Laporkan ketidaksesuaian segera.
                                </p>
                                <div
                                    class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-blue-400">
                                    <span>Safety First</span>
                                    <span class="h-1 w-1 rounded-full bg-blue-500"></span>
                                    <span>Zero Incident</span>
                                </div>
                            </div>
                        </div>
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

        // Toggle Antrian menu (global function)
        function toggleAntrianMenu() {
            const submenu = document.getElementById('antrianSubmenu');
            const icon = document.getElementById('antrianToggleIcon');
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

        // Toggle Cek Kendaraan menu (global function)
        function toggleCekKendaraanMenu() {
            const submenu = document.getElementById('cekKendaraanSubmenu');
            const icon = document.getElementById('cekKendaraanToggleIcon');
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

        // Toggle Tracking menu (global function)
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
            // Initialize HSE Line Chart - Pass vs Fail Comparison
            const ctx = document.getElementById('hseLineChart');
            if (ctx) {
                // Get data from backend
                const monthLabels = @json($monthLabels ?? []);
                const passedData = @json($passedData ?? []);
                const failedData = @json($failedData ?? []);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: monthLabels,
                        datasets: [
                            {
                                label: 'Supir Lulus HSE',
                                data: passedData,
                                borderColor: '#3b82f6',
                                backgroundColor: (context) => {
                                    const ctx = context.chart.ctx;
                                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                                    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
                                    gradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)');
                                    return gradient;
                                },
                                borderWidth: 4,
                                pointRadius: 6,
                                pointBackgroundColor: '#3b82f6',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 3,
                                pointHoverRadius: 9,
                                pointHoverBorderWidth: 4,
                                pointHoverBackgroundColor: '#3b82f6',
                                pointHoverBorderColor: '#fff',
                                fill: true,
                                tension: 0.4
                            },
                            {
                                label: 'Supir Tidak Lulus HSE',
                                data: failedData,
                                borderColor: '#ef4444',
                                backgroundColor: (context) => {
                                    const ctx = context.chart.ctx;
                                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                                    gradient.addColorStop(0, 'rgba(239, 68, 68, 0.3)');
                                    gradient.addColorStop(1, 'rgba(239, 68, 68, 0.0)');
                                    return gradient;
                                },
                                borderWidth: 4,
                                pointRadius: 6,
                                pointBackgroundColor: '#ef4444',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 3,
                                pointHoverRadius: 9,
                                pointHoverBorderWidth: 4,
                                pointHoverBackgroundColor: '#ef4444',
                                pointHoverBorderColor: '#fff',
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
                                        return ' ' + context.parsed.y + ' supir';
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
        });
    </script>
</body>

</html>