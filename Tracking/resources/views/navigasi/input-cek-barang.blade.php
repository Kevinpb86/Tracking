<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Distribusi - POS 2</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
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

        .form-group:hover .form-label {
            color: #059669;
        }

        .form-card {
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .submit-btn {
            background-color: #059669 !important;
            color: #ffffff !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.4);
            background-color: #047857 !important;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-emerald-50 to-slate-100 font-sans antialiased min-h-screen">
    <div class="flex min-h-screen">
        <button id="sidebarToggle" type="button"
            class="fixed left-4 top-9 z-50 inline-flex h-12 w-12 items-center justify-center rounded-lg border border-slate-200 bg-white text-emerald-600 shadow-sm transition hover:bg-emerald-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2 cursor-pointer sm:left-6 sm:top-10 lg:left-8 lg:top-12">
            <span class="relative flex h-4 w-6 flex-col justify-between">
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
            </span>
        </button>

        <!-- SIDEBAR (simplified) -->
        <aside id="sidebar"
            class="fixed left-0 top-0 z-50 flex h-full w-72 -translate-x-full flex-col overflow-hidden border-r border-slate-200 bg-white/90 backdrop-blur-xl shadow-[4px_0_24px_rgba(0,0,0,0.02)] transition-transform duration-300 ease-in-out lg:w-80 font-sans">
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
                        {{-- Dashboard Link --}}
                        <a href="{{ route('pos2.dashboard') }}"
                            class="group flex items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-slate-50 hover:text-emerald-600">
                            <span class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-slate-400 transition-colors group-hover:text-emerald-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                </svg>
                                <span class="font-medium text-sm">Dashboard</span>
                            </span>
                        </a>

                        {{-- Cek Barang Menu - ACTIVE --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleCekBarangMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-emerald-700 bg-emerald-50/50 transition-all hover:bg-emerald-50/80 hover:text-emerald-800">
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
                                    class="h-4 w-4 text-emerald-400 transition-transform duration-300 group-hover:text-emerald-600 rotate-180"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="cekBarangSubmenu" class="space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('cek-barang.create') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm bg-emerald-50 text-emerald-700 font-semibold transition-colors">
                                        <span>Form Distribusi</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-emerald-600"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('cek-barang.index') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>Daftar Distribusi</span>
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
                                    <a href="#"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>Input Cek DO</span>
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
                    </nav>
                </div>
            </div>
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Sign Out
                </button>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </div>
        </aside>

        <div class="flex-1 transition-all duration-300">
            @php $evalubeLogoExists = file_exists(public_path('images/evalube.png')); @endphp
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
                                    <img src="{{ asset('images/wgilogo.jpg') }}" alt="Logo PT. WGI"
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
                                    class="text-base font-medium uppercase tracking-[0.45em] text-slate-500 whitespace-nowrap">Tracking
                                    Information System</span>
                            </div>
                            <div class="hidden h-14 w-0.5 bg-slate-900 sm:ml-7 sm:block lg:ml-16 xl:ml-20"></div>
                            <div class="flex min-w-[160px] flex-1 justify-center sm:justify-center">
                                @if ($evalubeLogoExists)
                                    <img src="{{ asset('images/evalube.png') }}" alt="Evalube Lubricants"
                                        class="h-12 w-auto object-contain">
                                @else
                                    <span
                                        class="text-2xl font-black uppercase tracking-[0.25em] text-emerald-500 drop-shadow-sm">Evalube</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>

                <section class="relative mx-auto w-full flex-1 px-4 py-8 sm:px-6 lg:px-8">
                    <div
                        class="mx-auto max-w-4xl rounded-3xl border border-emerald-200 bg-gradient-to-br from-emerald-100 to-emerald-50 shadow-xl overflow-hidden mb-8">
                        <div class="relative px-6 pt-10 pb-6 text-center sm:px-12">
                            <div class="relative z-10 flex flex-col items-center space-y-4">
                                <div
                                    class="inline-flex items-center gap-3 rounded-full bg-emerald-100/50 px-4 py-1.5 border border-emerald-200/50 backdrop-blur-sm">
                                    <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-emerald-800">Form
                                        Distribusi</span>
                                </div>
                                <h1
                                    class="text-4xl font-extrabold tracking-tight text-emerald-600 sm:text-5xl lg:text-6xl text-center">
                                    Formulir Distribusi</h1>
                                <p class="max-w-2xl text-lg font-medium text-slate-600 leading-relaxed">
                                    Masukkan data pemeriksaan barang untuk distribusi. Lakukan pengecekan kondisi
                                    kemasan, kesesuaian jumlah, dan kelengkapan dokumen.
                                    Untuk truck tangki oli, pastikan tidak ada kebocoran dan seal dalam kondisi baik
                                    sebelum proses bongkar muat dimulai.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-5xl mx-auto w-full pb-20">
                        <form action="{{ route('cek-barang.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Informasi Waktu -->
                            <div
                                class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Informasi Waktu
                                    </h3>
                                    <p class="text-emerald-100 text-sm mt-1">Catat waktu pemeriksaan</p>
                                </div>
                                <div class="p-6 sm:p-8">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="form-group">
                                            <label for="tanggal"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Tanggal
                                                <span class="text-red-500">*</span></label>
                                            <input type="date" id="tanggal" name="tanggal" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none"
                                                value="{{ date('Y-m-d') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="waktu"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Waktu
                                                <span class="text-red-500">*</span></label>
                                            <input type="time" id="waktu" name="waktu" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none"
                                                value="{{ date('H:i') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_pemeriksa"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Nama
                                                Pemeriksa <span class="text-red-500">*</span></label>
                                            <input type="text" id="nama_pemeriksa" name="nama_pemeriksa" required
                                                placeholder="Nama Lengkap"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Kendaraan -->
                            <div
                                class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                        </svg>
                                        Kendaraan & Pengemudi
                                    </h3>
                                    <p class="text-emerald-100 text-sm mt-1">Data identitas kendaraan dan pengemudi</p>
                                </div>
                                <div class="p-6 sm:p-8">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="form-group">
                                            <label for="nomor_polisi"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Nomor
                                                Polisi <span class="text-red-500">*</span></label>
                                            <input type="text" id="nomor_polisi" name="nomor_polisi" required
                                                placeholder="B 1234 XX"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none uppercase">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_pengemudi"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Nama
                                                Pengemudi <span class="text-red-500">*</span></label>
                                            <input type="text" id="nama_pengemudi" name="nama_pengemudi" required
                                                placeholder="Nama Lengkap"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                        </div>
                                        <div class="form-group">
                                            <label for="nomor_do"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Nomor
                                                DO</label>
                                            <input type="text" id="nomor_do" name="nomor_do"
                                                placeholder="Nomor Delivery Order"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Barang -->
                            <div
                                class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        Detail Barang
                                    </h3>
                                    <p class="text-emerald-100 text-sm mt-1">Informasi barang yang dikirim</p>
                                </div>
                                <div class="p-6 sm:p-8">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="form-group">
                                            <label for="jenis_barang"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Jenis
                                                Barang <span class="text-red-500">*</span></label>
                                            <input type="text" id="jenis_barang" name="jenis_barang" required
                                                placeholder="Contoh: Oli Mesin"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_barang"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Jumlah
                                                <span class="text-red-500">*</span></label>
                                            <input type="number" id="jumlah_barang" name="jumlah_barang" required
                                                min="1" placeholder="0"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Satuan
                                                <span class="text-red-500">*</span></label>
                                            <input type="text" id="satuan" name="satuan" required
                                                placeholder="L, KG, PCS"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pemeriksaan Barang -->
                            <div
                                class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Pemeriksaan Barang
                                    </h3>
                                    <p class="text-emerald-100 text-sm mt-1">Hasil pemeriksaan kondisi barang</p>
                                </div>
                                <div class="p-6 sm:p-8">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="form-group">
                                            <label for="kondisi_kemasan"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Kondisi
                                                Kemasan <span class="text-red-500">*</span></label>
                                            <select id="kondisi_kemasan" name="kondisi_kemasan" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                                <option value="Baik">Baik</option>
                                                <option value="Rusak">Rusak</option>
                                                <option value="Basah">Basah</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kesesuaian_jumlah"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Kesesuaian
                                                Jumlah <span class="text-red-500">*</span></label>
                                            <select id="kesesuaian_jumlah" name="kesesuaian_jumlah" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                                <option value="Sesuai">Sesuai</option>
                                                <option value="Kurang">Kurang</option>
                                                <option value="Lebih">Lebih</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelengkapan_dokumen"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Kelengkapan
                                                Dokumen <span class="text-red-500">*</span></label>
                                            <select id="kelengkapan_dokumen" name="kelengkapan_dokumen" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                                <option value="Lengkap">Lengkap</option>
                                                <option value="Tidak Lengkap">Tidak Lengkap</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pemeriksaan Truck Tangki -->
                            <div
                                class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        Pemeriksaan Khusus Truck Tangki
                                    </h3>
                                    <p class="text-emerald-100 text-sm mt-1">Pemeriksaan kebocoran oli untuk truck
                                        tangki</p>
                                </div>
                                <div class="p-6 sm:p-8">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="form-group">
                                            <label for="jenis_kendaraan"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Jenis
                                                Kendaraan <span class="text-red-500">*</span></label>
                                            <select id="jenis_kendaraan" name="jenis_kendaraan" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                                <option value="Truck Biasa">Truck Biasa</option>
                                                <option value="Truck Tangki">Truck Tangki</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kebocoran_tangki"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Kebocoran
                                                Tangki</label>
                                            <select id="kebocoran_tangki" name="kebocoran_tangki"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada Kebocoran Kecil">Ada Kebocoran Kecil</option>
                                                <option value="Ada Kebocoran Besar">Ada Kebocoran Besar</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kondisi_seal_tangki"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Kondisi
                                                Seal Tangki</label>
                                            <select id="kondisi_seal_tangki" name="kondisi_seal_tangki"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                                <option value="Baik">Baik</option>
                                                <option value="Rusak">Rusak</option>
                                                <option value="Tidak Ada">Tidak Ada</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi_kebocoran"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Lokasi
                                                Kebocoran</label>
                                            <input type="text" id="lokasi_kebocoran" name="lokasi_kebocoran"
                                                placeholder="Jika ada kebocoran, sebutkan lokasinya"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Catatan & Status -->
                            <div
                                class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Catatan & Status Akhir
                                    </h3>
                                    <p class="text-emerald-100 text-sm mt-1">Catatan tambahan dan keputusan akhir</p>
                                </div>
                                <div class="p-6 sm:p-8">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="form-group">
                                            <label for="catatan"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Catatan</label>
                                            <textarea id="catatan" name="catatan" rows="3"
                                                placeholder="Catatan tambahan..."
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_akhir"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Status
                                                Akhir <span class="text-red-500">*</span></label>
                                            <select id="status_akhir" name="status_akhir" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-emerald-500 focus:outline-none">
                                                <option value="Lolos">Lolos</option>
                                                <option value="Ditahan">Ditahan</option>
                                                <option value="Ditolak">Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Actions -->
                            <div class="flex items-center justify-end gap-4 pt-4">
                                <button type="reset"
                                    class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition-colors">Reset</button>
                                <button type="submit"
                                    class="submit-btn px-8 py-3 rounded-xl font-bold shadow-lg shadow-emerald-500/20">Simpan
                                    Data</button>
                            </div>
                        </form>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

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

        function showLogoutModal() {
            if (confirm('Apakah Anda yakin ingin keluar dari sistem?')) {
                document.getElementById('logoutForm').submit();
            }
        }

        if (sidebarToggle) sidebarToggle.addEventListener('click', toggleSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);
    </script>
</body>

</html>