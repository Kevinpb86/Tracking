<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit DO Item - SCM</title>
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

        <aside id="sidebar"
            class="fixed left-0 top-0 z-50 flex h-full w-72 -translate-x-full flex-col overflow-hidden border-r border-slate-200 bg-white/90 backdrop-blur-xl shadow-[4px_0_24px_rgba(0,0,0,0.02)] transition-transform duration-300 ease-in-out lg:w-80 font-sans">
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
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center justify-between rounded-xl bg-blue-600 px-4 py-3 text-white shadow-lg shadow-blue-500/30 transition-all hover:bg-blue-700 hover:shadow-blue-600/40 hover:-translate-y-0.5">
                            <span class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span class="font-semibold text-sm">Admin Dashboard</span>
                            </span>
                            <div class="h-1.5 w-1.5 rounded-full bg-white/90"></div>
                        </a>

                        {{-- Administrator Menu Accordion --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleAdminMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-blue-50/50 hover:text-blue-700">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100/50 text-blue-600 transition-colors group-hover:bg-blue-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-blue-500/80">
                                            System</p>
                                        <p>Administrator</p>
                                    </div>
                                </span>
                                <svg id="adminToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-slate-300 transition-transform duration-300 group-hover:text-blue-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="adminSubmenu" class="space-y-1 pl-4 hidden">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('admin.users') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                        <span>User Management</span>
                                    </a>
                                </div>
                            </div>
                        </div>

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
                                    <a href="{{ route('scm.do-item.index') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-purple-50 hover:text-purple-700">
                                        <span>Daftar DO</span>
                                    </a>
                                    <a href="{{ route('scm.do-item.input') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-purple-50 hover:text-purple-700">
                                        <span>Input DO Item</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="mt-auto border-t border-slate-100 bg-slate-50/50 p-4">
                <button type="button" onclick="showLogoutModal()"
                    class="flex w-full cursor-pointer items-center justify-center gap-2 rounded-xl bg-white border border-rose-100 px-4 py-2.5 text-sm font-semibold text-rose-600 shadow-sm transition-all duration-200 hover:bg-rose-600 hover:text-white hover:border-rose-600 hover:shadow-lg hover:-translate-y-0.5 active:scale-95">
                    Sign Out
                </button>
            </div>
        </aside>

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
                        <div class="h-3 w-full bg-[#9333ea]"></div>
                        <div class="flex flex-wrap items-center gap-6 px-6 py-6 pl-20 sm:px-10 sm:pl-28">
                            <div class="flex items-center gap-5">
                                <img src="{{ asset('images/wgilogo.jpg') }}" class="h-16 w-16 object-contain">
                                <div class="space-y-1">
                                    <span
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-widest">Tracking
                                        System</span>
                                    <div class="text-lg font-bold italic leading-tight text-blue-900">PT Wiraswasta
                                        Gemilang Indonesia</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="relative mx-auto w-full flex-1 px-4 py-8 sm:px-6 lg:px-8">
                    <div class="max-w-5xl mx-auto w-full pb-20">
                        <header class="mb-8">
                            <a href="{{ route('scm.do-item.index') }}"
                                class="text-purple-600 font-semibold hover:text-purple-700 flex items-center gap-2 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali ke Daftar DO
                            </a>
                            <h1 class="text-3xl font-bold text-slate-800">Edit DO Item</h1>
                            <p class="text-slate-500">Perbarui informasi item Delivery Order</p>
                        </header>

                        <form action="{{ route('scm.do-item.update', $doItem->id) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <div
                                class="form-card bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                                    <h3 class="text-xl font-bold text-white flex items-center gap-2">Detail DO Item</h3>
                                </div>
                                <div class="p-6 sm:p-8">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="form-group">
                                            <label class="form-label block text-sm font-semibold mb-2">No. Dokumen
                                                (VBELN)</label>
                                            <input type="text" name="vbeln" value="{{ $doItem->vbeln }}" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 focus:border-purple-500 focus:outline-none">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label block text-sm font-semibold mb-2">No. Posisi
                                                (POSNR)</label>
                                            <input type="text" name="posnr" value="{{ $doItem->posnr }}" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 focus:border-purple-500 focus:outline-none">
                                        </div>
                                        <div class="form-group md:col-span-2">
                                            <label class="form-label block text-sm font-semibold mb-2">Nomor Material
                                                (MATNR)</label>
                                            <input type="text" name="matnr" value="{{ $doItem->matnr }}" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 focus:border-purple-500 focus:outline-none">
                                        </div>
                                        <div class="form-group md:col-span-2">
                                            <label class="form-label block text-sm font-semibold mb-2">Deskripsi
                                                (ARKTX)</label>
                                            <textarea name="arktx" rows="3"
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 focus:border-purple-500 focus:outline-none">{{ $doItem->arktx }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label block text-sm font-semibold mb-2">Kuantitas
                                                (IFIMG)</label>
                                            <input type="number" step="0.01" name="ifimg" value="{{ $doItem->ifimg }}"
                                                required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 focus:border-purple-500 focus:outline-none">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label block text-sm font-semibold mb-2">Satuan
                                                (VRKME)</label>
                                            <input type="text" name="vrkme" value="{{ $doItem->vrkme }}" required
                                                class="form-input w-full rounded-lg border-2 border-slate-200 px-4 py-3 focus:border-purple-500 focus:outline-none">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-4">
                                <button type="submit" class="submit-btn px-8 py-3 rounded-xl font-bold shadow-lg">Simpan
                                    Perubahan</button>
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
        const scmSubmenu = document.getElementById('scmSubmenu');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('opacity-0');
            sidebarOverlay.classList.toggle('pointer-events-none');
        }

        // Admin Menu Toggle Function
        function toggleAdminMenu() {
            const submenu = document.getElementById('adminSubmenu');
            const icon = document.getElementById('adminToggleIcon');

            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                submenu.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        function toggleSCMMenu() {
            scmSubmenu.classList.toggle('hidden');
            document.getElementById('scmToggleIcon').classList.toggle('rotate-180');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);
    </script>
</body>

</html>