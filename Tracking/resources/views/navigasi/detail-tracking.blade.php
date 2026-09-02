<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Tracking - {{ $tracking->tracking_number }}</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900">
    <div class="relative min-h-screen overflow-x-hidden">
        {{-- Same Sidebar as other pages --}}
        <button id="sidebarToggle" type="button"
            class="fixed left-4 top-9 z-50 inline-flex h-12 w-12 items-center justify-center rounded-lg border border-slate-200 bg-white text-blue-600 shadow-sm transition hover:bg-blue-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 cursor-pointer"
            aria-label="Toggle navigation">
            <span class="relative flex h-4 w-6 flex-col justify-between">
                <span class="block h-0.5 w-full rounded-full bg-current"></span>
                <span class="block h-0.5 w-full rounded-full bg-current"></span>
                <span class="block h-0.5 w-full rounded-full bg-current"></span>
            </span>
        </button>

        {{-- Main Content --}}
        <main class="relative flex min-h-screen flex-col pt-32 sm:pt-36 lg:pt-40">
            {{-- Header with Back Button --}}
            <header class="px-8 pt-8 sm:px-12 lg:px-24">
                <div class="mx-auto max-w-7xl">
                    <div class="mb-8 items-center justify-between flex flex-wrap gap-4">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('tracking.index') }}"
                                class="group flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-slate-400 shadow-sm ring-1 ring-slate-200 transition-all hover:bg-blue-600 hover:text-white hover:ring-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                            </a>
                            <div class="space-y-1">
                                <h1 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">
                                    Detail Tracking <span class="text-blue-600">#{{ $tracking->tracking_number }}</span>
                                </h1>
                                <p class="text-sm font-medium text-slate-500">Informasi lengkap pergerakan unit
                                    kendaraan.</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span
                                class="inline-flex items-center rounded-full bg-{{ $tracking->getStatusColor() }}-50 px-4 py-2 text-xs font-black tracking-widest uppercase text-{{ $tracking->getStatusColor() }}-700 border border-{{ $tracking->getStatusColor() }}-200 shadow-sm">
                                <span
                                    class="mr-2 flex h-2 w-2 rounded-full bg-{{ $tracking->getStatusColor() }}-500 animate-pulse"></span>
                                Status: {{ $tracking->status ?? 'POS 1' }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {{-- Left Column: Info Cards --}}
                        <div class="lg:col-span-2 space-y-8">
                            {{-- Info Overview --}}
                            <div class="rounded-3xl bg-white p-8 shadow-xl shadow-slate-200/50 border border-slate-100">
                                <h3 class="mb-6 text-sm font-black uppercase tracking-[0.2em] text-blue-600">Overview
                                    Unit</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-6">
                                        <div class="flex items-start gap-4">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-50 text-slate-400 shadow-inner">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 2a1 1 0 00-1 1v1.123A7.977 7.977 0 004.5 7.5c0 .822.125 1.614.358 2.357a1 1 0 01-1.716.924C2.732 10.15 2.5 9.35 2.5 8.5a10 10 0 016.5-9.377V3a1 1 0 011 1v.123A8 8 0 0115.5 8.5c0 .85-.232 1.65-.642 2.281a1 1 0 11-1.684-1.076c.214-.336.326-.714.326-1.123a6 6 0 10-12 0c0 .409.112.787.326 1.123a1 1 0 11-1.684 1.076A7.977 7.977 0 014.5 7.5a10 10 0 0111-5.5V3a1 1 0 112 0v1a1 1 0 01-2 0H10z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="space-y-1">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                                                    Nomor Polisi</p>
                                                <p class="text-lg font-bold text-slate-900 font-mono">
                                                    {{ $tracking->nomor_polisi }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-4">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-50 text-slate-400 shadow-inner">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="space-y-1">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                                                    Nama Driver</p>
                                                <p class="text-lg font-bold text-slate-900">{{ $tracking->nama_driver }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-6">
                                        <div class="flex items-start gap-4">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-50 text-slate-400 shadow-inner">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3v-1H7v1H4a1 1 0 110-2V4zm2 2v10h8V6H6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="space-y-1">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                                                    Perusahaan</p>
                                                <p class="text-lg font-bold text-slate-900">
                                                    {{ $tracking->perusahaan ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-4">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-50 text-slate-400 shadow-inner">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                                </svg>
                                            </div>
                                            <div class="space-y-1">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                                                    Jenis Kendaraan</p>
                                                <p class="text-lg font-bold text-slate-900">
                                                    {{ $tracking->jenis_kendaraan ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="mt-8 pt-6 border-t border-slate-50 grid grid-cols-1 md:grid-cols-2 gap-8">
                                            <div class="flex items-start gap-4">
                                                <div
                                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-50 text-slate-400 shadow-inner">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </div>
                                                <div class="space-y-1">
                                                    <p
                                                        class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                                                        Lokasi</p>
                                                    <p class="text-lg font-bold text-slate-900">
                                                        {{ $tracking->lokasi ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Connection Data --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    {{-- HSE Connection --}}
                                    <div
                                        class="rounded-3xl bg-white p-6 shadow-lg shadow-slate-200/40 border border-slate-100">
                                        <div class="mb-4 flex items-center justify-between">
                                            <h4
                                                class="text-[10px] font-black uppercase tracking-widest text-emerald-600">
                                                HSE Inspection</h4>
                                            <span
                                                class="rounded-full bg-emerald-50 px-2.5 py-1 text-[9px] font-bold text-emerald-700">Link
                                                Verified</span>
                                        </div>
                                        @if($tracking->hse)
                                            <div class="space-y-3">
                                                <div class="flex items-center justify-between rounded-xl bg-slate-50 p-3">
                                                    <span class="text-[10px] font-bold text-slate-400">Safety Status</span>
                                                    <span class="text-xs font-black text-emerald-600">SAFE</span>
                                                </div>
                                                <a href="{{ route('hse.index') }}"
                                                    class="block w-full rounded-xl bg-emerald-600 py-3 text-center text-[10px] font-black uppercase tracking-widest text-white transition hover:bg-emerald-700">Lihat
                                                    Laporan HSE</a>
                                            </div>
                                        @else
                                            <div class="flex flex-col items-center justify-center py-6 text-center">
                                                <div
                                                    class="mb-2 h-10 w-10 overflow-hidden rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                    </svg>
                                                </div>
                                                <p class="text-[10px] font-bold text-slate-400">Data HSE Belum Masuk</p>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Vehicle Checklist Connection --}}
                                    <div
                                        class="rounded-3xl bg-white p-6 shadow-lg shadow-slate-200/40 border border-slate-100">
                                        <div class="mb-4 flex items-center justify-between">
                                            <h4 class="text-[10px] font-black uppercase tracking-widest text-blue-600">
                                                Vehicle Checklist</h4>
                                            <span
                                                class="rounded-full bg-blue-50 px-2.5 py-1 text-[9px] font-bold text-blue-700">Link
                                                Verified</span>
                                        </div>
                                        @if($tracking->cekKendaraan)
                                            <div class="space-y-3">
                                                <div class="flex items-center justify-between rounded-xl bg-slate-50 p-3">
                                                    <span class="text-[10px] font-bold text-slate-400">Condition</span>
                                                    <span class="text-xs font-black text-blue-600">PASSED</span>
                                                </div>
                                                <a href="{{ route('cek-kendaraan.daftar') }}"
                                                    class="block w-full rounded-xl bg-blue-600 py-3 text-center text-[10px] font-black uppercase tracking-widest text-white transition hover:bg-blue-700">Lihat
                                                    Detail Cek</a>
                                            </div>
                                        @else
                                            <div class="flex flex-col items-center justify-center py-6 text-center">
                                                <div
                                                    class="mb-2 h-10 w-10 overflow-hidden rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                </div>
                                                <p class="text-[10px] font-bold text-slate-400">Data Pemeriksaan Belum Ada
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Right Column: Timeline --}}
                            <div class="space-y-8">
                                <div
                                    class="rounded-3xl bg-white p-8 shadow-xl shadow-slate-200/50 border border-slate-100">
                                    <h3 class="mb-10 text-sm font-black uppercase tracking-[0.2em] text-slate-400">
                                        Tracking
                                        Timeline</h3>
                                    <div
                                        class="relative space-y-12 pl-12 before:absolute before:left-5 before:top-2 before:h-[calc(100%-8px)] before:w-0.5 before:bg-slate-100">
                                        {{-- Pos 1 --}}
                                        <div class="relative">
                                            <div
                                                class="absolute -left-12 flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-white shadow-lg shadow-blue-200 ring-4 ring-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="space-y-1">
                                                <h4 class="text-sm font-black tracking-tight text-slate-900">Checkpoint:
                                                    POS
                                                    1</h4>
                                                <p class="text-xs font-bold text-blue-600">
                                                    {{ date('d M Y', strtotime($tracking->tanggal)) }} |
                                                    {{ $tracking->waktu_masuk }} WIB
                                                </p>
                                                <p class="pt-2 text-[10px] leading-relaxed text-slate-500">Unit
                                                    terdaftar di
                                                    Gate 1. Pemeriksaan dokumen awal selesai.</p>
                                            </div>
                                        </div>

                                        {{-- Operational Area --}}
                                        <div class="relative">
                                            <div
                                                class="absolute -left-12 flex h-10 w-10 items-center justify-center rounded-full @if($tracking->status == 'DI AREA' || $tracking->status == 'SELESAI') bg-blue-600 text-white shadow-lg shadow-blue-200 @else bg-slate-100 text-slate-300 @endif ring-4 ring-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="space-y-1">
                                                <h4
                                                    class="text-sm font-black tracking-tight @if($tracking->status == 'DI AREA' || $tracking->status == 'SELESAI') text-slate-900 @else text-slate-300 @endif">
                                                    Area Operasional</h4>
                                                @if($tracking->tujuan)
                                                    <p class="text-xs font-bold text-slate-400">Tujuan: <span
                                                            class="text-slate-600">{{ $tracking->tujuan }}</span></p>
                                                @endif
                                                <p class="pt-2 text-[10px] leading-relaxed text-slate-400">Status muatan
                                                    dan
                                                    penempatan unit sedang diproses oleh tim area.</p>
                                            </div>
                                        </div>

                                        {{-- Pos 2 --}}
                                        <div class="relative">
                                            <div
                                                class="absolute -left-12 flex h-10 w-10 items-center justify-center rounded-full @if($tracking->status == 'SELESAI') bg-emerald-600 text-white shadow-lg shadow-emerald-200 @else bg-slate-100 text-slate-300 @endif ring-4 ring-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H11.229l.123.489.213.213a1 1 0 010 1.414l-1.442 1.442-1.442-1.442a1 1 0 010-1.414l.213-.213.123-.489z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="space-y-1">
                                                <h4
                                                    class="text-sm font-black tracking-tight @if($tracking->status == 'SELESAI') text-slate-900 @else text-slate-300 @endif">
                                                    Checkpoint: POS 2</h4>
                                                <p class="pt-2 text-[10px] leading-relaxed text-slate-400">Pemeriksaan
                                                    akhir
                                                    di Gate 2 sebelum unit keluar dari area perusahaan.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-3xl bg-slate-900 p-8 text-white shadow-2xl">
                                    <h4 class="mb-4 text-xs font-black uppercase tracking-widest text-blue-400">Catatan
                                        Internal</h4>
                                    <p class="text-xs leading-relaxed text-slate-400 italic">
                                        {{ $tracking->catatan_umum ?? 'Tidak ada catatan tambahan untuk unit kendaraan ini.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
            </header>
        </main>
    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Minimal JS for sidebar toggle if needed, or redirect back
    </script>
</body>

</html>