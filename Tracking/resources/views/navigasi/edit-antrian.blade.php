<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Antrian - POS 1</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Custom styles for Cek Kendaraan form - BLUE THEME */
        .form-input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input:hover {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            transform: translateY(-1px);
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2), 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transform: translateY(-1px);
        }

        .form-label {
            transition: all 0.2s ease;
        }

        .form-group:hover .form-label {
            color: #2563eb;
        }

        .radio-option {
            transition: all 0.2s ease;
        }

        .radio-option:hover {
            background-color: #eff6ff;
            transform: translateX(4px);
        }

        .form-card {
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .submit-btn {
            background-color: #2563eb !important;
            color: #ffffff !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
            background-color: #1d4ed8 !important;
        }

        /* Print styles */
        @media print {

            #sidebar,
            #sidebarToggle,
            #sidebarOverlay,
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .form-card {
                page-break-inside: avoid;
                break-inside: avoid;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100 font-sans antialiased min-h-screen">
    <div class="flex min-h-screen">
        <!-- SIDEBAR TOGGLE BUTTON -->
        <button id="sidebarToggle" type="button"
            class="fixed left-4 top-9 z-50 inline-flex h-12 w-12 items-center justify-center rounded-lg border border-slate-200 bg-white text-blue-600 shadow-sm transition hover:bg-blue-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 cursor-pointer sm:left-6 sm:top-10 lg:left-8 lg:top-12"
            aria-label="Toggle navigation" aria-expanded="false">
            <span class="relative flex h-4 w-6 flex-col justify-between">
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
            </span>
        </button>

        <!-- SIDEBAR -->
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
                        {{-- Dashboard Link --}}
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

                        {{-- Antrian Menu Accordion - ACTIVE --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleAntrianMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-blue-700 bg-blue-50/50 transition-all hover:bg-blue-50/80 hover:text-blue-800">
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
                                    class="h-4 w-4 text-blue-400 transition-transform duration-300 group-hover:text-blue-600 rotate-180"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="antrianSubmenu" class="space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('pos1.antrian.input') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>Input Antrian</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
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
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-blue-50/50 hover:text-blue-800">
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
                                        <span>Form Pemeriksaan</span>
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
                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
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
                                        <span>Form HSE</span>
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
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-xs font-bold uppercase tracking-wider text-blue-500/80">Tracking
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

        <!-- MAIN CONTENT -->
        <div class="flex-1 transition-all duration-300">
            @php
                $evalubeLogoExists = file_exists(public_path('images/evalube.png'));
            @endphp
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
                                        alt="Logo PT. Wiraswasta Gemilang Indonesia"
                                        class="h-full w-full object-contain">
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
                            <div
                                class="flex min-w-[200px] flex-1 justify-center text-center sm:justify-start sm:text-left">
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

                <!-- PAGE CONTENT -->
                <section class="relative mx-auto w-full flex-1 px-4 py-8 sm:px-6 lg:px-8 max-w-7xl">
                    <!-- Header Section - PREMIUM REDESIGN -->
                    <div
                        class="relative mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-blue-500 to-blue-600 border border-blue-400/20 shadow-xl shadow-blue-500/20">
                        {{-- Decorative Glows --}}
                        <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-white/10 blur-[80px]">
                        </div>
                        <div class="absolute -left-24 -bottom-24 h-72 w-72 rounded-full bg-white/5 blur-[80px]">
                        </div>

                        <div class="relative flex flex-col items-center px-8 py-10 text-center sm:px-16 lg:py-12">
                            <div
                                class="mb-4 inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1 border border-white/20 backdrop-blur-md">
                                <span class="relative flex h-1.5 w-1.5">
                                    <span
                                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-white opacity-75"></span>
                                    <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-white"></span>
                                </span>
                                <span class="text-[9px] font-bold uppercase tracking-[0.2em] text-white">POS 1
                                    Operations</span>
                            </div>

                            <h1 class="mb-4 text-3xl font-black tracking-tight text-white sm:text-5xl leading-tight">
                                Edit <span class="text-blue-100 italic">Antrian Unit</span>
                            </h1>

                            <p class="max-w-2xl text-base font-medium text-white/80 leading-relaxed">
                                Perbarui data antrian untuk unit <span
                                    class="font-bold text-white">{{ $antrian->no_antrian }}</span>. Pastikan seluruh
                                perubahan data identitas tetap akurat.
                            </p>

                            {{-- Stats/Info Bar --}}
                            <div class="mt-8 grid grid-cols-1 gap-3 sm:grid-cols-3 w-full max-w-2xl">
                                <div class="rounded-xl bg-white/10 p-3 border border-white/10 backdrop-blur-md">
                                    <p class="text-[9px] font-bold uppercase tracking-widest text-white/70">
                                        Queue Status</p>
                                    <p class="text-xs font-bold text-white">{{ $antrian->status }}</p>
                                </div>
                                <div class="rounded-xl bg-white/10 p-3 border border-white/10 backdrop-blur-md">
                                    <p class="text-[9px] font-bold uppercase tracking-widest text-white/70">
                                        Queue Number</p>
                                    <p class="text-xs font-bold text-white">{{ $antrian->no_antrian }}</p>
                                </div>
                                <div class="rounded-xl bg-white/10 p-3 border border-white/10 backdrop-blur-md">
                                    <p class="text-[9px] font-bold uppercase tracking-widest text-white/70">
                                        Priority</p>
                                    <p class="text-xs font-bold text-white">{{ $antrian->emr ?: 'Normal' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-8">
                        <!-- LEFT SIDE: Operation Guidelines -->
                        <div class="lg:w-1/3 space-y-6">
                            <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-100 h-fit sticky top-40">
                                <h4 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                                    <div
                                        class="h-8 w-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    Panduan Edit
                                </h4>

                                <ul class="space-y-4">
                                    <li class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                            01</div>
                                        <p class="text-sm text-slate-600 leading-relaxed"><span
                                                class="font-bold text-slate-900">Verifikasi Perubahan</span>: Pastikan
                                            alasan perubahan data sudah sesuai dengan dokumen fisik terbaru.</p>
                                    </li>
                                    <li class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                            02</div>
                                        <p class="text-sm text-slate-600 leading-relaxed"><span
                                                class="font-bold text-slate-900">Update Status</span>: Sesuaikan status
                                            antrian jika kendaraan sudah berpindah area atau selesai.</p>
                                    </li>
                                    <li class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                            03</div>
                                        <p class="text-sm text-slate-600 leading-relaxed"><span
                                                class="font-bold text-slate-900">Simpan Data</span>: Klik tombol simpan
                                            untuk memperbarui database sistem secara real-time.</p>
                                    </li>
                                </ul>

                                <div class="mt-8 rounded-2xl bg-amber-50 p-4 border border-amber-100">
                                    <div
                                        class="flex items-center gap-2 text-amber-700 font-bold text-xs mb-2 uppercase tracking-wider">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        Edit Warning
                                    </div>
                                    <p class="text-xs text-amber-600 leading-relaxed">
                                        Perubahan pada nomor polisi atau nama driver akan mempengaruhi histori
                                        pengecekan di pos selanjutnya.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE: Input Forms -->
                        <div class="lg:flex-1 pb-24">
                            <form action="{{ route('pos1.antrian.update', $antrian->id) }}" method="POST"
                                class="space-y-8">
                                @csrf
                                @method('PUT')

                                {{-- SECTION 1: WAKTU & OPERATOR --}}
                                <div
                                    class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1 overflow-hidden">
                                    <div class="h-2 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500">
                                    </div>
                                    <div class="p-8 sm:p-10">
                                        <div class="mb-10 flex items-center justify-between">
                                            <div>
                                                <h3 class="text-2xl font-black text-slate-900">Waktu & Tanggal</h3>
                                                <p class="text-slate-500 text-sm mt-1">Status waktu pendaftaran antrian
                                                </p>
                                            </div>
                                            <div
                                                class="h-12 w-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                            <div class="space-y-2">
                                                <label for="tgl_antrian"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Tanggal
                                                    Antrian <span class="text-rose-500">*</span></label>
                                                <input type="date" id="tgl_antrian" name="tgl_antrian" required
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5"
                                                    value="{{ old('tgl_antrian', $antrian->tgl_antrian) }}">
                                            </div>
                                            <div class="space-y-2">
                                                <label for="jam_diizinkan_masuk"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Jam
                                                    Masuk <span class="text-rose-500">*</span></label>
                                                <input type="time" id="jam_diizinkan_masuk" name="jam_diizinkan_masuk"
                                                    required
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5"
                                                    value="{{ old('jam_diizinkan_masuk', $antrian->jam_diizinkan_masuk) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- SECTION 2: DETAIL DOKUMEN --}}
                                <div
                                    class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1 overflow-hidden">
                                    <div class="h-2 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500">
                                    </div>
                                    <div class="p-8 sm:p-10">
                                        <div class="mb-10 flex items-center justify-between">
                                            <div>
                                                <h3 class="text-2xl font-black text-slate-900">Detail Dokumen & Status
                                                </h3>
                                                <p class="text-slate-500 text-sm mt-1">Informasi urgensi dan kategori
                                                    antrian</p>
                                            </div>
                                            <div
                                                class="h-12 w-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                            <div class="space-y-2">
                                                <label for="emr"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Emergency
                                                    (EMR)</label>
                                                <input type="text" id="emr" name="emr"
                                                    placeholder="Contoh: Urgent / Normal"
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5"
                                                    value="{{ old('emr', $antrian->emr) }}">
                                            </div>
                                            <div class="space-y-2">
                                                <label for="jenis_antrian"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Jenis
                                                    Antrian <span class="text-rose-500">*</span></label>
                                                <select id="jenis_antrian" name="jenis_antrian" required
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5 appearance-none">
                                                    <option value="Bongkar" {{ old('jenis_antrian', $antrian->jenis_antrian) == 'Bongkar' ? 'selected' : '' }}>Finish
                                                        Product</option>
                                                    <option value="Muat" {{ old('jenis_antrian', $antrian->jenis_antrian) == 'Muat' ? 'selected' : '' }}>Use Oil
                                                    </option>
                                                    <option value="Tamu" {{ old('jenis_antrian', $antrian->jenis_antrian) == 'Tamu' ? 'selected' : '' }}>Raw
                                                        Material</option>
                                                    <option value="Lainnya" {{ old('jenis_antrian', $antrian->jenis_antrian) == 'Lainnya' ? 'selected' : '' }}>Drum
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="space-y-2 md:col-span-2">
                                                <label for="status"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Status
                                                    Antrian <span class="text-rose-500">*</span></label>
                                                <select id="status" name="status" required
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5 appearance-none">
                                                    <option value="Waiting" {{ old('status', $antrian->status) == 'Waiting' ? 'selected' : '' }}>Waiting
                                                    </option>
                                                    <option value="In Process" {{ old('status', $antrian->status) == 'In Process' ? 'selected' : '' }}>In Process</option>
                                                    <option value="Completed" {{ old('status', $antrian->status) == 'Completed' ? 'selected' : '' }}>Completed
                                                    </option>
                                                    <option value="Cancelled" {{ old('status', $antrian->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- SECTION 3: ARMADA & DRIVER --}}
                                <div
                                    class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1 overflow-hidden">
                                    <div class="h-2 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500">
                                    </div>
                                    <div class="p-8 sm:p-10">
                                        <div class="mb-10 flex items-center justify-between">
                                            <div>
                                                <h3 class="text-2xl font-black text-slate-900">Armada & Driver</h3>
                                                <p class="text-slate-500 text-sm mt-1">Identitas kendaraan dan personil
                                                </p>
                                            </div>
                                            <div
                                                class="h-12 w-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                            <div class="space-y-2">
                                                <label for="nomor_polisi"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Nomor
                                                    Polisi <span class="text-rose-500">*</span></label>
                                                <input type="text" id="nomor_polisi" name="nomor_polisi" required
                                                    placeholder="B 1234 ABC"
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5 uppercase"
                                                    value="{{ old('nomor_polisi', $antrian->nomor_polisi) }}">
                                            </div>
                                            <div class="space-y-2">
                                                <label for="nama_driver"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Nama
                                                    Driver <span class="text-rose-500">*</span></label>
                                                <input type="text" id="nama_driver" name="nama_driver" required
                                                    placeholder="Nama Lengkap Driver"
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5"
                                                    value="{{ old('nama_driver', $antrian->nama_driver) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- SECTION 4: TUJUAN OPERASIONAL --}}
                                <div
                                    class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1 overflow-hidden">
                                    <div class="h-2 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500">
                                    </div>
                                    <div class="p-8 sm:p-10">
                                        <div class="mb-10 flex items-center justify-between">
                                            <div>
                                                <h3 class="text-2xl font-black text-slate-900">Tujuan Operasional</h3>
                                                <p class="text-slate-500 text-sm mt-1">Lokasi tujuan dalam area
                                                    operasional</p>
                                            </div>
                                            <div
                                                class="h-12 w-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-8">
                                            <div class="space-y-2">
                                                <label for="tujuan"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Tujuan
                                                    Gate / Area <span class="text-rose-500">*</span></label>
                                                <select id="tujuan" name="tujuan" required
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5 appearance-none">
                                                    <option value="" disabled>Pilih Gate / Area</option>
                                                    <option value="Gate 1" {{ old('tujuan', $antrian->tujuan) == 'Gate 1' ? 'selected' : '' }}>Gate 1</option>
                                                    <option value="Gate 2" {{ old('tujuan', $antrian->tujuan) == 'Gate 2' ? 'selected' : '' }}>Gate 2</option>
                                                    <option value="Gate 3" {{ old('tujuan', $antrian->tujuan) == 'Gate 3' ? 'selected' : '' }}>Gate 3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- FORM ACTIONS --}}
                                <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-8">
                                    <a href="{{ route('pos1.antrian.daftar') }}"
                                        class="w-full sm:w-auto px-8 py-4 rounded-2xl border-2 border-slate-200 text-slate-500 font-bold tracking-widest uppercase text-xs transition-all hover:bg-slate-50 hover:border-slate-300 flex items-center justify-center">
                                        Batal
                                    </a>
                                    <button type="submit"
                                        class="w-full sm:w-auto px-12 py-4 rounded-2xl bg-blue-600 text-white font-black tracking-widest uppercase text-xs shadow-xl shadow-blue-600/20 transition-all hover:bg-blue-700 hover:shadow-blue-600/40 hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </main>
        </div>
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
        const antrianToggleIcon = document.getElementById('antrianToggleIcon');
        const antrianSubmenu = document.getElementById('antrianSubmenu');
        const logoutModal = document.getElementById('logoutModal');
        const logoutModalContent = logoutModal ? logoutModal.querySelector('div.transform') : null;

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
            const isHidden = antrianSubmenu.classList.contains('hidden');
            if (isHidden) {
                antrianSubmenu.classList.remove('hidden');
                antrianToggleIcon.classList.add('rotate-180');
            } else {
                antrianSubmenu.classList.add('hidden');
                antrianToggleIcon.classList.remove('rotate-180');
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
            if (logoutModal) {
                logoutModal.classList.remove('opacity-0', 'pointer-events-none');
                logoutModalContent.classList.remove('scale-95');
                logoutModalContent.classList.add('scale-100');
            }
        }

        function closeLogoutModal() {
            if (logoutModal) {
                logoutModal.classList.add('opacity-0', 'pointer-events-none');
                logoutModalContent.classList.remove('scale-100');
                logoutModalContent.classList.add('scale-95');
            }
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', toggleSidebar);
        }
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', toggleSidebar);
        }

        // Ensure Antrian menu is open by default on this page
        if (antrianSubmenu && antrianSubmenu.classList.contains('hidden')) {
            antrianSubmenu.classList.remove('hidden');
            if (antrianToggleIcon) antrianToggleIcon.classList.add('rotate-180');
        }
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
</body>

</html>