<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input HSE - POS 1</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Library untuk generate PDF dan gambar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    
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
        
        /* Print styles - hide elemen yang tidak perlu saat cetak */
        @media print {
            #sidebar, #sidebarToggle, #sidebarOverlay, .no-print {
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
<body class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900">
    @php
        $evalubeLogoExists = file_exists(public_path('images/evalube.png'));
    @endphp

    <div class="relative min-h-screen overflow-x-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="h-full w-full bg-gradient-to-b from-white via-slate-50 to-slate-100"></div>
            <div class="absolute inset-x-0 top-0 h-48 bg-gradient-to-b from-blue-100/20 via-blue-50/10 to-transparent blur-2xl"></div>
        </div>

        <button
            id="sidebarToggle"
            type="button"
            class="fixed left-4 top-9 z-20 inline-flex h-12 w-12 items-center justify-center rounded-lg border border-slate-200 bg-white text-blue-600 shadow-sm transition hover:bg-blue-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 cursor-pointer sm:left-6 sm:top-10 lg:left-8 lg:top-12"
            aria-label="Toggle navigation"
            aria-expanded="false"
        >
            <span class="relative flex h-4 w-6 flex-col justify-between">
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
                <span class="block h-0.5 w-full rounded-full bg-current transition-all"></span>
            </span>
        </button>

        <aside
            id="sidebar"
            class="fixed left-0 top-0 z-40 flex h-full w-72 -translate-x-full flex-col overflow-hidden border-r border-slate-200 bg-white shadow-lg transition-transform duration-300 ease-in-out lg:w-80"
        >
            <div class="relative flex h-full flex-col gap-6 overflow-y-auto p-8">
                <div class="relative flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="flex h-14 w-14 items-center justify-center rounded-lg border border-blue-100 bg-blue-50 p-1.5">
                        <img
                            src="{{ asset('images/wgilogo.jpg') }}"
                            alt="Logo PT. Wiraswasta Gemilang Indonesia"
                            class="h-full w-full rounded-xl object-contain"
                        >
                    </div>
                    <div class="space-y-1">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.45em] text-blue-500">Tracking System</p>
                        <p class="text-base font-semibold text-slate-900 leading-snug">PT. Wiraswasta Gemilang Indonesia</p>
                    </div>
                </div>

                <div class="relative space-y-3">
                    <div class="flex items-center justify-between">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-500">Navigasi Pos</p>
                        <span class="rounded-full bg-blue-50 px-3 py-0.5 text-[10px] font-semibold uppercase tracking-[0.3em] text-blue-500">Live</span>
                    </div>
                    <nav class="flex flex-col gap-3 text-sm font-semibold text-slate-600">
                        <a
                            href="{{ route('pos1.dashboard') }}"
                            class="group flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-5 py-4 transition duration-200 hover:border-slate-300 hover:bg-slate-100 hover:text-slate-700"
                        >
                            <span class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-base">Dashboard Pos 1</span>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition duration-200 group-hover:text-slate-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.22 14.78a.75.75 0 0 1 0-1.06L10.94 10 7.22 6.28a.75.75 0 1 1 1.06-1.06l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0Z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a
                            href="#"
                            class="group flex items-center justify-between rounded-xl border border-blue-100 bg-white px-5 py-4 transition duration-200 hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700"
                        >
                            <span class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600 transition duration-200 group-hover:bg-blue-500 group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h9.5A2.25 2.25 0 0 1 17 4.25v11.5A2.25 2.25 0 0 1 14.75 18h-9.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span class="flex flex-col gap-0.5">
                                    <span class="text-[11px] uppercase tracking-[0.3em] text-blue-400">Antrian</span>
                                    <span class="text-base">Daftar Antrian</span>
                                </span>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400 transition duration-200 group-hover:text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.22 14.78a.75.75 0 0 1 0-1.06L10.94 10 7.22 6.28a.75.75 0 1 1 1.06-1.06l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0Z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <div class="space-y-1">
                            <button
                                type="button"
                                onclick="toggleHSEMenu()"
                                class="group flex w-full items-center justify-between rounded-xl border border-emerald-100 bg-emerald-50 px-5 py-4 transition duration-200 hover:border-emerald-300 hover:bg-emerald-100 hover:text-emerald-700"
                            >
                                <span class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-500 text-white transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 6a2 2 0 0 1 2-2h5l2 2h5a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Z" />
                                        </svg>
                                    </span>
                                    <span class="flex flex-col gap-0.5">
                                        <span class="text-[11px] uppercase tracking-[0.3em] text-emerald-500">HSE</span>
                                        <span class="text-base">Health Safety Environment</span>
                                    </span>
                                </span>
                                <svg id="hseToggleIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-400 transition-transform rotate-180 group-hover:text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="hseSubmenu" class="ml-8 space-y-1">
                                <a
                                    href="{{ route('hse.input') }}"
                                    class="group flex items-center justify-between rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 transition duration-200 hover:border-emerald-300 hover:bg-emerald-100 hover:text-emerald-700"
                                >
                                    <span class="flex items-center gap-3">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500 transition duration-200 group-hover:bg-emerald-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h9.5A2.25 2.25 0 0 1 17 4.25v11.5A2.25 2.25 0 0 1 14.75 18h-9.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
