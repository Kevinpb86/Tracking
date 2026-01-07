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

        /* 3D Checkbox Effect - BLUE */
        .checkbox-3d-container {
            transition: all 0.2s ease;
            box-shadow: 0 4px 0 #e2e8f0;
        }

        .checkbox-3d-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 0 #cbd5e1;
            border-color: #3b82f6;
        }

        .checkbox-3d-container:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #e2e8f0;
        }

        .checkbox-3d-container.checked {
            background-color: #eff6ff;
            border-color: #3b82f6;
            box-shadow: 0 4px 0 #2563eb;
        }

        .checkbox-3d-container.checked:hover {
            box-shadow: 0 6px 0 #1d4ed8;
        }

        .checkbox-3d-input {
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
            appearance: none;
            background-color: #fff;
            margin: 0;
            font: inherit;
            color: currentColor;
            width: 1.5em;
            height: 1.5em;
            border: 2px solid #cbd5e1;
            border-radius: 0.5em;
            display: grid;
            place-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .checkbox-3d-input::before {
            content: "";
            width: 0.75em;
            height: 0.75em;
            transform: scale(0);
            transition: 120ms transform ease-in-out;
            box-shadow: inset 1em 1em #3b82f6;
            clip-path: polygon(14% 44%, 0 65%, 50% 100%, 100% 16%, 80% 0%, 43% 62%);
        }

        .checkbox-3d-input:checked {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .checkbox-3d-input:checked::before {
            transform: scale(1);
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
                                        <span>Form Antrian</span>
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
                                        <span>Form Pemeriksaan</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-blue-600"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
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
                <section class="relative mx-auto w-full flex-1 px-4 py-8 sm:px-6 lg:px-8">
                    <div class="max-w-7xl mx-auto">
                        {{-- Header Section - PREMIUM REDESIGN --}}
                        <div
                            class="relative mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-blue-500 to-blue-600 border border-blue-400/20 shadow-xl shadow-blue-500/20">
                            {{-- Decorative Glows --}}
                            <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-white/10 blur-[80px]">
                            </div>
                            <div class="absolute -left-24 -bottom-24 h-72 w-72 rounded-full bg-white/5 blur-[80px]">
                            </div>

                            <div class="relative flex flex-col items-center px-6 py-6 text-center sm:px-12 sm:py-8">
                                <div
                                    class="mb-3 inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-0.5 border border-white/20 backdrop-blur-md">
                                    <span class="relative flex h-1.5 w-1.5">
                                        <span
                                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-white opacity-75"></span>
                                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-white"></span>
                                    </span>
                                    <span class="text-[9px] font-bold uppercase tracking-[0.2em] text-white">POS 1
                                        Operations</span>
                                </div>

                                <h1 class="mb-2 text-2xl font-black tracking-tight text-white sm:text-4xl leading-tight">
                                    Vehicle <span class="text-blue-100 italic">Inspection</span>
                                </h1>

                                <p class="max-w-2xl text-sm font-medium text-white/80 leading-relaxed">
                                    Lakukan pemeriksaan fisik dan validasi dokumen armada secara menyeluruh untuk
                                    memastikan kepatuhan operasional.
                                </p>

                                {{-- Stats/Info Bar --}}
                                <div class="mt-5 grid grid-cols-1 gap-2 sm:grid-cols-3 w-full max-w-2xl">
                                    <div class="rounded-xl bg-white/10 p-2.5 border border-white/10 backdrop-blur-md">
                                        <p class="text-[9px] font-bold uppercase tracking-widest text-white/70">
                                            Current Time</p>
                                        <p id="currentTime" class="text-xs font-bold text-white">{{ date('H:i') }} WIB</p>
                                    </div>
                                    <div class="rounded-xl bg-white/10 p-2.5 border border-white/10 backdrop-blur-md">
                                        <p class="text-[9px] font-bold uppercase tracking-widest text-white/70">
                                            Status</p>
                                        <p class="text-xs font-bold text-white">Validating</p>
                                    </div>
                                    <div class="rounded-xl bg-white/10 p-2.5 border border-white/10 backdrop-blur-md">
                                        <p class="text-[9px] font-bold uppercase tracking-widest text-white/70">
                                            Mode</p>
                                        <p class="text-xs font-bold text-white">High Priority</p>
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
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        Protokol Pemeriksaan
                                    </h4>

                                    <ul class="space-y-4">
                                        <li class="flex gap-4">
                                            <div
                                                class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                                01</div>
                                            <p class="text-sm text-slate-600 leading-relaxed"><span
                                                    class="font-bold text-slate-900">Validasi Dokumen</span>: Periksa kelengkapan STNK, SIM, dan KIR driver.</p>
                                        </li>
                                        <li class="flex gap-4">
                                            <div
                                                class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                                02</div>
                                            <p class="text-sm text-slate-600 leading-relaxed"><span
                                                    class="font-bold text-slate-900">Cek Fisik</span>: Lakukan pemeriksaan visual pada ban, lampu, dan rem.</p>
                                        </li>
                                        <li class="flex gap-4">
                                            <div
                                                class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                                03</div>
                                            <p class="text-sm text-slate-600 leading-relaxed"><span
                                                    class="font-bold text-slate-900">Input Status</span>: Tentukan hasil akhir kelaikan armada di sistem.</p>
                                        </li>
                                    </ul>

                                    {{-- NEW: Inspection Alert Box --}}
                                    <div class="mt-8 rounded-2xl bg-blue-50 p-4 border border-blue-100">
                                        <div
                                            class="flex items-center gap-2 text-blue-700 font-bold text-xs mb-2 uppercase tracking-wider">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Inspection Alert
                                        </div>
                                        <p class="text-xs text-blue-600 leading-relaxed lowercase first-letter:uppercase">
                                            Pastikan seluruh aspek keselamatan telah diperiksa dengan teliti sebelum memberikan status lolos.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT SIDE: Input Forms -->
                            <div class="lg:flex-1 pb-24">
                                <form action="#" method="POST" class="space-y-8">
                                @csrf

                                {{-- SECTION 1: INFORMASI WAKTU --}}
                                <div
                                    class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1 overflow-hidden">
                                    <div class="h-2 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500">
                                    </div>
                                    <div class="p-8 sm:p-10">
                                        <div class="mb-10 flex items-center justify-between">
                                            <div>
                                                <h3 class="text-2xl font-black text-slate-900">Informasi Waktu</h3>
                                                <p class="text-slate-500 text-sm mt-1">Status waktu pemeriksaan
                                                    kendaraan</p>
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

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                            <div class="space-y-2">
                                                <label for="tanggal"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Tanggal
                                                    <span class="text-rose-500">*</span></label>
                                                <input type="date" id="tanggal" name="tanggal" required
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5"
                                                    value="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="space-y-2">
                                                <label for="waktu_masuk"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Waktu
                                                    Masuk <span class="text-rose-500">*</span></label>
                                                <input type="time" id="waktu_masuk" name="waktu_masuk" required
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5"
                                                    value="{{ date('H:i') }}">
                                            </div>
                                            <div class="space-y-2">
                                                <label for="waktu_keluar"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Waktu
                                                    Keluar</label>
                                                <input type="time" id="waktu_keluar" name="waktu_keluar"
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- SECTION 2: ARMADA & DRIVER --}}
                                <div
                                    class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1 overflow-hidden">
                                    <div class="h-2 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500">
                                    </div>
                                    <div class="p-8 sm:p-10">
                                        <div class="mb-10 flex items-center justify-between">
                                            <div>
                                                <h3 class="text-2xl font-black text-slate-900">Armada & Driver</h3>
                                                <p class="text-slate-500 text-sm mt-1">Identitas fisik dan operator
                                                    kendaraan</p>
                                            </div>
                                            <div
                                                class="h-12 w-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                            <div class="space-y-2">
                                                <label for="nomor_polisi"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Nomor
                                                    Polisi <span class="text-rose-500">*</span></label>
                                                <input type="text" id="nomor_polisi" name="nomor_polisi" required
                                                    placeholder="B 1234 XYZ"
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5 uppercase">
                                            </div>
                                            <div class="space-y-2">
                                                <label for="jenis_kendaraan"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Jenis
                                                    Kendaraan <span class="text-rose-500">*</span></label>
                                                <select id="jenis_kendaraan" name="jenis_kendaraan" required
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5 appearance-none">
                                                    <option value="">-- Pilih Jenis --</option>
                                                    <option value="Truk">Truk</option>
                                                    <option value="Pickup">Pickup</option>
                                                    <option value="Mobil Box">Mobil Box</option>
                                                    <option value="Tangki">Tangki</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="space-y-2">
                                                <label for="nama_driver"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Nama
                                                    Driver <span class="text-rose-500">*</span></label>
                                                <input type="text" id="nama_driver" name="nama_driver" required
                                                    placeholder="Nama Lengkap"
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5">
                                            </div>
                                            <div class="space-y-2">
                                                <label for="perusahaan"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Perusahaan
                                                    / Vendor</label>
                                                <input type="text" id="perusahaan" name="perusahaan"
                                                    placeholder="Nama Perusahaan"
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- SECTION 3: PEMERIKSAAN DOKUMEN --}}
                                <div
                                    class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1 overflow-hidden">
                                    <div class="h-2 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500">
                                    </div>
                                    <div class="p-8 sm:p-10">
                                        <div class="mb-10 flex items-center justify-between">
                                            <div>
                                                <h3 class="text-2xl font-black text-slate-900">Pemeriksaan Dokumen</h3>
                                                <p class="text-slate-500 text-sm mt-1">Checklist validitas dokumen
                                                    operasional</p>
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

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @foreach ([
                                                    'surat_jalan' => 'Surat Jalan Tersedia',
                                                    'stnk_valid' => 'STNK Valid (Aktif)',
                                                    'sim_valid' => 'SIM Valid (Aktif)',
                                                    'kir_valid' => 'KIR Valid'
                                                ] as $name => $label)
                                                    <label class="checkbox-3d-container group relative flex items-center gap-4 rounded-2xl border-2 border-slate-200 bg-white p-6 transition-all cursor-pointer">
                                                        <div class="relative flex h-6 w-6 items-center justify-center">
                                                            <input id="{{ $name }}" name="{{ $name }}" type="checkbox" value="1"
                                                                onchange="this.closest('.checkbox-3d-container').classList.toggle('checked', this.checked)"
                                                                class="checkbox-3d-input peer h-6 w-6">
                                                        </div>
                                                        <span class="font-bold text-slate-700 group-hover:text-blue-900 transition-colors uppercase text-sm tracking-wide">{{ $label }}</span>
                                                    </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- SECTION 4: KONDISI KENDARAAN --}}
                                <div
                                    class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1 overflow-hidden">
                                    <div class="h-2 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500">
                                    </div>
                                    <div class="p-8 sm:p-10">
                                        <div class="mb-10 flex items-center justify-between">
                                            <div>
                                                <h3 class="text-2xl font-black text-slate-900">Kondisi Kendaraan</h3>
                                                <p class="text-slate-500 text-sm mt-1">Evaluasi fisik kelaikan jalan
                                                    armada</p>
                                            </div>
                                            <div
                                                class="h-12 w-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="space-y-8">
                                            @foreach(['kondisi_ban' => 'Kondisi Ban', 'kondisi_lampu' => 'Kondisi Lampu', 'kondisi_rem' => 'Kondisi Rem', 'kondisi_lampu_sen' => 'Lampu Sen'] as $field => $label)
                                                <div class="space-y-4">
                                                    <label
                                                        class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">{{ $label }}
                                                        <span class="text-rose-500">*</span></label>
                                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                                        @foreach(['Baik', 'Kurang Baik', 'Tidak Layak'] as $status)
                                                            <label
                                                                class="group/radio relative flex cursor-pointer items-center justify-center rounded-2xl border-2 border-slate-50 bg-slate-50 p-4 transition-all hover:border-blue-200 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
                                                                <input type="radio" name="{{ $field }}" value="{{ $status }}"
                                                                    required {{ $status == 'Baik' ? 'checked' : '' }}
                                                                    class="peer hidden">
                                                                <span
                                                                    class="font-bold text-slate-700 peer-checked:text-blue-700 text-sm">{{ $status }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach

                                            <label class="checkbox-3d-container checked group relative flex items-center gap-4 rounded-2xl border-2 border-blue-500 bg-blue-50 p-6 transition-all cursor-pointer">
                                                <div class="relative flex h-6 w-6 items-center justify-center">
                                                    <input id="kaca_spion_lengkap" name="kaca_spion_lengkap" type="checkbox" value="1" checked
                                                        onchange="this.closest('.checkbox-3d-container').classList.toggle('checked', this.checked)"
                                                        class="checkbox-3d-input peer h-6 w-6">
                                                </div>
                                                <span class="font-bold text-blue-900 transition-colors uppercase text-sm tracking-wide">Kaca & Spion Lengkap</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- SECTION 5: HASIL PEMERIKSAAN --}}
                                <div
                                    class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1 overflow-hidden">
                                    <div
                                        class="h-2 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-500">
                                    </div>
                                    <div class="p-8 sm:p-10">
                                        <div class="mb-10 flex items-center justify-between">
                                            <div>
                                                <h3 class="text-2xl font-black text-slate-900">Hasil Pemeriksaan</h3>
                                                <p class="text-slate-500 text-sm mt-1">Kesimpulan akhir kelaikan armada</p>
                                            </div>
                                            <div
                                                class="h-12 w-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="space-y-8">
                                            <div class="space-y-4">
                                                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Status Kelulusan <span class="text-rose-500">*</span></label>
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                    <label class="group/radio relative flex cursor-pointer items-center justify-center rounded-2xl border-2 border-slate-50 bg-slate-50 p-6 transition-all hover:border-emerald-200 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50">
                                                        <input type="radio" name="hasil_pemeriksaan" value="Lolos" required checked class="peer hidden">
                                                        <div class="flex flex-col items-center gap-2">
                                                            <span class="font-bold text-slate-700 peer-checked:text-emerald-700">Lolos</span>
                                                        </div>
                                                    </label>
                                                    <label class="group/radio relative flex cursor-pointer items-center justify-center rounded-2xl border-2 border-slate-50 bg-slate-50 p-6 transition-all hover:border-amber-200 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/50">
                                                        <input type="radio" name="hasil_pemeriksaan" value="Lolos Bersyarat" required class="peer hidden">
                                                        <div class="flex flex-col items-center gap-2">
                                                            <span class="font-bold text-slate-700 peer-checked:text-amber-700 text-center">Lolos Bersyarat</span>
                                                        </div>
                                                    </label>
                                                    <label class="group/radio relative flex cursor-pointer items-center justify-center rounded-2xl border-2 border-slate-50 bg-slate-50 p-6 transition-all hover:border-rose-200 has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50">
                                                        <input type="radio" name="hasil_pemeriksaan" value="Tidak Lolos" required class="peer hidden">
                                                        <div class="flex flex-col items-center gap-2">
                                                            <span class="font-bold text-slate-700 peer-checked:text-rose-700">Tidak Lolos</span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="space-y-2">
                                                <label for="catatan" class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Catatan Tambahan</label>
                                                <textarea id="catatan" name="catatan" rows="4" placeholder="Tulis catatan atau temuan khusus di sini..." class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5 resize-none"></textarea>
                                            </div>

                                            <div class="space-y-2">
                                                <label for="nama_petugas" class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Nama Petugas Pemeriksa <span class="text-rose-500">*</span></label>
                                                <input type="text" id="nama_petugas" name="nama_petugas" required value="{{ Auth::user()->name ?? '' }}" class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/5">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- FORM ACTIONS --}}
                                <div
                                    class="relative mt-12 bg-white rounded-[2rem] p-8 shadow-xl border border-slate-100 overflow-hidden">
                                    <div class="absolute top-0 left-0 h-1 w-full bg-blue-500/10"></div>
                                    <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="h-12 w-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-slate-900 font-bold text-lg">Konfirmasi Data</p>
                                                <p class="text-slate-500 text-sm">Pastikan seluruh checklist pemeriksaan telah terisi</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4 w-full md:w-auto">
                                            <button type="reset"
                                                class="flex-1 md:flex-none px-8 py-4 rounded-2xl border-2 border-slate-100 text-slate-400 font-bold hover:bg-slate-50 hover:text-slate-600 transition-all uppercase tracking-wider text-sm">
                                                Reset
                                            </button>
                                            <button type="submit"
                                                class="flex-1 md:flex-none px-10 py-4 rounded-2xl bg-blue-600 text-white font-black shadow-lg shadow-blue-500/25 hover:bg-blue-700 hover:-translate-y-1 transition-all uppercase tracking-wider text-sm">
                                                Simpan Pemeriksaan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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