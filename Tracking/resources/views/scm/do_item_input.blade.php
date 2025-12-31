<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input DO Item - SCM</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Custom styles - PURPLE THEME for SCM */
        .form-input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input:hover {
            border-color: #9333ea;
            box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.1);
            transform: translateY(-1px);
        }

        .form-input:focus {
            border-color: #9333ea;
            box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.2), 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transform: translateY(-1px);
        }

        .form-label {
            transition: all 0.2s ease;
        }

        .form-group:hover .form-label {
            color: #7e22ce;
        }

        .form-card {
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .submit-btn {
            background-color: #9333ea !important;
            color: #ffffff !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(147, 51, 234, 0.4);
            background-color: #7e22ce !important;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-purple-50 to-slate-100 font-sans antialiased min-h-screen">
    <div class="flex min-h-screen">
        <!-- SIDEBAR TOGGLE BUTTON -->
        <button id="sidebarToggle" type="button"
            class="fixed left-4 top-9 z-50 inline-flex h-12 w-12 items-center justify-center rounded-lg border border-slate-200 bg-white text-purple-600 shadow-sm transition hover:bg-purple-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-purple-500 focus-visible:ring-offset-2 cursor-pointer sm:left-6 sm:top-10 lg:left-8 lg:top-12"
            aria-label="Toggle navigation" aria-expanded="false">
            <span class="relative flex h-4 w-6 flex-col justify-between">
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
            </span>
        </button>

        <!-- SIDEBAR (Reusing main sidebar structure but can be modularized) -->
        <!-- Ideally, we should extend a layout, but for now copying structure to match SCM context -->
        <aside id="sidebar"
            class="fixed left-0 top-0 z-50 flex h-full w-72 -translate-x-full flex-col overflow-hidden border-r border-slate-200 bg-white/90 backdrop-blur-xl shadow-[4px_0_24px_rgba(0,0,0,0.02)] transition-transform duration-300 ease-in-out lg:w-80 font-sans">
            {{-- Branding Section --}}
            <div class="relative flex flex-col gap-6 overflow-y-auto px-6 py-8">
                <a href="{{ route('dashboard.main') }}"
                    class="group relative flex items-center gap-4 rounded-2xl bg-gradient-to-br from-slate-50 to-white p-4 shadow-sm border border-slate-100 transition-all hover:shadow-md hover:border-purple-100">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white p-1 shadow-sm ring-1 ring-slate-900/5 group-hover:scale-105 transition-transform">
                        <img src="{{ asset('images/wgilogo.jpg') }}" alt="Logo PT. WGI"
                            class="h-full w-full rounded-lg object-contain">
                    </div>
                    <div class="space-y-0.5">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-purple-600">Tracking System</p>
                        <p
                            class="text-sm font-bold text-slate-800 leading-tight group-hover:text-purple-700 transition-colors">
                            PT. Wiraswasta Gemilang Indonesia</p>
                    </div>
                </a>

                {{-- Navigation --}}
                <div class="flex flex-col gap-1">
                    <div class="mb-4 flex items-center justify-between px-2">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Navigasi SCM</p>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-purple-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-purple-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-purple-500 animate-pulse"></span>
                            Live
                        </span>
                    </div>

                    <nav class="space-y-2">
                        {{-- Dashboard Link --}}
                        <a href="{{ route('dashboard.main') }}"
                            class="group flex items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-slate-50 hover:text-purple-600">
                            <span class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-slate-400 transition-colors group-hover:text-purple-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                </svg>
                                <span class="font-medium text-sm">Dashboard Utama</span>
                            </span>
                        </a>

                        {{-- SCM Menu Accordion - ACTIVE --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleSCMMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-purple-700 bg-purple-50/50 transition-all hover:bg-purple-50/80 hover:text-purple-800">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100/50 text-purple-600 transition-colors group-hover:bg-purple-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-xs font-bold uppercase tracking-wider text-purple-500/80">SCM</p>
                                        <p>Supply Chain Mgmt</p>
                                    </div>
                                </span>
                                <svg id="scmToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-purple-400 transition-transform duration-300 group-hover:text-purple-600 rotate-180"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="scmSubmenu" class="space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('scm.do-item.input') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm bg-purple-50 text-purple-700 font-semibold transition-colors">
                                        <span>Input DO Item</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-purple-600"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
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
                        <div class="h-3 w-full bg-[#9333ea]"></div> {{-- Purple Stripe --}}
                        <div class="flex flex-wrap items-center gap-6 px-6 py-6 pl-20 sm:px-10 sm:pl-28">
                            <div class="flex min-w-[220px] flex-1 items-center gap-5 text-blue-900">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full border border-blue-900/20 bg-white p-2 shadow-lg shadow-blue-900/20">
                                    <img src="{{ asset('images/wgilogo.jpg') }}" alt="Logo PT. WGI"
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
                                    <span
                                        class="text-2xl font-black uppercase tracking-[0.25em] text-emerald-500 drop-shadow-sm">Evalube</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>

                <!-- PAGE CONTENT -->
                <section class="relative mx-auto w-full flex-1 px-4 py-8 sm:px-6 lg:px-8">
                    <!-- Header Section -->
                    <div
                        class="mx-auto max-w-4xl rounded-3xl border border-purple-100 bg-purple-50 shadow-xl overflow-hidden mb-8">
                        <div class="relative px-6 pt-10 pb-6 text-center sm:px-12">
                            <div class="relative z-10 flex flex-col items-center space-y-4">
                                <div
                                    class="inline-flex items-center gap-3 rounded-full bg-purple-100/50 px-4 py-1.5 border border-purple-200/50 backdrop-blur-sm">
                                    <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-purple-800">Form
                                        DO Item</span>
                                </div>
                                <h1
                                    class="text-4xl font-extrabold tracking-tight text-purple-600 sm:text-5xl lg:text-6xl text-center">
                                    Input DO Item
                                </h1>
                                <p class="max-w-2xl text-lg font-medium text-slate-600 leading-relaxed">
                                    Masukkan data item Delivery Order untuk keperluan SCM.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="max-w-5xl mx-auto w-full pb-20">
                        <form action="{{ route('scm.do-item.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div
                                class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        Detail DO Item
                                    </h3>
                                    <p class="text-purple-100 text-sm mt-1">Lengkapi informasi item di bawah ini</p>
                                </div>
                                <div class="p-6 sm:p-8">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        {{-- VBELN & POSNR --}}
                                        <div class="form-group">
                                            <label for="vbeln"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">No.
                                                Dokumen Penjualan (VBELN) <span class="text-red-500">*</span></label>
                                            <input type="text" id="vbeln" name="vbeln" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-purple-500 focus:outline-none"
                                                placeholder="Contoh: 0020003923">
                                        </div>
                                        <div class="form-group">
                                            <label for="posnr"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">No.
                                                Posisi Item (POSNR) <span class="text-red-500">*</span></label>
                                            <input type="text" id="posnr" name="posnr" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-purple-500 focus:outline-none"
                                                placeholder="Contoh: 000010">
                                        </div>

                                        {{-- MATNR --}}
                                        <div class="form-group md:col-span-2">
                                            <label for="matnr"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Nomor
                                                Material (MATNR) <span class="text-red-500">*</span></label>
                                            <input type="text" id="matnr" name="matnr" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-purple-500 focus:outline-none"
                                                placeholder="Contoh: M-101-222">
                                        </div>

                                        {{-- ARKTX (Description) --}}
                                        <div class="form-group md:col-span-2">
                                            <label for="arktx"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Teks
                                                Pendek (ARKTX)</label>
                                            <textarea id="arktx" name="arktx" rows="3"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-purple-500 focus:outline-none"
                                                placeholder="Deskripsi item..."></textarea>
                                        </div>

                                        {{-- IFIMG & VRKME --}}
                                        <div class="form-group">
                                            <label for="ifimg"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Kuantitas
                                                Item (IFIMG) <span class="text-red-500">*</span></label>
                                            <input type="number" step="0.01" id="ifimg" name="ifimg" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-purple-500 focus:outline-none"
                                                placeholder="0.00">
                                        </div>
                                        <div class="form-group">
                                            <label for="vrkme"
                                                class="form-label block text-sm font-semibold text-slate-700 mb-2">Satuan
                                                Ukuran (VRKME) <span class="text-red-500">*</span></label>
                                            <input type="text" id="vrkme" name="vrkme" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 text-slate-700 focus:border-purple-500 focus:outline-none"
                                                placeholder="Contoh: L, KG, PCS">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-4 pt-4">
                                <button type="reset"
                                    class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition-colors">
                                    Reset
                                </button>
                                <button type="submit"
                                    class="submit-btn px-8 py-3 rounded-xl font-bold shadow-lg shadow-purple-500/20">
                                    Simpan DO Item
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <!-- REUSED JS & MODAL (Simplified) -->
    <div id="logoutModal"
        class="fixed inset-0 z-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeLogoutModal()"></div>
        <div
            class="relative w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl transform scale-95 transition-transform duration-300">
            <h3 class="text-xl font-bold text-slate-900 text-center mb-4">Konfirmasi Logout</h3>
            <div class="flex gap-3">
                <button onclick="closeLogoutModal()"
                    class="flex-1 rounded-xl border border-slate-200 px-4 py-3 font-semibold hover:bg-slate-50">Batal</button>
                <button onclick="document.getElementById('logoutForm').submit()"
                    class="flex-1 rounded-xl bg-rose-600 text-white px-4 py-3 font-semibold hover:bg-rose-700">Ya,
                    Keluar</button>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const scmToggleIcon = document.getElementById('scmToggleIcon');
        const scmSubmenu = document.getElementById('scmSubmenu');
        const logoutModal = document.getElementById('logoutModal');

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

        function toggleSCMMenu() {
            if (scmSubmenu.classList.contains('hidden')) {
                scmSubmenu.classList.remove('hidden');
                scmToggleIcon.classList.add('rotate-180');
            } else {
                scmSubmenu.classList.add('hidden');
                scmToggleIcon.classList.remove('rotate-180');
            }
        }

        function showLogoutModal() {
            logoutModal.classList.remove('opacity-0', 'pointer-events-none');
            logoutModal.querySelector('div.relative').classList.remove('scale-95');
            logoutModal.querySelector('div.relative').classList.add('scale-100');
        }

        function closeLogoutModal() {
            logoutModal.classList.add('opacity-0', 'pointer-events-none');
            logoutModal.querySelector('div.relative').classList.remove('scale-100');
            logoutModal.querySelector('div.relative').classList.add('scale-95');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);
    </script>
</body>

</html>