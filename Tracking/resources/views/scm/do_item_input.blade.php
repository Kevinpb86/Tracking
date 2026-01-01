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
                        {{-- Admin Dashboard Link --}}
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center justify-between rounded-xl bg-blue-600 px-4 py-3 text-white shadow-lg shadow-blue-500/30 transition-all hover:bg-blue-700 hover:shadow-blue-600/40 hover:-translate-y-0.5">
                            <span class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="font-semibold text-sm">Admin Dashboard</span>
                            </span>
                            <div class="h-1.5 w-1.5 rounded-full bg-white/90"></div>
                        </a>

                        {{-- POS 1 Link --}}
                        <a href="{{ route('pos1.dashboard') }}"
                            class="group flex items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-blue-50 hover:text-blue-600">
                            <span class="flex items-center gap-3">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 transition-colors group-hover:bg-blue-500 group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 012-2v0m12 0a2 2 0 012-2v0m-2 2a2 2 0 012-2m-2 2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a1 1 0 00-1 1v4" />
                                    </svg>
                                </div>
                                <div class="text-left font-medium text-sm">
                                    <p class="text-xs font-bold uppercase tracking-wider text-blue-500/80">POS 1</p>
                                    <p>Checkpoint Kedatangan</p>
                                </div>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-300 transition-transform group-hover:translate-x-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        {{-- POS 2 Link --}}
                        <a href="{{ route('pos2.dashboard') }}"
                            class="group flex items-center justify-between rounded-xl border border-transparent px-4 py-3 text-slate-600 transition-all hover:bg-emerald-50 hover:text-emerald-600">
                            <span class="flex items-center gap-3">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div class="text-left font-medium text-sm">
                                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-500/80">POS 2</p>
                                    <p>Zona Distribusi</p>
                                </div>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-300 transition-transform group-hover:translate-x-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
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
                                    <a href="{{ route('scm.do-item.index') }}"
                                        class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm text-slate-500 transition-colors hover:bg-purple-50 hover:text-purple-700">
                                        <span>Daftar DO</span>
                                    </a>
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
                <section class="relative mx-auto w-full flex-1 px-4 py-8 sm:px-6 lg:px-8 max-w-7xl">
                    <!-- Header Section - PREMIUM REDESIGN -->
                    <div
                        class="relative mb-8 overflow-hidden rounded-3xl bg-slate-900 border border-slate-800 shadow-2xl">
                        {{-- Decorative Glows --}}
                        <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-purple-600/20 blur-[80px]">
                        </div>
                        <div class="absolute -left-24 -bottom-24 h-72 w-72 rounded-full bg-blue-600/10 blur-[80px]">
                        </div>

                        <div class="relative flex flex-col items-center px-8 py-10 text-center sm:px-16 lg:py-12">
                            <div
                                class="mb-4 inline-flex items-center gap-2 rounded-full bg-purple-500/10 px-4 py-1 border border-purple-500/20 backdrop-blur-md">
                                <span class="relative flex h-1.5 w-1.5">
                                    <span
                                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-purple-400 opacity-75"></span>
                                    <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-purple-500"></span>
                                </span>
                                <span class="text-[9px] font-bold uppercase tracking-[0.2em] text-purple-300">SCM
                                    Workspace</span>
                            </div>

                            <h1 class="mb-4 text-3xl font-black tracking-tight text-white sm:text-5xl leading-tight">
                                Input <span
                                    class="bg-gradient-to-r from-purple-400 to-indigo-400 bg-clip-text text-transparent">DO
                                    Item</span>
                            </h1>

                            <p class="max-w-2xl text-base font-medium text-slate-400 leading-relaxed">
                                Sistem manajemen rantai pasokan terpadu untuk efisiensi operasional.
                                Pastikan validitas data dokumen <span class="text-purple-400">VBELN</span> dan <span
                                    class="text-purple-400">POSNR</span>.
                            </p>

                            {{-- Stats/Info Bar --}}
                            <div class="mt-8 grid grid-cols-1 gap-3 sm:grid-cols-3 w-full max-w-2xl">
                                <div class="rounded-xl bg-white/5 p-3 border border-white/10 backdrop-blur-md">
                                    <p class="text-[9px] font-bold uppercase tracking-widest text-slate-500">Form
                                        Status</p>
                                    <p class="text-xs font-bold text-emerald-400">Ready</p>
                                </div>
                                <div class="rounded-xl bg-white/5 p-3 border border-white/10 backdrop-blur-md">
                                    <p class="text-[9px] font-bold uppercase tracking-widest text-slate-500">Module</p>
                                    <p class="text-xs font-bold text-white">Supply Chain</p>
                                </div>
                                <div class="rounded-xl bg-white/5 p-3 border border-white/10 backdrop-blur-md">
                                    <p class="text-[9px] font-bold uppercase tracking-widest text-slate-500">Integrity
                                    </p>
                                    <p class="text-xs font-bold text-blue-400">High Priority</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-8">
                        <!-- LEFT SIDE: Form Guideline -->
                        <div class="lg:w-1/3 space-y-6">
                            <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-100 h-fit sticky top-40">
                                <h4 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                                    <div
                                        class="h-8 w-8 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    Quick Guideline
                                </h4>

                                <ul class="space-y-4">
                                    <li class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                            01</div>
                                        <p class="text-sm text-slate-600 leading-relaxed"><span
                                                class="font-bold text-slate-900">VBELN</span> adalah Nomor Dokumen
                                            Penjualan (10 digit).</p>
                                    </li>
                                    <li class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                            02</div>
                                        <p class="text-sm text-slate-600 leading-relaxed"><span
                                                class="font-bold text-slate-900">POSNR</span> menunjukkan posisi item
                                            dalam dokumen (biasanya kelipatan 10).</p>
                                    </li>
                                    <li class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                            03</div>
                                        <p class="text-sm text-slate-600 leading-relaxed"><span
                                                class="font-bold text-slate-900">MATNR</span> adalah kode material
                                            internal perusahaan.</p>
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
                                        Penting
                                    </div>
                                    <p class="text-xs text-amber-600 leading-relaxed">
                                        Harap periksa kembali satuan ukuran (<span class="font-bold">VRKME</span>) untuk
                                        menghindari kesalahan perhitungan stok.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE: Input Form -->
                        <div class="lg:flex-1 pb-24">
                            <form action="{{ route('scm.do-item.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <div
                                    class="group relative bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 transition-all hover:shadow-2xl hover:shadow-purple-500/5 hover:-translate-y-1 overflow-hidden">
                                    <div
                                        class="h-2 w-full bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-500">
                                    </div>

                                    <div class="p-8 sm:p-10">
                                        <div class="mb-10">
                                            <h3 class="text-2xl font-black text-slate-900">Form Detail Item</h3>
                                            <p class="text-slate-500 text-sm mt-1">Lengkapi seluruh data mandatori yang
                                                bertanda bintang (*)</p>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                            {{-- VBELN --}}
                                            <div class="space-y-2">
                                                <label for="vbeln"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">No.
                                                    Penjualan (VBELN) <span class="text-rose-500">*</span></label>
                                                <div class="relative group">
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-purple-500 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                        </svg>
                                                    </div>
                                                    <input type="text" id="vbeln" name="vbeln" required
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 pl-12 pr-4 font-bold text-slate-900 transition-all focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-500/5"
                                                        placeholder="e.g. 0020003923">
                                                </div>
                                            </div>

                                            {{-- POSNR --}}
                                            <div class="space-y-2">
                                                <label for="posnr"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Posisi
                                                    Item (POSNR) <span class="text-rose-500">*</span></label>
                                                <div class="relative group">
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-purple-500 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                                        </svg>
                                                    </div>
                                                    <input type="text" id="posnr" name="posnr" required
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 pl-12 pr-4 font-bold text-slate-900 transition-all focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-500/5"
                                                        placeholder="e.g. 000010">
                                                </div>
                                            </div>

                                            {{-- MATNR --}}
                                            <div class="md:col-span-2 space-y-2">
                                                <label for="matnr"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Nomor
                                                    Material (MATNR) <span class="text-rose-500">*</span></label>
                                                <div class="relative group">
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-purple-500 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                        </svg>
                                                    </div>
                                                    <input type="text" id="matnr" name="matnr" required
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 pl-12 pr-4 font-bold text-slate-900 transition-all focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-500/5"
                                                        placeholder="e.g. MED-O-1001-L">
                                                </div>
                                            </div>

                                            {{-- ARKTX (Description) --}}
                                            <div class="md:col-span-2 space-y-2">
                                                <label for="arktx"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Deskripsi
                                                    Item (ARKTX)</label>
                                                <textarea id="arktx" name="arktx" rows="3"
                                                    class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 px-6 py-4 font-medium text-slate-900 transition-all focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-500/5"
                                                    placeholder="Contoh: Evalube Runner 4T 10W-30 API SL/JASO MA2..."></textarea>
                                            </div>

                                            {{-- IFIMG --}}
                                            <div class="space-y-2">
                                                <label for="ifimg"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Kuantitas
                                                    (IFIMG) <span class="text-rose-500">*</span></label>
                                                <div class="relative group">
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-purple-500 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                        </svg>
                                                    </div>
                                                    <input type="number" step="0.01" id="ifimg" name="ifimg" required
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 pl-12 pr-4 font-bold text-slate-900 transition-all focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-500/5"
                                                        placeholder="0.00">
                                                </div>
                                            </div>

                                            {{-- VRKME --}}
                                            <div class="space-y-2">
                                                <label for="vrkme"
                                                    class="block text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Satuan
                                                    (VRKME) <span class="text-rose-500">*</span></label>
                                                <div class="relative group">
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-purple-500 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                                        </svg>
                                                    </div>
                                                    <input type="text" id="vrkme" name="vrkme" required
                                                        class="w-full rounded-2xl border-2 border-slate-100 bg-slate-50 py-4 pl-12 pr-4 font-bold text-slate-900 transition-all focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-500/5"
                                                        placeholder="Contoh: L, KG, PCS">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-12 flex items-center justify-end gap-5">
                                            <button type="reset"
                                                class="rounded-2xl border-2 border-slate-100 px-8 py-4 text-sm font-black uppercase tracking-widest text-slate-500 transition-all hover:bg-slate-50 hover:text-slate-800 active:scale-95">
                                                Reset
                                            </button>
                                            <button type="submit"
                                                class="group relative overflow-hidden rounded-2xl bg-purple-600 px-10 py-4 text-sm font-black uppercase tracking-widest text-white shadow-xl shadow-purple-500/30 transition-all hover:bg-purple-700 hover:shadow-purple-600/40 active:scale-95">
                                                <span class="relative z-10 flex items-center gap-2">
                                                    Simpan Data DO
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 transition-transform group-hover:translate-x-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                    </svg>
                                                </span>
                                                <div
                                                    class="absolute inset-0 z-0 bg-gradient-to-r from-purple-400/20 to-transparent">
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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