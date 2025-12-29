<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Pemeriksaan Kendaraan - POS 1</title>
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
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn {
            background-color: #2563eb !important;
            color: #ffffff !important;
        }

        .submit-btn:hover {
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
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Cek Kendaraan Menu Accordion - ACTIVE --}}
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
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm transition-colors bg-blue-50 text-blue-700 font-semibold">
                                        <span>Input Pemeriksaan</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-blue-600"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>Daftar Pemeriksaan</span>
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

        <!-- MAIN CONTENT -->
        <div class="flex-1 transition-all duration-300">
            @php
                $evalubeLogoExists = file_exists(public_path('images/evalube.png'));
            @endphp

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
                <section class="relative mx-auto w-full flex-1 px-4 py-8 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-4xl">
                        <!-- Hero Section dengan Gradient Biru -->
                        <div
                            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 px-8 py-12 shadow-2xl mb-8">
                            <div
                                class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS1vcGFjaXR5PSIwLjEiIHN0cm9rZS13aWR0aD0iMSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNncmlkKSIvPjwvc3ZnPg==')] opacity-10">
                            </div>

                            <div
                                class="relative flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-4">
                                        <span
                                            class="rounded-full bg-blue-500/20 px-3 py-1 text-xs font-semibold text-blue-100">
                                            DASHBOARD UTAMA
                                        </span>
                                        <span
                                            class="rounded-full bg-white/10 px-3 py-1 text-xs font-medium text-white backdrop-blur-sm">
                                            • Sistem Online
                                        </span>
                                    </div>
                                    <h2 class="mb-3 text-4xl font-bold tracking-tight text-white">
                                        Selamat Datang di<br />
                                        <span class="text-blue-200">Checkpoint Pos 1</span>
                                    </h2>
                                    <p class="text-lg text-blue-100 leading-relaxed max-w-2xl">
                                        Kelola validasi kendaraan dan pemeriksaan dengan efisien.<br
                                            class="hidden sm:block" />
                                        Pantau aktivitas terkini dan akses menu cepat di satu tempat.
                                    </p>
                                </div>

                                <div class="grid grid-cols-1 gap-4 lg:min-w-[280px]">
                                    <div
                                        class="rounded-xl bg-white/10 backdrop-blur-md border border-white/20 px-6 py-4 shadow-lg">
                                        <p class="text-sm font-medium text-blue-200 mb-1">WAKTU OPERASIONAL</p>
                                        <p id="heroTime" class="text-3xl font-bold text-white">00:00 <span
                                                class="text-lg font-medium text-blue-300">WIB</span></p>
                                    </div>
                                    <div
                                        class="rounded-xl bg-white/10 backdrop-blur-md border border-white/20 px-6 py-4 shadow-lg">
                                        <p class="text-sm font-medium text-blue-200 mb-1">TANGGAL</p>
                                        <p class="text-lg font-semibold text-white">{{ date('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Container -->
                        <div class="max-w-5xl mx-auto">
                            <form action="#" method="POST" class="space-y-6">
                                @csrf

                                <!-- Section 1: Informasi Waktu -->
                                <div
                                    class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Informasi Waktu Pemeriksaan
                                        </h3>
                                        <p class="text-blue-100 text-sm mt-1">Catat waktu masuk kendaraan</p>
                                    </div>

                                    <div class="p-6 sm:p-8">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            <!-- Tanggal -->
                                            <div class="form-group">
                                                <label for="tanggal"
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-2">
                                                    Tanggal <span class="text-red-500">*</span>
                                                </label>
                                                <input type="date" id="tanggal" name="tanggal" required
                                                    class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-blue-500 focus:outline-none"
                                                    value="{{ date('Y-m-d') }}">
                                            </div>

                                            <!-- Waktu Masuk -->
                                            <div class="form-group">
                                                <label for="waktu_masuk"
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-2">
                                                    Waktu Masuk <span class="text-red-500">*</span>
                                                </label>
                                                <input type="time" id="waktu_masuk" name="waktu_masuk" required
                                                    class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-blue-500 focus:outline-none"
                                                    value="{{ date('H:i') }}">
                                            </div>

                                            <!-- Waktu Keluar -->
                                            <div class="form-group">
                                                <label for="waktu_keluar"
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-2">
                                                    Waktu Keluar
                                                </label>
                                                <input type="time" id="waktu_keluar" name="waktu_keluar"
                                                    class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-blue-500 focus:outline-none">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 2: Informasi Kendaraan -->
                                <div
                                    class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Informasi Kendaraan & Driver
                                        </h3>
                                        <p class="text-blue-100 text-sm mt-1">Data identitas kendaraan dan pengemudi</p>
                                    </div>

                                    <div class="p-6 sm:p-8">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Nomor Polisi -->
                                            <div class="form-group">
                                                <label for="nomor_polisi"
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-2">
                                                    Nomor Polisi <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" id="nomor_polisi" name="nomor_polisi" required
                                                    placeholder="Contoh: B 1234 XYZ"
                                                    class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-blue-500 focus:outline-none uppercase">
                                            </div>

                                            <!-- Jenis Kendaraan -->
                                            <div class="form-group">
                                                <label for="jenis_kendaraan"
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-2">
                                                    Jenis Kendaraan <span class="text-red-500">*</span>
                                                </label>
                                                <select id="jenis_kendaraan" name="jenis_kendaraan" required
                                                    class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-blue-500 focus:outline-none">
                                                    <option value="">-- Pilih Jenis Kendaraan --</option>
                                                    <option value="Truk">Truk</option>
                                                    <option value="Pickup">Pickup</option>
                                                    <option value="Mobil Box">Mobil Box</option>
                                                    <option value="Tangki">Tangki</option>
                                                    <option value="Motor">Motor</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>

                                            <!-- Nama Driver -->
                                            <div class="form-group">
                                                <label for="nama_driver"
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-2">
                                                    Nama Driver <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" id="nama_driver" name="nama_driver" required
                                                    placeholder="Masukkan nama lengkap driver"
                                                    class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-blue-500 focus:outline-none">
                                            </div>

                                            <!-- Perusahaan -->
                                            <div class="form-group">
                                                <label for="perusahaan"
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-2">
                                                    Perusahaan / Vendor
                                                </label>
                                                <input type="text" id="perusahaan" name="perusahaan"
                                                    placeholder="Nama perusahaan atau vendor"
                                                    class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-blue-500 focus:outline-none">
                                            </div>

                                            <!-- Tujuan -->
                                            <div class="form-group md:col-span-2">
                                                <label for="tujuan"
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-2">
                                                    Tujuan Kunjungan <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" id="tujuan" name="tujuan" required
                                                    placeholder="Contoh: Kirim Barang, Ambil Barang, Kunjungan"
                                                    class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-blue-500 focus:outline-none">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 3: Pemeriksaan Dokumen -->
                                <div
                                    class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Pemeriksaan Dokumen
                                        </h3>
                                        <p class="text-blue-100 text-sm mt-1">Checklist validitas dokumen yang
                                            diperlukan
                                        </p>
                                    </div>

                                    <div class="p-6 sm:p-8">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Surat Jalan -->
                                            <div
                                                class="radio-option rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                <label class="flex items-center cursor-pointer">
                                                    <input type="checkbox" name="surat_jalan" value="1"
                                                        class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 rounded focus:ring-blue-500">
                                                    <span class="ml-3 text-sm font-semibold text-slate-700">
                                                        Surat Jalan Tersedia
                                                    </span>
                                                </label>
                                            </div>

                                            <!-- STNK Valid -->
                                            <div
                                                class="radio-option rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                <label class="flex items-center cursor-pointer">
                                                    <input type="checkbox" name="stnk_valid" value="1"
                                                        class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 rounded focus:ring-blue-500">
                                                    <span class="ml-3 text-sm font-semibold text-slate-700">
                                                        STNK Valid (Aktif)
                                                    </span>
                                                </label>
                                            </div>

                                            <!-- SIM Valid -->
                                            <div
                                                class="radio-option rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                <label class="flex items-center cursor-pointer">
                                                    <input type="checkbox" name="sim_valid" value="1"
                                                        class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 rounded focus:ring-blue-500">
                                                    <span class="ml-3 text-sm font-semibold text-slate-700">
                                                        SIM Valid (Aktif)
                                                    </span>
                                                </label>
                                            </div>

                                            <!-- KIR Valid -->
                                            <div
                                                class="radio-option rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                <label class="flex items-center cursor-pointer">
                                                    <input type="checkbox" name="kir_valid" value="1"
                                                        class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 rounded focus:ring-blue-500">
                                                    <span class="ml-3 text-sm font-semibold text-slate-700">
                                                        KIR Valid (Khusus Angkutan)
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 4: Kondisi Kendaraan -->
                                <div
                                    class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                            </svg>
                                            Pemeriksaan Kondisi Kendaraan
                                        </h3>
                                        <p class="text-blue-100 text-sm mt-1">Evaluasi kondisi fisik dan kelaikan
                                            kendaraan
                                        </p>
                                    </div>

                                    <div class="p-6 sm:p-8">
                                        <div class="space-y-6">
                                            <!-- Kondisi Ban -->
                                            <div class="form-group">
                                                <label
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-3">
                                                    Kondisi Ban <span class="text-red-500">*</span>
                                                </label>
                                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                                    <label
                                                        class="radio-option flex items-center justify-center rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                        <input type="radio" name="kondisi_ban" value="Baik" required
                                                            checked
                                                            class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 focus:ring-blue-500">
                                                        <span
                                                            class="ml-3 text-sm font-semibold text-slate-700">Baik</span>
                                                    </label>
                                                    <label
                                                        class="radio-option flex items-center justify-center rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                        <input type="radio" name="kondisi_ban" value="Kurang Baik"
                                                            required
                                                            class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 focus:ring-blue-500">
                                                        <span class="ml-3 text-sm font-semibold text-slate-700">Kurang
                                                            Baik</span>
                                                    </label>
                                                    <label
                                                        class="radio-option flex items-center justify-center rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                        <input type="radio" name="kondisi_ban" value="Tidak Layak"
                                                            required
                                                            class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 focus:ring-blue-500">
                                                        <span class="ml-3 text-sm font-semibold text-slate-700">Tidak
                                                            Layak</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Kondisi Lampu -->
                                            <div class="form-group">
                                                <label
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-3">
                                                    Kondisi Lampu <span class="text-red-500">*</span>
                                                </label>
                                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                                    <label
                                                        class="radio-option flex items-center justify-center rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                        <input type="radio" name="kondisi_lampu" value="Baik" required
                                                            checked
                                                            class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 focus:ring-blue-500">
                                                        <span
                                                            class="ml-3 text-sm font-semibold text-slate-700">Baik</span>
                                                    </label>
                                                    <label
                                                        class="radio-option flex items-center justify-center rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                        <input type="radio" name="kondisi_lampu" value="Kurang Baik"
                                                            required
                                                            class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 focus:ring-blue-500">
                                                        <span class="ml-3 text-sm font-semibold text-slate-700">Kurang
                                                            Baik</span>
                                                    </label>
                                                    <label
                                                        class="radio-option flex items-center justify-center rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                        <input type="radio" name="kondisi_lampu" value="Tidak Layak"
                                                            required
                                                            class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 focus:ring-blue-500">
                                                        <span class="ml-3 text-sm font-semibold text-slate-700">Tidak
                                                            Layak</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Kaca & Spion -->
                                            <div class="form-group">
                                                <div
                                                    class="radio-option rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                    <label class="flex items-center cursor-pointer">
                                                        <input type="checkbox" name="kaca_spion_lengkap" value="1"
                                                            checked
                                                            class="w-5 h-5 text-blue-600 bg-slate-50 border-slate-300 rounded focus:ring-blue-500">
                                                        <span class="ml-3 text-sm font-semibold text-slate-700">
                                                            Kaca & Spion Lengkap
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Ada Kebocoran -->
                                            <div class="form-group">
                                                <div
                                                    class="radio-option rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                    <label class="flex items-center cursor-pointer">
                                                        <input type="checkbox" name="ada_kebocoran" value="1"
                                                            class="w-5 h-5 text-red-600 bg-slate-50 border-slate-300 rounded focus:ring-red-500">
                                                        <span class="ml-3 text-sm font-semibold text-slate-700">
                                                            Ada Kebocoran (Oli / Bensin / Air)
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 5: Hasil Pemeriksaan -->
                                <div
                                    class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Hasil Pemeriksaan
                                        </h3>
                                        <p class="text-blue-100 text-sm mt-1">Kesimpulan hasil pemeriksaan kendaraan</p>
                                    </div>

                                    <div class="p-6 sm:p-8">
                                        <div class="space-y-6">
                                            <!-- Hasil Pemeriksaan -->
                                            <div class="form-group">
                                                <label
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-3">
                                                    Status Hasil Pemeriksaan <span class="text-red-500">*</span>
                                                </label>
                                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                                    <label
                                                        class="radio-option flex items-center justify-center rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                        <input type="radio" name="hasil_pemeriksaan" value="Lolos"
                                                            required checked
                                                            class="w-5 h-5 text-green-600 bg-slate-50 border-slate-300 focus:ring-green-500">
                                                        <span class="ml-3 text-sm font-semibold text-slate-700">✓
                                                            Lolos</span>
                                                    </label>
                                                    <label
                                                        class="radio-option flex items-center justify-center rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                        <input type="radio" name="hasil_pemeriksaan"
                                                            value="Lolos Bersyarat" required
                                                            class="w-5 h-5 text-yellow-600 bg-slate-50 border-slate-300 focus:ring-yellow-500">
                                                        <span class="ml-3 text-sm font-semibold text-slate-700">⚠ Lolos
                                                            Bersyarat</span>
                                                    </label>
                                                    <label
                                                        class="radio-option flex items-center justify-center rounded-lg border-2 border-slate-200 p-4 cursor-pointer hover:border-blue-400">
                                                        <input type="radio" name="hasil_pemeriksaan" value="Tidak Lolos"
                                                            required
                                                            class="w-5 h-5 text-red-600 bg-slate-50 border-slate-300 focus:ring-red-500">
                                                        <span class="ml-3 text-sm font-semibold text-slate-700">✕ Tidak
                                                            Lolos</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Catatan -->
                                            <div class="form-group">
                                                <label for="catatan"
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-2">
                                                    Catatan / Keterangan
                                                </label>
                                                <textarea id="catatan" name="catatan" rows="4"
                                                    placeholder="Tulis catatan tambahan atau alasan tidak lolos (jika ada)..."
                                                    class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-blue-500 focus:outline-none resize-none"></textarea>
                                            </div>

                                            <!-- Nama Petugas -->
                                            <div class="form-group">
                                                <label for="nama_petugas"
                                                    class="form-label block text-sm font-semibold text-slate-700 mb-2">
                                                    Nama Petugas <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" id="nama_petugas" name="nama_petugas" required
                                                    value="{{ Auth::user()->name ?? '' }}"
                                                    placeholder="Nama petugas yang memeriksa"
                                                    class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-blue-500 focus:outline-none">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                                    <p class="text-sm text-slate-600">
                                        <span class="font-semibold text-red-500">*</span> Wajib diisi
                                    </p>
                                    <div class="flex gap-3">
                                        <button type="reset"
                                            class="px-6 py-3 rounded-lg border-2 border-slate-300 text-slate-700 font-semibold hover:bg-slate-50 transition-all">
                                            Reset Form
                                        </button>
                                        <button type="submit"
                                            class="submit-btn px-8 py-3 rounded-lg bg-blue-600 text-white font-bold shadow-lg hover:shadow-xl transition-all">
                                            <span class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Simpan Data Pemeriksaan
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </main>
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

            // Real-time clock for WIB timezone
            function updateWIBTime() {
                const now = new Date();
                const wibOffset = 7 * 60;
                const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
                const wibTime = new Date(utc + (wibOffset * 60000));

                const hours = String(wibTime.getHours()).padStart(2, '0');
                const minutes = String(wibTime.getMinutes()).padStart(2, '0');
                const timeString = `${hours}:${minutes}`;

                const heroTimeElement = document.getElementById('heroTime');
                if (heroTimeElement) {
                    heroTimeElement.innerHTML = `${timeString} <span class="text-lg font-medium text-blue-300">WIB</span>`;
                }
            }

            updateWIBTime();
            setInterval(updateWIBTime, 1000);
        });

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
    </script>
</body>

</html>