<<<<<<< HEAD
                                        <span class="text-sm font-semibold text-emerald-700">Input HSE</span>
=======
                                        <span class="text-sm font-semibold">Input HSE</span>
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-400 transition duration-200 group-hover:text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.22 14.78a.75.75 0 0 1 0-1.06L10.94 10 7.22 6.28a.75.75 0 1 1 1.06-1.06l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0Z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a
                                    href="{{ route('hse.daftar') }}"
                                    class="group flex items-center justify-between rounded-xl border border-emerald-100 bg-white px-4 py-3 transition duration-200 hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700"
                                >
                                    <span class="flex items-center gap-3">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 transition duration-200 group-hover:bg-emerald-500 group-hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h9.5A2.25 2.25 0 0 1 17 4.25v11.5A2.25 2.25 0 0 1 14.75 18h-9.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <span class="text-sm">Daftar HSE</span>
>>>>>>> ac793ad587424a72d39511f66681165145844912
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-400 transition duration-200 group-hover:text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.22 14.78a.75.75 0 0 1 0-1.06L10.94 10 7.22 6.28a.75.75 0 1 1 1.06-1.06l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0Z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="mt-auto pt-2">
                    @csrf
                    <button
                        type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-rose-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-300 focus-visible:ring-offset-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.5 6.75h-6a2 2 0 0 0-2 2v6.5a2 2 0 0 0 2 2h6M12 9.75l2.75 2.75L12 15.25M14.75 12.5H5" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div
            id="sidebarOverlay"
            class="fixed inset-0 z-30 bg-slate-900/10 opacity-0 transition-opacity duration-300 ease-in-out pointer-events-none"
        ></div>

        <main class="relative flex min-h-screen flex-col pt-32 sm:pt-36 lg:pt-40">
            <section class="fixed inset-x-0 top-0 z-10">
                <div class="overflow-hidden border-b border-slate-200 bg-white text-slate-700 shadow-sm">
                    <div class="h-3 w-full bg-[#2736a3]"></div>
                    <div class="flex flex-wrap items-center gap-6 px-6 py-6 pl-20 sm:px-10 sm:pl-28">
                        <div class="flex min-w-[220px] flex-1 items-center gap-5 text-blue-900">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full border border-blue-900/20 bg-white p-2 shadow-lg shadow-blue-900/20">
                                <img src="{{ asset('images/wgilogo.jpg') }}" alt="Logo PT. Wiraswasta Gemilang Indonesia" class="h-full w-full object-contain">
                            </div>
                            <div class="space-y-1">
                                <span class="block text-xs font-semibold uppercase tracking-[0.55em] text-slate-500">Tracking System</span>
                                <div class="text-lg font-bold italic leading-tight text-blue-900">
                                    <span class="block">PT Wiraswasta Gemilang</span>
                                    <span class="block whitespace-nowrap">Indonesia</span>
                                </div>
                            </div>
                        </div>
                        <div class="hidden h-14 w-px bg-slate-900 sm:ml-5 sm:block lg:ml-10"></div>
                        <div class="flex min-w-[200px] flex-1 justify-center text-center sm:justify-start sm:text-left">
                            <span class="text-base font-medium uppercase tracking-[0.45em] text-slate-500 whitespace-nowrap">
                                Tracking Information System
                            </span>
                        </div>
                        <div class="hidden h-14 w-px bg-slate-900 sm:ml-7 sm:block lg:ml-16 xl:ml-20"></div>
                        <div class="flex min-w-[160px] flex-1 justify-center sm:justify-end">
                            @if ($evalubeLogoExists)
                                <img src="{{ asset('images/evalube.png') }}" alt="Evalube Lubricants" class="h-12 w-auto object-contain">
                            @else
                                <div class="flex flex-col items-center text-center sm:items-end sm:text-right">
                                    <span class="text-2xl font-black uppercase tracking-[0.25em] text-emerald-500 drop-shadow-sm">Evalube</span>
                                    <span class="text-xs font-semibold uppercase tracking-[0.5em] text-slate-500">Lubricants</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <header class="px-8 pt-12 sm:px-12 lg:px-24">
                <div class="mx-auto rounded-none border-2 border-emerald-200 bg-gradient-to-br from-white via-emerald-50/50 to-white p-10 shadow-lg">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-none bg-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold uppercase tracking-[0.5em] text-emerald-700">
                                Input HSE Form
                            </p>
                        </div>
                        <h1 class="text-4xl font-bold text-slate-900 sm:text-5xl leading-tight">
                            Health Safety Environment
                        </h1>
                        <div class="h-1 w-20 bg-emerald-600"></div>
                        <p class="text-sm leading-relaxed text-slate-700 max-w-3xl">
                            Lengkapi form HSE untuk memastikan keselamatan dan kesehatan kerja di area operasional. Semua data yang diinput akan tersimpan untuk keperluan dokumentasi dan audit.
                        </p>
                    </div>
                </div>
            </header>

            <section class="relative mx-auto w-full flex-1 px-8 py-16 sm:px-12 lg:px-24">
                <div class="mx-auto max-w-4xl">
