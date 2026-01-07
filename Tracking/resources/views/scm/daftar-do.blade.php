<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Delivery Order - POS 2</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900">
    @php $evalubeLogoExists = file_exists(public_path('images/evalube.png')); @endphp

    <div class="relative min-h-screen overflow-x-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="h-full w-full bg-gradient-to-b from-white via-slate-50 to-slate-100"></div>
            <div
                class="absolute inset-x-0 top-0 h-48 bg-gradient-to-b from-emerald-100/20 via-emerald-50/10 to-transparent blur-2xl">
            </div>
        </div>

        <button id="sidebarToggle" type="button"
            class="fixed left-4 top-9 z-50 inline-flex h-12 w-12 items-center justify-center rounded-lg border border-slate-200 bg-white text-emerald-600 shadow-sm transition hover:bg-emerald-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2 cursor-pointer sm:left-6 sm:top-10 lg:left-8 lg:top-12">
            <span class="relative flex h-4 w-6 flex-col justify-between">
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
            </span>
        </button>

        {{-- SIDEBAR --}}
        <aside id="sidebar"
            class="fixed left-0 top-0 z-50 flex h-full w-72 -translate-x-full flex-col overflow-hidden border-r border-slate-200 bg-white/90 backdrop-blur-xl shadow-[4px_0_24px_rgba(0,0,0,0.02)] transition-transform duration-300 ease-in-out lg:w-80 font-sans">
            <div class="relative flex flex-col gap-6 overflow-y-auto px-6 py-8">
                <a href="{{ route('dashboard.main') }}"
                    class="group relative flex items-center gap-4 rounded-2xl bg-gradient-to-br from-slate-50 to-white p-4 shadow-sm border border-slate-100 transition-all hover:shadow-md hover:border-emerald-100">
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

                <div class="flex flex-col gap-1">
                    <div class="mb-4 flex items-center justify-between px-2">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Navigasi Pos 2</p>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-emerald-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>Live
                        </span>
                    </div>

                    <nav class="space-y-2">
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

                        {{-- Cek Barang Menu --}}
                        <div class="space-y-1">
                            <button type="button" onclick="toggleCekBarangMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-emerald-50/50 hover:text-emerald-700">
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
                                            Barang</p>
                                        <p>Distribution Check</p>
                                    </div>
                                </span>
                                <svg id="cekBarangToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-emerald-400 transition-transform duration-300 group-hover:text-emerald-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="cekBarangSubmenu" class="hidden space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('cek-barang.create') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>Form Distribusi</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 text-slate-400 group-hover:text-emerald-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('cek-barang.index') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>Daftar Distribusi</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 opacity-0 transition-opacity group-hover:opacity-100"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Cek DO Menu - ACTIVE --}}
                        <div class="space-y-1 pt-2">
                            <button type="button" onclick="toggleCekDOMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 bg-emerald-50/50 text-emerald-700 transition-all hover:bg-emerald-50 hover:text-emerald-800">
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
                                        <p class="text-xs font-bold uppercase tracking-wider text-emerald-500/80">Cek DO
                                        </p>
                                        <p>Delivery Order Check</p>
                                    </div>
                                </span>
                                <svg id="cekDOToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-emerald-400 transition-transform duration-300 group-hover:text-emerald-600 rotate-180"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="cekDOSubmenu" class="space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('scm.do-item.index') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm transition-colors bg-emerald-50 text-emerald-700 font-semibold">
                                        <span>Daftar DO</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-emerald-600"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Tracking Menu Accordion --}}
                        <div class="space-y-1 pt-2">
                            <button type="button" onclick="toggleTrackingMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-emerald-50/50 hover:text-emerald-700">
                                <span class="flex items-center gap-3">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100/50 text-emerald-600 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="text-left font-medium text-sm">
                                        <p class="text-xs font-bold uppercase tracking-wider text-emerald-500/80">
                                            Tracking
                                        </p>
                                        <p>Vehicle Monitoring</p>
                                    </div>
                                </span>
                                <svg id="trackingToggleIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-emerald-400 transition-transform duration-300 group-hover:text-emerald-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="trackingSubmenu" class="hidden space-y-1 pl-4">
                                <div class="relative ml-4 space-y-1 border-l-2 border-slate-100 pl-4 py-1">
                                    <a href="{{ route('tracking.index') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-emerald-50 hover:text-emerald-700">
                                        <span>History Tracking</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 text-slate-400 group-hover:text-emerald-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
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
                        <div class="flex min-w-[200px] flex-1 justify-center text-center sm:justify-start sm:text-left">
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

            <header class="px-8 pt-12 sm:px-12 lg:px-24">
                <div
                    class="mx-auto max-w-7xl rounded-3xl bg-gradient-to-r from-emerald-500 to-emerald-600 p-10 shadow-xl">
                    <div class="space-y-4 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm1 2h6v1H7V4zm-1 2a1 1 0 011 1v.01a1 1 0 11-2 0V7a1 1 0 011-1zm2 0h6v2H9V6zm-2 4a1 1 0 011 1v.01a1 1 0 11-2 0V11a1 1 0 011-1zm2 0h6v2H9v-2zm-2 4a1 1 0 011 1v.01a1 1 0 11-2 0V15a1 1 0 011-1zm2 0h6v2H9v-2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-[0.5em] text-white">Daftar Delivery Order</p>
                        </div>
                        <h1 class="text-4xl font-bold text-white sm:text-5xl leading-tight">Delivery Order List</h1>
                        <div class="mx-auto h-1 w-20 bg-white/50"></div>
                        <p class="mx-auto text-sm leading-relaxed text-white/90 max-w-2xl">
                            Daftar lengkap item dalam Delivery Order. Pantau detail logistik dengan presisi dan
                            efisiensi.
                        </p>
                    </div>
                </div>
            </header>

            <section class="relative mx-auto w-full flex-1 px-8 py-16 sm:px-12 lg:px-24">
                <div class="mx-auto max-w-7xl">
                    @if (session('success'))
                        <div
                            class="mb-8 flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50/50 p-4 text-emerald-700 shadow-sm backdrop-blur-md">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
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
                            <input type="text" placeholder="Cari Dokumen, Material, Deskripsi..."
                                class="w-full rounded-2xl border-0 bg-white py-4 pl-12 pr-4 text-sm font-medium text-slate-600 shadow-lg shadow-slate-200/50 ring-1 ring-slate-100 transition focus:ring-2 focus:ring-emerald-500/50 outline-none placeholder:text-slate-400">
                        </div>

                        <div class="flex items-center gap-4" x-data="{ count: 0 }"
                            x-on:do-items-updated.window="count = $event.detail">
                            <div class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Total Item: <span class="text-emerald-600 text-lg ml-1" x-text="count">0</span>
                            </div>
                            <a href="{{ route('scm.do-item.input') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-slate-900/20 transition-all hover:bg-slate-800 hover:scale-105 active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Input DO Item
                            </a>
                        </div>
                    </div>

                    <div x-data="{ 
                    doItems: [], 
                    loading: true,
                    init() {
                        this.fetchData();
                    },
                    fetchData() {
                        this.loading = true;
                        fetch('/api/do-items')
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    this.doItems = data.data;
                                    window.dispatchEvent(new CustomEvent('do-items-updated', { detail: this.doItems.length }));
                                }
                                this.loading = false;
                            })
                            .catch(error => {
                                console.error('Error fetching DO items:', error);
                                this.loading = false;
                            });
                    },
                    formatNumber(num) {
                        return new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(num);
                    }
                }">
                        {{-- Loading State --}}
                        <template x-if="loading">
                            <div class="flex flex-col items-center justify-center py-24">
                                <div
                                    class="h-12 w-12 animate-spin rounded-full border-4 border-emerald-500 border-t-transparent">
                                </div>
                                <p class="mt-4 text-slate-500 font-medium italic">Mengambil data dari server...</p>
                            </div>
                        </template>

                        {{-- Empty State --}}
                        <template x-if="!loading && doItems.length === 0">
                            <div
                                class="flex flex-col items-center justify-center rounded-[2rem] border-2 border-dashed border-slate-200 bg-slate-50/50 py-24 text-center">
                                <div
                                    class="mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-white shadow-xl shadow-slate-200/50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm1 2h6v1H7V4zm-1 2a1 1 0 011 1v.01a1 1 0 11-2 0V7a1 1 0 011-1zm2 0h6v2H9V6zm-2 4a1 1 0 011 1v.01a1 1 0 11-2 0V11a1 1 0 011-1zm2 0h6v2H9v-2zm-2 4a1 1 0 011 1v.01a1 1 0 11-2 0V15a1 1 0 011-1zm2 0h6v2H9v-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800">Belum Ada Data DO Item</h3>
                                <p class="mt-2 text-slate-500 max-w-sm mx-auto">Data item delivery order akan muncul di
                                    sini.
                                    Mulai dengan menginput item DO baru.</p>
                            </div>
                        </template>

                        {{-- Table Layout --}}
                        <template x-if="!loading && doItems.length > 0">
                            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
                                <div class="overflow-x-auto">
                                    <table class="w-full min-w-[1000px]">
                                        <thead>
                                            <tr
                                                class="bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-sm">
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider w-20">
                                                    ID</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                                    No Dokumen (VBELN)</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                                    Posisi (POSNR)</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                                    Material (MATNR)</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                                    Deskripsi (ARKTX)</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                                    Kuantitas (IFIMG)</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider w-24">
                                                    Satuan</th>
                                                <th
                                                    class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider w-24">
                                                    Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100">
                                            <template x-for="item in doItems" :key="item.id">
                                                <tr
                                                    class="bg-white hover:bg-slate-50/80 transition-colors duration-150 group">
                                                    <td class="px-6 py-4">
                                                        <span x-text="item.id"
                                                            class="inline-block font-bold text-slate-700 bg-slate-100 px-2.5 py-1 rounded text-xs border border-slate-200">
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 text-sm font-bold text-slate-900 font-mono"
                                                        x-text="item.vbeln"></td>
                                                    <td class="px-6 py-4 text-sm font-medium text-slate-600"
                                                        x-text="item.posnr"></td>
                                                    <td class="px-6 py-4 text-sm font-bold text-slate-700 font-mono"
                                                        x-text="item.matnr"></td>
                                                    <td class="px-6 py-4 text-sm text-slate-600"
                                                        x-text="item.arktx || '-'"></td>
                                                    <td class="px-6 py-4 text-sm font-black text-slate-900"
                                                        x-text="formatNumber(item.ifimg)"></td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span x-text="item.vrkme.toUpperCase()"
                                                            class="inline-flex items-center justify-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold tracking-wide text-emerald-700 border border-emerald-200">
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <div class="relative inline-block text-left"
                                                            x-data="{ open: false }">
                                                            <button @click="open = !open"
                                                                class="text-slate-400 hover:text-emerald-600 transition-colors p-1 rounded-full hover:bg-slate-100 focus:outline-none">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                                </svg>
                                                            </button>
                                                            <div x-show="open" @click.away="open = false" x-cloak
                                                                class="absolute right-0 top-8 z-10 w-32 origin-top-right rounded-xl border border-slate-100 bg-white shadow-xl overflow-hidden">
                                                                <div class="py-1 text-left">
                                                                    <a :href="`/scm/do-item/${item.id}/edit`"
                                                                        class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="h-4 w-4" fill="none"
                                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                        </svg>
                                                                        Edit
                                                                    </a>
                                                                    <button type="button"
                                                                        @click="confirmDeleteItem(item.id, item.vbeln)"
                                                                        class="flex w-full items-center gap-2 px-4 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="h-4 w-4" fill="none"
                                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                        </svg>
                                                                        Delete
                                                                    </button>
                                                                    <form :id="`delete-item-form-${item.id}`"
                                                                        :action="`/scm/do-item/${item.id}`"
                                                                        method="POST" class="hidden">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>
        </main>
    </div>

    {{-- Logout Modal --}}
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
                    class="flex-1 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</button>
                <button type="button" onclick="document.getElementById('logoutForm').submit()"
                    class="flex-1 rounded-xl bg-rose-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-rose-600/20 transition hover:bg-rose-700">Ya,
                    Keluar</button>
            </div>
        </div>
    </div>

    {{-- DO Item Delete Modal --}}
    <div id="deleteItemModal"
        class="fixed inset-0 z-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeDeleteItemModal()"></div>
        <div
            class="relative w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl transform scale-95 transition-transform duration-300 text-center">
            <div class="mb-6 flex flex-col items-center">
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-rose-100 text-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900">Hapus DO Item</h3>
                <p class="mt-2 text-sm text-slate-500">Yakin ingin menghapus item dengan nomor <span
                        id="deleteItemVbeln" class="font-bold text-slate-900"></span>?</p>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteItemModal()"
                    class="flex-1 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</button>
                <button type="button" id="confirmDeleteItemBtn"
                    class="flex-1 rounded-xl bg-rose-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-rose-600/20 transition hover:bg-rose-700">Ya,
                    Hapus</button>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
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
            logoutModal.classList.remove('opacity-0', 'pointer-events-none');
            logoutModalContent.classList.remove('scale-95');
            logoutModalContent.classList.add('scale-100');
        }

        function closeLogoutModal() {
            logoutModal.classList.add('opacity-0', 'pointer-events-none');
            logoutModalContent.classList.remove('scale-100');
            logoutModalContent.classList.add('scale-95');
        }

        function confirmDeleteItem(id, vbeln) {
            const modal = document.getElementById('deleteItemModal');
            const modalContent = modal.querySelector('div.transform');
            const vbelnSpan = document.getElementById('deleteItemVbeln');
            const confirmBtn = document.getElementById('confirmDeleteItemBtn');

            vbelnSpan.textContent = vbeln;
            confirmBtn.onclick = () => document.getElementById(`delete-item-form-${id}`).submit();

            modal.classList.remove('opacity-0', 'pointer-events-none');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }

        function closeDeleteItemModal() {
            const modal = document.getElementById('deleteItemModal');
            const modalContent = modal.querySelector('div.transform');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
        }

        // Toggle Tracking menu
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

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);
    </script>
</body>

</html>