<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pemeriksaan - POS 1</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .form-card {
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900">
    @php
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
                            class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-emerald-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Live
                        </span>
                    </div>

                    <nav class="space-y-2">
                        {{-- Dashboard Link (Inactive) --}}
                        <a href="{{ route('pos1.dashboard') }}"
                            class="group flex items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-slate-50 hover:text-blue-600">
                            <span class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-slate-400 transition-colors group-hover:text-blue-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                </svg>
                                <span class="font-medium text-sm">Dashboard</span>
                            </span>
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
                                    <a href="#"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>Input Antrian</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                    <a href="#"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>Daftar Antrian</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Cek Kendaraan Menu Accordion --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleCekKendaraanMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 bg-blue-50/50 text-blue-700 transition-all hover:bg-blue-50 hover:text-blue-800">
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
                                    class="h-4 w-4 text-blue-400 transition-transform duration-300 group-hover:text-blue-600 rotate-180"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="cekKendaraanSubmenu" class="space-y-1 pl-4">
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
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm transition-colors bg-blue-50 text-blue-700 font-semibold">
                                        <span>Daftar Pemeriksaan</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-blue-600"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
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

            <header class="px-8 pt-12 sm:px-12 lg:px-24">
                <div class="mx-auto max-w-7xl rounded-3xl bg-gradient-to-r from-blue-500 to-blue-600 p-10 shadow-xl">
                    <div class="space-y-4 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-[0.5em] text-white">
                                Daftar Pemeriksaan
                            </p>
                        </div>
                        <h1 class="text-4xl font-bold text-white sm:text-5xl leading-tight">
                            Vehicle Inspection
                        </h1>
                        <div class="mx-auto h-1 w-20 bg-white/50"></div>
                        <p class="mx-auto text-sm leading-relaxed text-white/90 max-w-2xl">
                            Daftar lengkap data pemeriksaan kendaraan yang telah tersimpan. Semua data dapat dilihat
                            untuk
                            keperluan dokumentasi dan audit.
                        </p>
                    </div>
                </div>
            </header>

            <section class="relative mx-auto w-full flex-1 px-8 py-16 sm:px-12 lg:px-24">
                <div class="mx-auto max-w-7xl">
                    @if (session('success'))
                        <div
                            class="mb-8 flex items-center gap-3 rounded-2xl border border-blue-100 bg-blue-50/50 p-4 text-blue-700 shadow-sm backdrop-blur-md">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Action Toolbar --}}
                    <div class="mb-10 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                        <div class="relative flex-1 max-w-lg">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Cari data (Nopol, Supir, Perusahaan)..."
                                class="w-full rounded-2xl border-0 bg-white py-4 pl-12 pr-4 text-sm font-medium text-slate-600 shadow-lg shadow-slate-200/50 ring-1 ring-slate-100 transition focus:ring-2 focus:ring-blue-500/50 outline-none placeholder:text-slate-400">
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Total: <span class="text-blue-600 text-lg ml-1">{{ $cekKendaraanList->count() }}</span>
                            </div>
                            <a href="{{ route('cek-kendaraan.input') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-slate-900/20 transition-all hover:bg-slate-800 hover:scale-105 active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Input Pemeriksaan
                            </a>
                        </div>
                    </div>

                    @if($cekKendaraanList->isEmpty())
                        <div
                            class="flex flex-col items-center justify-center rounded-[2rem] border-2 border-dashed border-slate-200 bg-slate-50/50 py-24 text-center">
                            <div
                                class="mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-white shadow-xl shadow-slate-200/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    <path
                                        d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800">Belum Ada Data Pemeriksaan</h3>
                            <p class="mt-2 text-slate-500 max-w-sm mx-auto">Data pemeriksaan kendaraan Anda akan muncul di
                                sini. Mulai dengan menginput pemeriksaan baru.</p>
                        </div>
                    @else
                        {{-- Table Layout --}}
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-[1200px]">
                                    <thead>
                                        <tr class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                                            <th class="px-3 py-3 text-left text-xs font-bold uppercase tracking-wider w-12">
                                                No
                                            </th>
                                            <th class="px-3 py-3 text-left text-xs font-bold uppercase tracking-wider w-24">
                                                Tanggal</th>
                                            <th class="px-3 py-3 text-left text-xs font-bold uppercase tracking-wider w-20">
                                                Waktu
                                            </th>
                                            <th class="px-3 py-3 text-left text-xs font-bold uppercase tracking-wider w-32">
                                                No. Polisi
                                            </th>
                                            <th class="px-3 py-3 text-left text-xs font-bold uppercase tracking-wider w-32">
                                                Supir
                                            </th>
                                            <th class="px-3 py-3 text-left text-xs font-bold uppercase tracking-wider w-32">
                                                Perusahaan
                                            </th>
                                            <th class="px-3 py-3 text-left text-xs font-bold uppercase tracking-wider w-24">
                                                Jenis
                                            </th>
                                            <th class="px-3 py-3 text-left text-xs font-bold uppercase tracking-wider w-28">
                                                Validation
                                            </th>
                                            <th class="px-3 py-3 text-left text-xs font-bold uppercase tracking-wider w-28">
                                                Petugas
                                            </th>
                                            <th
                                                class="px-3 py-3 text-center text-xs font-bold uppercase tracking-wider w-24">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach($cekKendaraanList as $index => $item)
                                            @php
                                                $statusColor = match ($item->hasil_pemeriksaan) {
                                                    'Lolos' => 'emerald',
                                                    'Lolos Bersyarat' => 'amber',
                                                    'Tidak Lolos' => 'rose',
                                                    default => 'slate'
                                                };
                                            @endphp
                                            <tr class="bg-white hover:bg-slate-50 transition-colors duration-150">
                                                <td class="px-3 py-3 text-sm font-semibold text-slate-700">
                                                    {{ $index + 1 }}
                                                </td>
                                                <td class="px-3 py-3 text-xs text-slate-600 whitespace-nowrap">
                                                    {{ $item->tanggal->format('d-m-Y') }}
                                                </td>
                                                <td class="px-3 py-3 text-xs text-slate-600 whitespace-nowrap">
                                                    {{ $item->waktu_masuk->format('H:i') }}
                                                </td>
                                                <td class="px-3 py-3 text-xs font-bold text-slate-800 whitespace-nowrap">
                                                    {{ $item->nomor_polisi }}
                                                </td>
                                                <td class="px-3 py-3 text-xs text-slate-600 max-w-[140px]">
                                                    <span class="line-clamp-1">{{ $item->nama_driver }}</span>
                                                </td>
                                                <td class="px-3 py-3 text-xs text-slate-600 max-w-[140px]">
                                                    <span class="line-clamp-1">{{ $item->perusahaan ?? '-' }}</span>
                                                </td>
                                                <td class="px-3 py-3 text-xs text-slate-600">
                                                    {{ $item->jenis_kendaraan }}
                                                </td>
                                                <td class="px-3 py-3 whitespace-nowrap">
                                                    <span
                                                        class="inline-flex items-center rounded-lg bg-{{ $statusColor }}-100 px-2 py-0.5 text-xs font-semibold text-{{ $statusColor }}-700">
                                                        {{ $item->hasil_pemeriksaan }}
                                                    </span>
                                                </td>
                                                <td class="px-3 py-3 text-xs text-slate-600">
                                                    {{ $item->nama_petugas }}
                                                </td>
                                                <td class="px-3 py-3 text-center whitespace-nowrap">
                                                    <a href="{{ route('cek-kendaraan.edit', $item->id) }}"
                                                        class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-2.5 py-1.5 text-xs font-bold text-white shadow-sm transition-all hover:bg-blue-700 hover:shadow-md active:scale-95">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal"
        class="fixed inset-0 z-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeLogoutModal()"></div>
        <div
            class="relative w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl transform scale-95 transition-transform duration-300">
            <div class="mb-6 flex flex-col items-center text-center">
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-rose-100 text-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900">Konfirmasi Logout</h3>
                <p class="mt-2 text-sm text-slate-500">Apakah Anda yakin ingin keluar dari aplikasi?</p>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeLogoutModal()"
                    class="flex-1 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Batal
                </button>
                <button type="button" onclick="document.getElementById('logoutForm').submit()"
                    class="flex-1 rounded-xl bg-rose-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-rose-600/20 transition hover:bg-rose-700">
                    Ya, Keluar
                </button>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const cekKendaraanToggleIcon = document.getElementById('cekKendaraanToggleIcon');
        const cekKendaraanSubmenu = document.getElementById('cekKendaraanSubmenu');
        const logoutModal = document.getElementById('logoutModal');
        const logoutModalContent = logoutModal.querySelector('div.transform');

        function toggleSidebar() {
            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('opacity-0', 'pointer-events-none');
            }
        }

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

        function toggleCekKendaraanMenu() {
            const isHidden = cekKendaraanSubmenu.classList.contains('hidden');
            if (isHidden) {
                cekKendaraanSubmenu.classList.remove('hidden');
                cekKendaraanToggleIcon.classList.add('rotate-180');
            } else {
                cekKendaraanSubmenu.classList.add('hidden');
                cekKendaraanToggleIcon.classList.remove('rotate-180');
            }
        }

        function showLogoutModal() {
            logoutModal.classList.remove('opacity-0', 'pointer-events-none');
            logoutModalContent.classList.remove('scale-95');
            logoutModalContent.classList.add('scale-100');
        }

        function closeLogoutModal() {
            logoutModal.classList.add('opacity-0', 'pointer-events-none');
            logoutModalContent.classList.remove('scale-100');
            logoutModalContent.classList.add('scale-95');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Auto-expand Cek Kendaraan menu if active
        // cekKendaraanSubmenu.classList.remove('hidden');
    </script>
</body>

</html>