<<<<<<< HEAD
                    @if (session('success'))
                        <div class="mb-6 rounded-none border-2 border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-none border-2 border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700 shadow-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('hse.store') }}" method="POST" class="space-y-8" id="hseForm">
=======

                    <form action="{{ route('hse.store') }}" method="POST" class="space-y-8">
>>>>>>> ac793ad587424a72d39511f66681165145844912
                        @csrf

                    @if (session('success'))
                        <div class="mb-6 rounded-none border-2 border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-none border-2 border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700 shadow-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('hse.store') }}" method="POST" class="space-y-8" id="hseForm">

                        <div class="form-card rounded-2xl border-2 border-slate-200 bg-gradient-to-br from-white to-emerald-50/30 p-8 shadow-lg">
                            <h2 class="text-sm font-semibold uppercase tracking-[0.35em] text-emerald-600/80 mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Informasi Umum
                            </h2>
                            
                            <div class="space-y-6">
                                <div class="form-group">
                                    <label for="tanggal" class="form-label block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                        Tanggal <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="date"
                                        id="tanggal"
                                        name="tanggal"
                                        value="{{ date('Y-m-d') }}"
                                        required
                                        class="form-input w-full rounded-none border-2 border-slate-300 bg-white px-4 py-3.5 text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 focus:outline-none"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="waktu" class="form-label block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                        Waktu <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="time"
                                        id="waktu"
                                        name="waktu"
                                        value="{{ date('H:i') }}"
                                        required
                                        class="form-input w-full rounded-none border-2 border-slate-300 bg-white px-4 py-3.5 text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 focus:outline-none"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="nama_petugas" class="form-label block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                        </svg>
                                        Nama Petugas <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="nama_petugas"
                                        name="nama_petugas"
                                        value="{{ Auth::user()->name ?? '' }}"
                                        required
                                        class="form-input w-full rounded-none border-2 border-slate-300 bg-white px-4 py-3.5 text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 focus:outline-none"
                                        placeholder="Masukkan nama petugas"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="lokasi" class="form-label block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        Lokasi <span class="text-red-500">*</span>
                                    </label>
                                    <select
                                        id="lokasi"
                                        name="lokasi"
                                        required
                                        class="form-input w-full rounded-none border-2 border-slate-300 bg-white px-4 py-3.5 text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 focus:outline-none cursor-pointer"
                                    >
                                        <option value="">Pilih Lokasi</option>
                                        <option value="Pos 1 - Checkpoint Kedatangan">Pos 1 - Checkpoint Kedatangan</option>
                                        <option value="Pos 2 - Zona Distribusi">Pos 2 - Zona Distribusi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-card rounded-2xl border-2 border-slate-200 bg-gradient-to-br from-white to-emerald-50/30 p-8 shadow-lg">
                            <h2 class="text-sm font-semibold uppercase tracking-[0.35em] text-emerald-600/80 mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Kondisi Keselamatan
                            </h2>
                            
                            <div class="space-y-6">
                                <div class="form-group">
                                    <label class="form-label block text-sm font-semibold text-slate-700 mb-3 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                        </svg>
                                        Kondisi APD (Alat Pelindung Diri) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="space-y-2">
                                        <label class="radio-option flex items-center gap-3 cursor-pointer rounded-lg border-2 border-slate-200 bg-white px-4 py-3 transition-all hover:border-emerald-300 hover:shadow-md">
                                            <input type="radio" name="kondisi_apd" value="Lengkap" required class="h-5 w-5 text-emerald-600 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 cursor-pointer">
                                            <span class="text-sm font-medium text-slate-700">Lengkap</span>
                                        </label>
                                        <label class="radio-option flex items-center gap-3 cursor-pointer rounded-lg border-2 border-slate-200 bg-white px-4 py-3 transition-all hover:border-emerald-300 hover:shadow-md">
                                            <input type="radio" name="kondisi_apd" value="Tidak Lengkap" required class="h-5 w-5 text-emerald-600 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 cursor-pointer">
                                            <span class="text-sm font-medium text-slate-700">Tidak Lengkap</span>
                                        </label>
                                        <label class="radio-option flex items-center gap-3 cursor-pointer rounded-lg border-2 border-slate-200 bg-white px-4 py-3 transition-all hover:border-emerald-300 hover:shadow-md">
                                            <input type="radio" name="kondisi_apd" value="Tidak Ada" required class="h-5 w-5 text-emerald-600 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 cursor-pointer">
                                            <span class="text-sm font-medium text-slate-700">Tidak Ada</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="temuan" class="form-label block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                        Temuan / Catatan
                                    </label>
                                    <textarea
                                        id="temuan"
                                        name="temuan"
                                        rows="4"
                                        class="form-input w-full rounded-none border-2 border-slate-300 bg-white px-4 py-3.5 text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 focus:outline-none resize-none"
                                        placeholder="Masukkan temuan atau catatan terkait keselamatan dan kesehatan kerja..."
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-card rounded-2xl border-2 border-slate-200 bg-gradient-to-br from-white to-emerald-50/30 p-8 shadow-lg">
                            <h2 class="text-sm font-semibold uppercase tracking-[0.35em] text-emerald-600/80 mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                </svg>
                                Tindak Lanjut
                            </h2>
                            
                            <div class="space-y-6">
                                <div class="form-group">
                                    <label for="tindak_lanjut" class="form-label block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                        </svg>
                                        Tindak Lanjut yang Diambil
                                    </label>
                                    <textarea
                                        id="tindak_lanjut"
                                        name="tindak_lanjut"
                                        rows="3"
                                        class="form-input w-full rounded-none border-2 border-slate-300 bg-white px-4 py-3.5 text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 focus:outline-none resize-none"
                                        placeholder="Jelaskan tindak lanjut yang telah atau akan dilakukan..."
                                    ></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="penanggung_jawab" class="form-label block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                        </svg>
                                        Penanggung Jawab
                                    </label>
                                    <input
                                        type="text"
                                        id="penanggung_jawab"
                                        name="penanggung_jawab"
                                        class="form-input w-full rounded-none border-2 border-slate-300 bg-white px-4 py-3.5 text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 focus:outline-none"
                                        placeholder="Masukkan nama penanggung jawab"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a
                                href="{{ route('pos1.dashboard') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-none border-2 border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-slate-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-300 focus-visible:ring-offset-2"
                            >
                                Batal
                            </a>
