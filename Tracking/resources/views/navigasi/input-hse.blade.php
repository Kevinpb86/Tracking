<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input HSE - POS 1</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        /* Custom styles for HSE form */
        .form-input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input:hover {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
            transform: translateY(-1px);
        }

        .form-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2), 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transform: translateY(-1px);
        }

        .form-label {
            transition: all 0.2s ease;
        }

        .form-group:hover .form-label {
            color: #059669;
        }

        .radio-option {
            transition: all 0.2s ease;
        }

        .radio-option:hover {
            background-color: #ecfdf5;
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
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn {
            background-color: #059669 !important;
            color: #ffffff !important;
        }

        .submit-btn:hover {
            background-color: #047857 !important;
        }

        /* 3D Checkbox Effect */
        .checkbox-3d-container {
            transition: all 0.2s ease;
            box-shadow: 0 4px 0 #e2e8f0;
            /* The "base" of the 3D look */
        }

        .checkbox-3d-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 0 #cbd5e1;
            border-color: #10b981;
        }

        .checkbox-3d-container:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #e2e8f0;
        }

        .checkbox-3d-container.checked {
            background-color: #f0fdf4;
            border-color: #10b981;
            box-shadow: 0 4px 0 #059669;
        }

        .checkbox-3d-container.checked:hover {
            box-shadow: 0 6px 0 #047857;
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
            box-shadow: inset 1em 1em #10b981;
            clip-path: polygon(14% 44%, 0 65%, 50% 100%, 100% 16%, 80% 0%, 43% 62%);
        }

        .checkbox-3d-input:checked {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .checkbox-3d-input:checked::before {
            transform: scale(1);
        }

        /* Print styles - hide elemen yang tidak perlu saat cetak */
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

<body class="bg-gradient-to-br from-slate-50 via-emerald-50 to-slate-100 font-sans antialiased min-h-screen">
    @php
        $evalubeLogoExists = file_exists(public_path('images/evalube.png'));
    @endphp
    <div class="flex min-h-screen">
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
                            class="group flex items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-slate-50 hover:text-emerald-600">
                            <span class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-slate-400 transition-colors group-hover:text-emerald-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1-1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
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
                                    class="h-4 w-4 text-emerald-400 transition-transform duration-300 group-hover:text-emerald-600"
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-400 group-hover:text-blue-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('pos1.antrian.daftar') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>History Antrian</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-400 group-hover:text-blue-600"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
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
                                        <span>Form Pemeriksaan</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-400 group-hover:text-blue-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('cek-kendaraan.daftar') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>History Pemeriksaan</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-400 group-hover:text-blue-600"
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
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 bg-emerald-50/50 text-emerald-700 transition-all hover:bg-emerald-50 hover:text-emerald-800">
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
                                    class="h-4 w-4 text-emerald-400 transition-transform duration-300 group-hover:text-emerald-600 rotate-180"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="hseSubmenu" class="space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('hse.input') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm bg-blue-50 text-blue-700 font-semibold transition-colors">
                                        <span>Form HSE</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-blue-600"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('hse.daftar') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>History Laporan</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-400 group-hover:text-blue-600"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Tracking Menu --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleTrackingMenu()"
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

        <div class="flex-1 transition-all duration-300">
            <div id="sidebarOverlay"
                class="fixed inset-0 z-30 bg-slate-900/10 opacity-0 transition-opacity duration-300 ease-in-out pointer-events-none">
            </div>

            <main class="relative flex min-h-screen flex-col pt-32 sm:pt-36 lg:pt-40">
                <section class="fixed inset-x-0 top-0 z-40">
                    <div class="overflow-hidden border-b border-slate-200 bg-white text-slate-700 shadow-sm">
                        <div class="h-3 w-full bg-[#2736a3]"></div>
                        <div class="flex flex-wrap items-center gap-6 px-6 py-6 pl-20 sm:px-10 sm:pl-28">
                            <div class="flex min-w-[220px] flex-1 items-center gap-5 text-emerald-900">
                                    <div
                                        class="flex h-16 w-16 items-center justify-center rounded-full border border-emerald-900/20 bg-white p-2 shadow-lg shadow-emerald-900/20">
                                        <img src="{{ asset('images/wgilogo.jpg') }}"
                                            alt="Logo PT. Wiraswasta Gemilang Indonesia"
                                            class="h-full w-full object-contain">
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
                                            class="h-10 w-auto object-contain sm:h-12">
                                    @else
                                        <div class="flex flex-col items-center text-center sm:items-end sm:text-right">
                                            <span
                                                class="text-xl font-black uppercase tracking-[0.25em] text-emerald-500 drop-shadow-sm sm:text-2xl">Evalube</span>
                                            <span
                                                class="text-[10px] font-semibold uppercase tracking-[0.5em] text-slate-500 sm:text-xs">Lubricants</span>
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
                        class="relative mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-500 to-emerald-600 border border-emerald-400/20 shadow-xl shadow-emerald-500/20">
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
                                Formulir <span class="text-emerald-100 italic">HSE Compliance</span>
                            </h1>

                            <p class="max-w-2xl text-sm font-medium text-white/80 leading-relaxed">
                                Sistem pemantauan Kesehatan, Keselamatan, dan Keamanan Lingkungan. Pastikan kepatuhan
                                terhadap standar APD dan protokol keselamatan harian.
                            </p>

                            {{-- Stats/Info Bar --}}
                            <div class="mt-5 grid grid-cols-1 gap-2 sm:grid-cols-3 w-full max-w-2xl">
                                <div class="rounded-xl bg-white/10 p-2.5 border border-white/10 backdrop-blur-md">
                                    <p class="text-[9px] font-bold uppercase tracking-widest text-white/70">
                                        Current Task</p>
                                    <p class="text-xs font-bold text-white">Safety Verification</p>
                                </div>
                                <div class="rounded-xl bg-white/10 p-2.5 border border-white/10 backdrop-blur-md">
                                    <p class="text-[9px] font-bold uppercase tracking-widest text-white/70">
                                        Target</p>
                                    <p class="text-xs font-bold text-white">Zero Accident</p>
                                </div>
                                <div class="rounded-xl bg-white/10 p-2.5 border border-white/10 backdrop-blur-md">
                                    <p class="text-[9px] font-bold uppercase tracking-widest text-white/70">
                                        Priority</p>
                                    <p class="text-xs font-bold text-white">Safety Excellence</p>
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
                                        class="h-8 w-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    Protokol Keselamatan
                                </h4>

                                <ul class="space-y-4">
                                    <li class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                            01</div>
                                        <p class="text-sm text-slate-600 leading-relaxed"><span
                                                class="font-bold text-slate-900">Verifikasi APD</span>: Pastikan
                                            personil
                                            menggunakan helm, sepatu, dan rompi safety yang layak.</p>
                                    </li>
                                    <li class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                            02</div>
                                        <p class="text-sm text-slate-600 leading-relaxed"><span
                                                class="font-bold text-slate-900">Kesiapan Armada</span>: Periksa
                                            keberadaan
                                            APAR dan Kotak P3K di dalam atau sekitar unit.</p>
                                    </li>
                                    <li class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                            03</div>
                                        <p class="text-sm text-slate-600 leading-relaxed"><span
                                                class="font-bold text-slate-900">Dokumentasi Temuan</span>: Catat setiap
                                            pelanggaran atau potensi bahaya untuk segera ditindaklanjuti.</p>
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
                                        HSE Alert
                                    </div>
                                    <p class="text-xs text-amber-600 leading-relaxed">
                                        Kepatuhan HSE adalah <span class="font-bold">Prioritas Utama</span>. Temuan
                                        kritis
                                        dapat mengakibatkan penghentian sementara operasional unit.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE: Input Forms -->
                        <div class="lg:flex-1 pb-24">

                            {{-- Alerts and Form Section --}}
                            <div class="mx-auto w-full max-w-5xl px-4 py-8">
                                {{-- Alerts Section --}}
                                <div class="max-w-5xl mx-auto">
                                    @if (session('success'))
                                        <div
                                            class="mb-8 flex items-center gap-4 rounded-2xl border border-emerald-200 bg-white/80 p-4 text-emerald-800 shadow-sm backdrop-blur-sm">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class="font-medium">{{ session('success') }}</p>
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div
                                            class="mb-8 rounded-2xl border border-red-200 bg-white/80 p-6 shadow-sm backdrop-blur-sm">
                                            <div class="mb-4 flex items-center gap-3 text-red-700">
                                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <h3 class="font-bold">Terdapat Kesalahan Input</h3>
                                            </div>
                                            <ul class="ml-11 list-disc space-y-1 text-sm font-medium text-slate-600">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                {{-- Form Content --}}
                                <form action="{{ route('hse.store') }}" method="POST"
                                    class="space-y-10 max-w-5xl mx-auto" id="hseForm">
                                    @csrf

                                    {{-- SECTION 1: WAKTU & PERSONALIA --}}
                                    <div
                                        class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-emerald-500/5 hover:-translate-y-1 overflow-hidden">
                                        <div
                                            class="h-2 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-500">
                                        </div>
                                        <div class="p-8 sm:p-10">
                                            <div class="mb-10 flex items-center justify-between">
                                                <div>
                                                    <h3 class="text-2xl font-black text-slate-900">Informasi Dasar</h3>
                                                    <p class="text-slate-500 text-sm mt-1">Waktu pemeriksaan dan
                                                        identitas petugas</p>
                                                </div>
                                                <div
                                                    class="h-12 w-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                                <div class="space-y-2">
                                                    <label for="tanggal"
                                                        class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Tanggal
                                                        <span class="text-rose-500">*</span></label>
                                                    <input type="date" id="tanggal" name="tanggal" required
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/5"
                                                        value="{{ date('Y-m-d') }}">
                                                </div>
                                                <div class="space-y-2">
                                                    <label for="waktu"
                                                        class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Waktu
                                                        <span class="text-rose-500">*</span></label>
                                                    <input type="time" id="waktu" name="waktu" required
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/5"
                                                        value="{{ date('H:i') }}">
                                                </div>
                                                <div class="space-y-2 lg:col-span-1">
                                                    <label for="nama_petugas"
                                                        class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Nama
                                                        Petugas <span class="text-rose-500">*</span></label>
                                                    <input type="text" id="nama_petugas" name="nama_petugas" required
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/5"
                                                        value="{{ Auth::user()->name ?? '' }}">
                                                </div>
                                            </div>

                                            {{-- ARMADA & DRIVER section within Card 1 or separate? Let's make it a
                                            separate Card 2 to match distribution form structure --}}
                                        </div>
                                    </div>

                                    {{-- SECTION 2: ARMADA & PENGEMUDI --}}
                                    <div
                                        class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-emerald-500/5 hover:-translate-y-1 overflow-hidden">
                                        <div
                                            class="h-2 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-500">
                                        </div>
                                        <div class="p-8 sm:p-10">
                                            <div class="mb-10 flex items-center justify-between">
                                                <div>
                                                    <h3 class="text-2xl font-black text-slate-900">Armada & Pengemudi
                                                    </h3>
                                                    <p class="text-slate-500 text-sm mt-1">Data identitas kendaraan dan
                                                        personil</p>
                                                </div>
                                                <div
                                                    class="h-12 w-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">
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
                                                        Polisi</label>
                                                    <input type="text" id="nomor_polisi" name="nomor_polisi"
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/5 uppercase"
                                                        placeholder="B 1234 XX">
                                                </div>
                                                <div class="space-y-2">
                                                    <label for="nama_driver"
                                                        class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Nama
                                                        Pengemudi</label>
                                                    <input type="text" id="nama_driver" name="nama_driver"
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/5"
                                                        placeholder="Nama Driver">
                                                </div>
                                                <div class="md:col-span-2 space-y-2">
                                                    <label for="perusahaan"
                                                        class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Perusahaan
                                                        / Vendor</label>
                                                    <input type="text" id="perusahaan" name="perusahaan"
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/5"
                                                        placeholder="Nama Perusahaan">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- SECTION 3: CHECKLIST KESELAMATAN --}}
                                    <div
                                        class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-emerald-500/5 hover:-translate-y-1 overflow-hidden">
                                        <div
                                            class="h-2 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-500">
                                        </div>
                                        <div class="p-8 sm:p-10">
                                            <div class="mb-10 flex items-center justify-between">
                                                <div>
                                                    <h3 class="text-2xl font-black text-slate-900">Checklist Keselamatan
                                                    </h3>
                                                    <p class="text-slate-500 text-sm mt-1">Kelengkapan APD dan standar
                                                        safety petugas</p>
                                                </div>
                                                <div
                                                    class="h-12 w-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    </svg>
                                                </div>
                                            </div>

                                            <div class="space-y-8">
                                                <div>
                                                    <label
                                                        class="block text-xs font-black uppercase tracking-widest text-emerald-500/80 mb-4">
                                                        Alat Pelindung Diri (APD)
                                                    </label>
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                        @foreach ([
                                                                'helm_safety' => 'Helm Safety',
                                                                'sepatu_safety' => 'Sepatu Safety',
                                                                'rompi_safety' => 'Rompi Safety',
                                                                'masker' => 'Masker',
                                                                'sarung_tangan' => 'Sarung Tangan',
                                                                'kacamata_safety' => 'Kacamata Safety'
                                                            ] as $name => $label)
                                                            <label class="checkbox-3d-container group relative flex items-center gap-4 rounded-2xl border-2 border-slate-200 bg-white p-4 transition-all cursor-pointer">
                                                                    <div class="relative flex h-6 w-6 items-center justify-center">
                                                                        <input id="{{ $name }}" name="{{ $name }}" type="checkbox" value="1"
                                                                            onchange="this.closest('.checkbox-3d-container').classList.toggle('checked', this.checked)"
                                                                class="checkbox-3d-input peer h-6 w-6">
                                                                    </div>

                                                                 <span class="font-bold text-slate-700 group-hover:text-emerald-900 transition-colors uppercase text-xs tracking-wide">{{ $label }}</span>
                                                                </label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="pt-4">
                                                    <label class="block text-xs font-black uppercase tracking-widest text-emerald-500/80 mb-4">
                                                        Perlengkapan Keamanan
                                                    </label>
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            @foreach ([
                                                    'apar_tersedia' => 'APAR Tersedia',
                                                    'kotak_p3k' => 'Kotak P3K'
                                                ] as $name => $label)
                                                                <label class="checkbox-3d-container group relative flex items-center gap-4 rounded-2xl border-2 border-slate-200 bg-white p-4 transition-all cursor-pointer">
                                                                    <div class="relative flex h-6 w-6 items-center justify-center">
                                                                        <input id="{{ $name }}" name="{{ $name }}" type="checkbox" value="1"
                                                                            onchange="this.closest('.checkbox-3d-container').classList.toggle('checked', this.checked)"
                                                                class="checkbox-3d-input peer h-6 w-6">
                                                                    </div>
                                                                    <span class="font-bold text-slate-700 group-hover:text-emerald-900 transition-colors uppercase text-xs tracking-wide">{{ $label }}</span>
                                                                </label>
                                            @endforeach
                                                    </div>
                                                </div>
                                            </div>
                            </div>
                        </div>
            
            
                                                                                        {{-- SECTION 4: HASIL PEMERIKSAAN --}}

                                                                                           <div
                                        class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-emerald-500/5 hover:-translate-y-1 overflow-hidden">
                                        <div
                                            class="h-2 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-500">
                                        </div>
                                        <div class="p-8 sm:p-10">
                                            <div class="mb-10 flex items-center justify-between">
                                               <div>
                                                     <h3 class="text-2xl font-black text-slate-900">Hasil Pemeriksaan</h3>
                                                    <p class="text-slate-500 text-sm mt-1">Temuan lapangan dan kesimpulan akhir</p>
                                                </div>
                                    <div
                                                    class="h-12 w-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="space-y-6">
                                                <div class="space-y-2">
                                                    <label for="catatan_safety"
                                                        class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Catatan
                                                        Safety (Temuan)</label>
                                                    <textarea id="catatan_safety" name="catatan_safety" rows="3"
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/5"
                                            placeholder="Tuliskan temuan atau catatan keselamatan..."></textarea>
                                                </div>
                                            <div class="space-y-2">
                                                <label for="tindak_lanjut"
                                                        class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Tindak
                                                        Lanjut</label>
                                                <textarea id="tindak_lanjut" name="tindak_lanjut" rows="3"
                                                class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 px-6 font-bold text-slate-900 transition-all focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/5"
                                                placeholder="Rencana tindak lanjut jika ada temuan..."></textarea>
                                            </div>

                                               <div class="space-y-4 pt-4">
                                                    <label
                                            class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Status
                                                        Akhir <span class="text-rose-500">*</span></label>
                                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                                      <label class="relative cursor-pointer group">
                                                          <input type="radio" name="status" value="Lolos" checked
                                                                 class="peer sr-only">
                                                            <div
                                                                class="flex flex-col items-center justify-center p-4 rounded-2xl border-2 border-slate-100 bg-slate-50 text-slate-400 transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-600 group-hover:border-emerald-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-8 w-8 mb-2 transition-transform group-hover:scale-110"
                                                                    viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                       <span class="text-xs font-black uppercase tracking-widest">Lolos</span>
                                                  </div>
                                                        </label>

                                                      <label class="relative cursor-pointer group">
                                                           <input type="radio" name="status" value="Perbaikan"
                                                                class="peer sr-only">
                                                         <div
                                                                   class="flex flex-col items-center justify-center p-4 rounded-2xl border-2 border-slate-100 bg-slate-50 text-slate-400 transition-all peer-checked:border-amber-500 peer-checked:bg-amber-50 peer-checked:text-amber-600 group-hover:border-amber-200">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-8 w-8 mb-2 transition-transform group-hover:scale-110"
                                                                    viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd"
                                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                <span
                                                                    class="text-xs font-black uppercase tracking-widest">Perbaikan</span>
                                                   </div>
                                                       </label>

                                                       <label class="relative cursor-pointer group">
                                                            <input type="radio" name="status" value="Ditolak"
                                                                class="peer sr-only">
                                                            <div
                                                                class="flex flex-col items-center justify-center p-4 rounded-2xl border-2 border-slate-100 bg-slate-50 text-slate-400 transition-all peer-checked:border-rose-500 peer-checked:bg-rose-50 peer-checked:text-rose-600 group-hover:border-rose-200">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-8 w-8 mb-2 transition-transform group-hover:scale-110"
                                                                    viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                            clip-rule="evenodd" />
                                                                </svg>
                                                                <span class="text-xs font-black uppercase tracking-widest">Ditolak</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- FORM ACTIONS --}}
                                    <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-8">
                                        <button type="reset"
                                            class="w-full sm:w-auto px-8 py-4 rounded-2xl border-2 border-slate-200 text-slate-500 font-bold tracking-widest uppercase text-xs transition-all hover:bg-slate-50 hover:border-slate-300">
                                            Reset Form
                                        </button>
                                        <button type="submit"
                                            class="w-full sm:w-auto px-12 py-4 rounded-2xl bg-emerald-600 text-white font-black tracking-widest uppercase text-xs shadow-xl shadow-emerald-600/20 transition-all hover:bg-emerald-700 hover:shadow-emerald-600/40 hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                </svg>
                                    Simpan Laporan HSE
                                </button>
                            </div>
                        </form>
                    </div>
        </div>
    </section>
         </main>
          </div>
     
    <!-- Logout Confirmation Modal -->
    <div id="logoutModal"
        class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div class="relative w-full max-w-sm scale-95 transform overflow-hidden rounded-2xl bg-white text-center shadow-2xl transition-all duration-300">
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