<<<<<<< HEAD
                            <button
                                type="submit"
                                class="submit-btn inline-flex items-center justify-center gap-2 rounded-none bg-emerald-600 px-8 py-4 text-sm font-semibold text-white shadow-lg transition hover:bg-emerald-700 focus:outline-none focus-visible:ring-4 focus-visible:ring-emerald-300 focus-visible:ring-offset-2"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Simpan HSE
                            </button>
=======
<<<<<<< HEAD
                            <div class="print-format-dropdown">
                                <button
                                    type="button"
                                    id="printFormatBtn"
                                    class="print-format-btn inline-flex items-center justify-center gap-2 rounded-none px-8 py-4 text-sm font-semibold shadow-lg focus:outline-none focus-visible:ring-4 focus-visible:ring-emerald-300 focus-visible:ring-offset-2"
                                    onclick="togglePrintMenu()"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z" />
                                        <path d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                                    </svg>
                                    Cetak HSE
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div id="printFormatMenu" class="print-format-menu">
                                    <button type="button" class="print-format-item" onclick="printHSE('pdf')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z" clip-rule="evenodd" />
                                        </svg>
                                        Cetak sebagai PDF
                                    </button>
                                    <button type="button" class="print-format-item" onclick="printHSE('png')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M1 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                        </svg>
                                        Cetak sebagai PNG
                                    </button>
                                    <button type="button" class="print-format-item" onclick="printHSE('jpg')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M1 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                        </svg>
                                        Cetak sebagai JPG
                                    </button>
                                    <button type="button" class="print-format-item" onclick="printHSE('jpeg')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M1 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                        </svg>
                                        Cetak sebagai JPEG
                                    </button>
                                </div>
                            </div>
=======
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-none bg-emerald-600 px-8 py-4 text-sm font-semibold text-white shadow-lg transition hover:bg-emerald-700 focus:outline-none focus-visible:ring-4 focus-visible:ring-emerald-300 focus-visible:ring-offset-2"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>
                                Simpan HSE
                            </button>
>>>>>>> ac793ad587424a72d39511f66681165145844912
>>>>>>> main
                        </div>
                    </form>
                </div>
            </section>
        </main>
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


        // Fungsi untuk mengecek apakah library sudah ter-load
        function checkLibraries() {
            if (typeof html2pdf === 'undefined') {
                throw new Error('html2pdf library belum ter-load. Silakan refresh halaman.');
            }
            if (typeof html2canvas === 'undefined') {
                throw new Error('html2canvas library belum ter-load. Silakan refresh halaman.');
            }
        }

        // Fungsi untuk mengkonversi oklch ke rgb
        function oklchToRgb(oklchString) {
            // Fallback ke warna default jika tidak bisa dikonversi
            return 'rgb(30, 41, 59)';
        }

        // Fungsi untuk override semua style dengan inline style yang kompatibel
        function overrideStyles(element) {
            const allElements = element.querySelectorAll('*');
            allElements.forEach(el => {
                try {
                    const computedStyle = window.getComputedStyle(el);
                    
                    // Konversi semua properti warna ke RGB
                    const colorProps = ['color', 'backgroundColor', 'borderColor', 'borderTopColor', 
                                      'borderRightColor', 'borderBottomColor', 'borderLeftColor',
                                      'outlineColor', 'textDecorationColor'];
                    
                    colorProps.forEach(prop => {
                        try {
                            const value = computedStyle[prop] || computedStyle.getPropertyValue(prop);
                            if (value && (value.includes('oklch') || value.includes('oklab'))) {
                                // Ambil nilai RGB dari computed style
                                const rgbValue = window.getComputedStyle(el)[prop];
                                if (rgbValue && !rgbValue.includes('oklch') && !rgbValue.includes('oklab')) {
                                    el.style.setProperty(prop, rgbValue, 'important');
                                } else {
                                    // Fallback berdasarkan prop
                                    if (prop === 'color') {
                                        el.style.setProperty('color', 'rgb(30, 41, 59)', 'important');
                                    } else if (prop === 'backgroundColor') {
                                        el.style.setProperty('background-color', 'transparent', 'important');
                                    } else if (prop.includes('border')) {
                                        el.style.setProperty(prop, 'rgb(226, 232, 240)', 'important');
                                    }
                                }
                            } else if (value && value !== 'transparent' && value !== 'rgba(0, 0, 0, 0)') {
                                // Set nilai yang valid
                                el.style.setProperty(prop, value, 'important');
                            }
                        } catch (e) {
                            // Ignore errors
                        }
                    });
                } catch (e) {
                    // Ignore errors
                }
            });
        }

        // Fungsi untuk mengkonversi form input menjadi text yang bisa dicetak
        function convertFormToPrintable(element) {
            // Clone element
            const clone = element.cloneNode(true);
            
            // Konversi input text, date, time
            clone.querySelectorAll('input[type="text"], input[type="date"], input[type="time"]').forEach(input => {
                const value = input.value || '';
                const wrapper = document.createElement('div');
                wrapper.className = 'form-value-display';
                wrapper.style.cssText = 'padding: 0.75rem 1rem; background-color: rgb(248, 250, 252); border: 1px solid rgb(226, 232, 240); border-radius: 0.25rem; margin-top: 0.5rem; font-size: 0.875rem; color: rgb(30, 41, 59);';
                wrapper.textContent = value || '-';
                if (input.parentNode) {
                    input.parentNode.replaceChild(wrapper, input);
                }
            });

            // Konversi select
            clone.querySelectorAll('select').forEach(select => {
                const selectedOption = select.options[select.selectedIndex];
                const value = selectedOption ? selectedOption.text : '';
                const wrapper = document.createElement('div');
                wrapper.className = 'form-value-display';
                wrapper.style.cssText = 'padding: 0.75rem 1rem; background-color: rgb(248, 250, 252); border: 1px solid rgb(226, 232, 240); border-radius: 0.25rem; margin-top: 0.5rem; font-size: 0.875rem; color: rgb(30, 41, 59);';
                wrapper.textContent = value || '-';
                if (select.parentNode) {
                    select.parentNode.replaceChild(wrapper, select);
                }
            });

            // Konversi textarea
            clone.querySelectorAll('textarea').forEach(textarea => {
                const value = textarea.value || '';
                const wrapper = document.createElement('div');
                wrapper.className = 'form-value-display';
                wrapper.style.cssText = 'padding: 0.75rem 1rem; background-color: rgb(248, 250, 252); border: 1px solid rgb(226, 232, 240); border-radius: 0.25rem; margin-top: 0.5rem; font-size: 0.875rem; color: rgb(30, 41, 59); white-space: pre-wrap; min-height: 3rem;';
                wrapper.textContent = value || '-';
                if (textarea.parentNode) {
                    textarea.parentNode.replaceChild(wrapper, textarea);
                }
            });

            // Konversi radio button - ambil semua radio dalam grup
            const radioGroups = {};
            clone.querySelectorAll('input[type="radio"]').forEach(radio => {
                const name = radio.name;
                if (!radioGroups[name]) {
                    radioGroups[name] = [];
                }
                radioGroups[name].push(radio);
            });

            // Proses setiap grup radio
            Object.keys(radioGroups).forEach(name => {
                const radios = radioGroups[name];
                const checkedRadio = radios.find(r => r.checked);
                
                if (checkedRadio) {
                    // Temukan label untuk radio yang terpilih
                    let labelText = checkedRadio.value;
                    const label = clone.querySelector(`label[for="${checkedRadio.id}"]`) || checkedRadio.closest('label');
                    if (label) {
                        // Ambil text dari label, hapus text dari radio button
                        const labelClone = label.cloneNode(true);
                        labelClone.querySelector('input').remove();
                        labelText = labelClone.textContent.trim() || checkedRadio.value;
                    }
                    
                    // Buat wrapper untuk nilai yang dipilih
                    const wrapper = document.createElement('div');
                    wrapper.style.cssText = 'padding: 0.75rem 1rem; background-color: rgb(236, 253, 245); border: 2px solid rgb(5, 150, 105); border-radius: 0.5rem; margin-top: 0.5rem; font-size: 0.875rem; color: rgb(5, 150, 105); font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;';
                    wrapper.innerHTML = '✓ ' + labelText;
                    
                    // Ganti semua radio dalam grup dengan wrapper
                    radios.forEach(radio => {
                        const parent = radio.closest('label') || radio.parentNode;
                        if (parent) {
                            if (radio === checkedRadio) {
                                // Ganti radio yang terpilih dengan wrapper
                                parent.parentNode.insertBefore(wrapper, parent);
                                parent.remove();
                            } else {
                                // Hapus radio yang tidak terpilih
                                parent.remove();
                            }
                        }
                    });
                } else {
                    // Jika tidak ada yang terpilih, hapus semua
                    radios.forEach(radio => {
                        const parent = radio.closest('label') || radio.parentNode;
                        if (parent) parent.remove();
                    });
                }
            });

            // Hapus semua button
            clone.querySelectorAll('button').forEach(btn => btn.remove());

            return clone;
        }

        // Fungsi untuk mencetak HSE form
        async function printHSE(format) {
            try {
                // Cek library terlebih dahulu
                checkLibraries();
            } catch (error) {
                showNotification(error.message, 'error');
                document.getElementById('printFormatMenu').classList.remove('show');
                return;
            }

            // Validasi form terlebih dahulu
            const form = document.getElementById('hseForm');
            if (!form || !form.checkValidity()) {
                if (form) form.reportValidity();
                document.getElementById('printFormatMenu').classList.remove('show');
                return;
            }

            // Tutup menu dropdown
            document.getElementById('printFormatMenu').classList.remove('show');

            // Tampilkan loading
            showNotification('Sedang memproses...', 'success');

            try {
                // Ambil elemen yang akan dicetak
                const formCards = document.querySelectorAll('.form-card');
                const header = document.querySelector('header');
                
                if (formCards.length === 0) {
                    throw new Error('Form tidak ditemukan');
                }

                // Buat container untuk print dengan style yang kompatibel
                const printContainer = document.createElement('div');
                printContainer.id = 'hse-print-container';
                printContainer.style.cssText = `
                    position: absolute;
                    left: -9999px;
                    top: 0;
                    width: 210mm;
                    min-height: 297mm;
                    background-color: rgb(255, 255, 255);
                    padding: 2rem;
                    font-family: 'Inter', Arial, sans-serif;
                    color: rgb(30, 41, 59);
                    box-sizing: border-box;
                `;
                
                // Tambahkan style sheet khusus untuk print dengan warna RGB murni
                const styleSheet = document.createElement('style');
                styleSheet.setAttribute('data-hse-print', 'true');
                styleSheet.textContent = `
                    #hse-print-container {
                        all: initial;
                        display: block;
                        position: absolute;
                        left: -9999px;
                        top: 0;
                        width: 210mm;
                        min-height: 297mm;
                        background-color: rgb(255, 255, 255) !important;
                        padding: 2rem;
                        font-family: 'Inter', Arial, sans-serif !important;
                        color: rgb(30, 41, 59) !important;
                        box-sizing: border-box;
                    }
                    #hse-print-container * {
                        box-sizing: border-box;
                        color: rgb(30, 41, 59) !important;
                        font-family: 'Inter', Arial, sans-serif !important;
                    }
                    #hse-print-container .form-card {
                        background-color: rgb(255, 255, 255) !important;
                        border: 2px solid rgb(226, 232, 240) !important;
                        border-radius: 1rem;
                        padding: 2rem;
                        margin-bottom: 2rem;
                    }
                    #hse-print-container .form-value-display {
                        background-color: rgb(248, 250, 252) !important;
                        border: 1px solid rgb(226, 232, 240) !important;
                        padding: 0.75rem 1rem;
                        border-radius: 0.25rem;
                        margin-top: 0.5rem;
                        font-size: 0.875rem;
                        color: rgb(30, 41, 59) !important;
                    }
                    #hse-print-container h1, #hse-print-container h2, #hse-print-container h3 {
                        color: rgb(30, 41, 59) !important;
                    }
                    #hse-print-container p, #hse-print-container span, #hse-print-container div {
                        color: rgb(30, 41, 59) !important;
                    }
                `;
                document.head.appendChild(styleSheet);
                
                // Tambahkan header jika ada
                if (header) {
                    const headerClone = header.cloneNode(true);
                    headerClone.setAttribute('data-print-id', 'header');
                    headerClone.querySelectorAll('button, .no-print').forEach(el => el.remove());
                    // Override semua style dengan inline style
                    overrideStyles(headerClone);
                    printContainer.appendChild(headerClone);
                }

                // Tambahkan semua form cards dengan konversi form
                formCards.forEach((card, index) => {
                    const cardClone = convertFormToPrintable(card);
                    // Set unique ID untuk tracking
                    cardClone.setAttribute('data-print-id', `card-${index}`);
                    cardClone.style.cssText = 'margin-bottom: 2rem; page-break-inside: avoid; break-inside: avoid; background-color: rgb(255, 255, 255); border: 2px solid rgb(226, 232, 240); border-radius: 1rem; padding: 2rem;';
                    // Override semua style dengan inline style
                    overrideStyles(cardClone);
                    printContainer.appendChild(cardClone);
                });

                // Tambahkan ke body (di luar viewport)
                document.body.appendChild(printContainer);

                // Tunggu sebentar untuk memastikan elemen ter-render
                await new Promise(resolve => setTimeout(resolve, 1000));

                if (format === 'pdf') {
                    // Generate PDF menggunakan html2pdf.js
                    const opt = {
                        margin: [10, 10, 10, 10],
                        filename: `HSE_Form_${new Date().toISOString().split('T')[0]}.pdf`,
                        image: { 
                            type: 'jpeg', 
                            quality: 0.98 
                        },
                        html2canvas: { 
                            scale: 2,
                            useCORS: false,
                            allowTaint: false,
                            logging: false,
                            letterRendering: true,
                            backgroundColor: '#ffffff',
                            width: printContainer.scrollWidth,
                            height: printContainer.scrollHeight,
                            ignoreElements: function(element) {
                                return element.classList && element.classList.contains('no-print');
                            },
                            onclone: function(clonedDoc) {
                                try {
                                    // Hapus SEMUA stylesheet dan style tag kecuali yang kita buat untuk print
                                    const allStyles = clonedDoc.querySelectorAll('style, link[rel="stylesheet"]');
                                    allStyles.forEach(sheet => {
                                        // Simpan hanya style sheet print kita
                                        if (sheet.getAttribute && sheet.getAttribute('data-hse-print') === 'true') {
                                            return; // Jangan hapus style sheet print kita
                                        }
                                        // Hapus semua yang lain
                                        sheet.remove();
                                    });
                                    
                                    const clonedContainer = clonedDoc.getElementById('hse-print-container');
                                    if (clonedContainer) {
                                        // Set inline style untuk semua elemen dengan warna RGB yang aman
                                        const allElements = clonedContainer.querySelectorAll('*');
                                        allElements.forEach(el => {
                                            try {
                                                // Set semua properti warna dengan nilai RGB yang aman
                                                const colorProps = ['color', 'background-color', 'border-color', 
                                                                   'border-top-color', 'border-right-color', 
                                                                   'border-bottom-color', 'border-left-color'];
                                                
                                                colorProps.forEach(prop => {
                                                    try {
                                                        // Ambil nilai dari inline style yang sudah kita set sebelumnya
                                                        const currentValue = el.style.getPropertyValue(prop);
                                                        if (!currentValue || currentValue.includes('oklch') || currentValue.includes('oklab')) {
                                                            // Set default berdasarkan prop dan class
                                                            if (prop === 'color') {
                                                                el.style.setProperty('color', 'rgb(30, 41, 59)', 'important');
                                                            } else if (prop === 'background-color') {
                                                                if (el.classList && el.classList.contains('form-card')) {
                                                                    el.style.setProperty('background-color', 'rgb(255, 255, 255)', 'important');
                                                                } else if (el.classList && el.classList.contains('form-value-display')) {
                                                                    el.style.setProperty('background-color', 'rgb(248, 250, 252)', 'important');
                                                                } else {
                                                                    el.style.setProperty('background-color', 'transparent', 'important');
                                                                }
                                                            } else if (prop.includes('border')) {
                                                                el.style.setProperty(prop, 'rgb(226, 232, 240)', 'important');
                                                            }
                                                        }
                                                    } catch (e) {
                                                        // Ignore errors
                                                    }
                                                });
                                                
                                                // Set font family
                                                el.style.setProperty('font-family', "'Inter', Arial, sans-serif", 'important');
                                                
                                                // Set border jika form-card
                                                if (el.classList && el.classList.contains('form-card')) {
                                                    el.style.setProperty('border', '2px solid rgb(226, 232, 240)', 'important');
                                                }
                                            } catch (e) {
                                                // Ignore errors
                                            }
                                        });
                                    }
                                } catch (e) {
                                    console.error('Error in onclone:', e);
                                }
                            }
                        },
                        jsPDF: { 
                            unit: 'mm', 
                            format: 'a4', 
                            orientation: 'portrait',
                            compress: true
                        },
                        pagebreak: { 
                            mode: ['avoid-all', 'css', 'legacy'] 
                        }
                    };

                    await html2pdf().set(opt).from(printContainer).save();
                } else {
                    // Generate gambar (PNG, JPG, JPEG) menggunakan html2canvas
                    const canvas = await html2canvas(printContainer, {
                        scale: 2,
                        useCORS: false,
                        allowTaint: false,
                        logging: false,
                        backgroundColor: '#ffffff',
                        letterRendering: true,
                        width: printContainer.scrollWidth,
                        height: printContainer.scrollHeight,
                        ignoreElements: function(element) {
                            return element.classList && element.classList.contains('no-print');
                        },
                        onclone: function(clonedDoc) {
                            try {
                                // Hapus SEMUA stylesheet dan style tag kecuali yang kita buat untuk print
                                const allStyles = clonedDoc.querySelectorAll('style, link[rel="stylesheet"]');
                                allStyles.forEach(sheet => {
                                    // Simpan hanya style sheet print kita
                                    if (sheet.getAttribute && sheet.getAttribute('data-hse-print') === 'true') {
                                        return; // Jangan hapus style sheet print kita
                                    }
                                    // Hapus semua yang lain
                                    sheet.remove();
                                });
                                
                                const clonedContainer = clonedDoc.getElementById('hse-print-container');
                                if (clonedContainer) {
                                    // Set inline style untuk semua elemen dengan warna RGB yang aman
                                    const allElements = clonedContainer.querySelectorAll('*');
                                    allElements.forEach(el => {
                                        try {
                                            // Set semua properti warna dengan nilai RGB yang aman
                                            const colorProps = ['color', 'background-color', 'border-color', 
                                                               'border-top-color', 'border-right-color', 
                                                               'border-bottom-color', 'border-left-color'];
                                            
                                            colorProps.forEach(prop => {
                                                try {
                                                    // Ambil nilai dari inline style yang sudah kita set sebelumnya
                                                    const currentValue = el.style.getPropertyValue(prop);
                                                    if (!currentValue || currentValue.includes('oklch') || currentValue.includes('oklab')) {
                                                        // Set default berdasarkan prop dan class
                                                        if (prop === 'color') {
                                                            el.style.setProperty('color', 'rgb(30, 41, 59)', 'important');
                                                        } else if (prop === 'background-color') {
                                                            if (el.classList && el.classList.contains('form-card')) {
                                                                el.style.setProperty('background-color', 'rgb(255, 255, 255)', 'important');
                                                            } else if (el.classList && el.classList.contains('form-value-display')) {
                                                                el.style.setProperty('background-color', 'rgb(248, 250, 252)', 'important');
                                                            } else {
                                                                el.style.setProperty('background-color', 'transparent', 'important');
                                                            }
                                                        } else if (prop.includes('border')) {
                                                            el.style.setProperty(prop, 'rgb(226, 232, 240)', 'important');
                                                        }
                                                    }
                                                } catch (e) {
                                                    // Ignore errors
                                                }
                                            });
                                            
                                            // Set font family
                                            el.style.setProperty('font-family', "'Inter', Arial, sans-serif", 'important');
                                        } catch (e) {
                                            // Ignore errors
                                        }
                                    });
                                }
                            } catch (e) {
                                console.error('Error in onclone:', e);
                            }
                        }
                    });

                    // Konversi canvas ke blob dengan promise
                    await new Promise((resolve, reject) => {
                        const mimeType = format === 'png' ? 'image/png' : 'image/jpeg';
                        canvas.toBlob(function(blob) {
                            if (!blob) {
                                reject(new Error('Gagal membuat file gambar'));
                                return;
                            }
                            try {
                                const url = URL.createObjectURL(blob);
                                const link = document.createElement('a');
                                link.href = url;
                                
                                // Tentukan format file
                                let fileExtension = format === 'jpeg' ? 'jpg' : format;
                                
                                link.download = `HSE_Form_${new Date().toISOString().split('T')[0]}.${fileExtension}`;
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                                
                                // Cleanup
                                setTimeout(() => URL.revokeObjectURL(url), 100);
                                resolve();
                            } catch (err) {
                                reject(err);
                            }
                        }, mimeType, 0.95);
                    });
                }

                // Tampilkan notifikasi sukses
                showNotification('Form HSE berhasil dicetak sebagai ' + format.toUpperCase() + '!', 'success');
            } catch (error) {
                console.error('Error saat mencetak:', error);
                showNotification('Terjadi kesalahan: ' + (error.message || 'Silakan coba lagi.'), 'error');
            } finally {
                // Hapus container sementara
                const container = document.getElementById('hse-print-container');
                if (container) {
                    document.body.removeChild(container);
                }
                // Hapus style sheet yang ditambahkan
                const addedStyle = document.querySelector('style[data-hse-print]');
                if (addedStyle) {
                    addedStyle.remove();
                }
                // Restore stylesheet yang dihapus (jika diperlukan)
                // Note: Biasanya tidak perlu restore karena browser akan reload stylesheet
            }
        }

        // Fungsi untuk menampilkan notifikasi
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 1rem 1.5rem;
                background-color: ${type === 'success' ? '#059669' : '#dc2626'};
                color: white;
                border-radius: 0.5rem;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
                z-index: 10000;
                font-weight: 500;
                animation: slideIn 0.3s ease-out;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Tambahkan animasi CSS untuk notifikasi
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>



