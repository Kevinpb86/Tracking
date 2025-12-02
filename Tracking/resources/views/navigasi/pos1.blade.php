<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS 1 Dashboard - Checkpoint Kedatangan</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900">
    @php
        $now = now();
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
                <a
                    href="{{ route('dashboard.main') }}"
                    class="relative flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition hover:border-blue-200 hover:shadow-md"
                    aria-label="Kembali ke halaman utama"
                >
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
                </a>

                <div class="relative space-y-3">
                    <div class="flex items-center justify-between">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-500">Navigasi Pos</p>
                        <span class="rounded-full bg-blue-50 px-3 py-0.5 text-[10px] font-semibold uppercase tracking-[0.3em] text-blue-500">Live</span>
                    </div>
                    <nav class="flex flex-col gap-3 text-sm font-semibold text-slate-600">
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
                                class="group flex w-full items-center justify-between rounded-xl border border-emerald-100 bg-white px-5 py-4 transition duration-200 hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700"
                            >
                                <span class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 transition duration-200 group-hover:bg-emerald-500 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 6a2 2 0 0 1 2-2h5l2 2h5a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Z" />
                                        </svg>
                                    </span>
                                    <span class="flex flex-col gap-0.5">
                                        <span class="text-[11px] uppercase tracking-[0.3em] text-emerald-400">HSE</span>
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
                                    class="group flex items-center justify-between rounded-xl border border-emerald-100 bg-white px-4 py-3 transition duration-200 hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700"
                                >
                                    <span class="flex items-center gap-3">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 transition duration-200 group-hover:bg-emerald-500 group-hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h9.5A2.25 2.25 0 0 1 17 4.25v11.5A2.25 2.25 0 0 1 14.75 18h-9.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <span class="text-sm">Input HSE</span>
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-400 transition duration-200 group-hover:text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.22 14.78a.75.75 0 0 1 0-1.06L10.94 10 7.22 6.28a.75.75 0 1 1 1.06-1.06l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0Z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a
                                    href="#"
                                    class="group flex items-center justify-between rounded-xl border border-emerald-100 bg-white px-4 py-3 transition duration-200 hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700"
                                >
                                    <span class="flex items-center gap-3">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 transition duration-200 group-hover:bg-emerald-500 group-hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h9.5A2.25 2.25 0 0 1 17 4.25v11.5A2.25 2.25 0 0 1 14.75 18h-9.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <span class="text-sm">CETAK HSE FORM</span>
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
                        <a
                            href="{{ route('dashboard.main') }}"
                            class="flex min-w-[220px] flex-1 items-center gap-5 text-blue-900 transition hover:opacity-80"
                            aria-label="Kembali ke halaman utama"
                        >
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
                        </a>
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
                <div class="mx-auto rounded-2xl border border-slate-200 bg-white p-10 shadow-sm">
                    <div class="flex flex-col items-stretch gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm font-semibold uppercase tracking-[0.35em] text-slate-500">Navigasi</div>
                        <div class="flex flex-wrap gap-3">
                            <a
                                href="{{ url()->previous() }}"
                                class="inline-flex items-center gap-2 rounded-lg border border-slate-200 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-slate-600 transition hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-300 focus-visible:ring-offset-2"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />
                                </svg>
                                Kembali
                            </a>
                            <a
                                href="{{ route('dashboard.main') }}"
                                class="inline-flex items-center gap-2 rounded-lg border border-blue-200 bg-blue-50 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-blue-600 transition hover:bg-blue-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                                Halaman Utama
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-2xl space-y-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.45em] text-blue-600/80">
                                POS 1 Dashboard
                            </p>
                            <h1 class="text-4xl font-semibold text-slate-900 sm:text-5xl">
                                Checkpoint Kedatangan
                            </h1>
                            <p class="text-sm text-slate-600">
                                Kelola dan pantau proses validasi dokumen serta kelengkapan kendaraan yang memasuki area plant. Sistem ini memastikan setiap kendaraan telah memenuhi persyaratan sebelum melanjutkan ke tahap berikutnya.
                            </p>
                        </div>
                        <div class="flex-1 space-y-5 rounded-xl border border-slate-200 bg-slate-50 p-6 text-sm text-slate-600 lg:ml-8 lg:max-w-md">
                            <div class="flex items-center justify-between">
                                <span class="uppercase tracking-[0.35em] text-xs text-slate-500">Tanggal</span>
                                <span id="currentDate" class="text-base font-semibold text-slate-900">{{ $now->format('d F Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="uppercase tracking-[0.35em] text-xs text-slate-500">Waktu</span>
                                <span id="currentTime" class="text-base font-semibold text-slate-900">{{ $now->format('H:i') }} WIB</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="uppercase tracking-[0.35em] text-xs text-slate-500">Pengguna</span>
                                <span class="text-base font-semibold text-slate-900">{{ Auth::user()->name ?? 'Guest User' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <section class="relative mx-auto w-full flex-1 px-8 py-16 sm:px-12 lg:px-24">
                <div class="grid gap-8 lg:grid-cols-12">
                    <div class="lg:col-span-4 space-y-8">
                        <article class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                            <h2 class="text-sm font-semibold uppercase tracking-[0.35em] text-blue-600/80">Informasi Pos 1</h2>
                            <p class="mt-2 text-2xl font-semibold text-slate-900">Pusat Pemeriksaan</p>
                            <p class="mt-4 text-sm text-slate-600">
                                Pos 1 merupakan titik pemeriksaan pertama yang bertanggung jawab untuk memvalidasi dokumen dan kelengkapan kendaraan sebelum memasuki area utama plant.
                            </p>
                            <div class="mt-6 space-y-4">
                                <div class="rounded-2xl border border-blue-200 bg-blue-50 p-4 text-sm text-blue-700">
                                    <p class="text-xs uppercase tracking-[0.3em] text-blue-500">FUNGSI UTAMA</p>
                                    <p class="mt-2 font-semibold text-blue-800">Validasi Dokumen</p>
                                    <p class="mt-1 text-xs text-blue-600">
                                        Memastikan semua dokumen kendaraan lengkap dan valid sebelum masuk area plant.
                                    </p>
                                </div>
                                <div class="rounded-2xl border border-blue-200 bg-blue-50 p-4 text-sm text-blue-700">
                                    <p class="text-xs uppercase tracking-[0.3em] text-blue-500">PROSES</p>
                                    <p class="mt-2 font-semibold text-blue-800">Pemeriksaan Kelengkapan</p>
                                    <p class="mt-1 text-xs text-blue-600">
                                        Verifikasi kelengkapan kendaraan sesuai dengan standar operasional yang berlaku.
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="lg:col-span-8 space-y-8">
                        <article class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <h2 class="text-sm font-semibold uppercase tracking-[0.35em] text-blue-600/80">
                                        Status Real-Time
                                    </h2>
                                    <p class="mt-2 text-2xl font-semibold text-slate-900">Aktivitas Pos 1</p>
                                </div>
                                <button
                                    type="button"
                                    onclick="window.location.reload()"
                                    class="inline-flex items-center gap-2 rounded-lg border border-blue-200 bg-blue-50 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-blue-600 transition hover:bg-blue-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5a7 7 0 0 1 12-4.07M19.5 13.5a7 7 0 0 1-12 4.07M4.5 10.5h4M6.5 7.5l-2 3M19.5 13.5h-4M17.5 16.5l2-3" />
                                    </svg>
                                    Refresh
                                </button>
                            </div>

                            <div class="mt-8 grid gap-6 sm:grid-cols-2">
                                <div class="rounded-xl border border-slate-200 bg-slate-50 p-6 text-sm text-slate-600">
                                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Kendaraan Masuk</p>
                                    <p class="mt-2 text-3xl font-semibold text-slate-900">0</p>
                                    <p class="mt-3 text-xs text-slate-600">
                                        Jumlah kendaraan yang telah melewati checkpoint ini hari ini.
                                    </p>
                                </div>
                                <div class="rounded-xl border border-slate-200 bg-slate-50 p-6 text-sm text-slate-600">
                                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Status Validasi</p>
                                    <p class="mt-2 text-3xl font-semibold text-slate-900">Aktif</p>
                                    <p class="mt-3 text-xs text-slate-600">
                                        Sistem validasi berjalan normal dan siap menerima kendaraan baru.
                                    </p>
                                </div>
                                <div class="rounded-xl border border-slate-200 bg-slate-50 p-6 text-sm text-slate-600">
                                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Dokumen Lengkap</p>
                                    <p class="mt-2 text-3xl font-semibold text-slate-900">100%</p>
                                    <p class="mt-3 text-xs text-slate-600">
                                        Persentase kendaraan dengan dokumen lengkap dan valid.
                                    </p>
                                </div>
                                <div class="rounded-xl border border-slate-200 bg-slate-50 p-6 text-sm text-slate-600">
                                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Waktu Rata-rata</p>
                                    <p class="mt-2 text-3xl font-semibold text-slate-900">5 Menit</p>
                                    <p class="mt-3 text-xs text-slate-600">
                                        Waktu rata-rata proses validasi per kendaraan.
                                    </p>
                                </div>
                            </div>
                        </article>

                        <article class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h2 class="text-sm font-semibold uppercase tracking-[0.35em] text-blue-600/80">
                                        Insight
                                    </h2>
                                    <p class="mt-2 text-2xl font-semibold text-slate-900">Catatan Operasional</p>
                                    <p class="mt-2 text-sm text-slate-600">
                                        Informasi penting untuk menjaga efisiensi proses validasi di Pos 1.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                                <div class="rounded-xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-700">
                                    <p class="text-xs uppercase tracking-[0.3em] text-amber-500">Prioritas</p>
                                    <p class="mt-2 font-semibold text-amber-800">Pastikan dokumen lengkap sebelum proses validasi dimulai.</p>
                                </div>
                                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-5 text-sm text-emerald-700">
                                    <p class="text-xs uppercase tracking-[0.3em] text-emerald-500">Keselamatan</p>
                                    <p class="mt-2 font-semibold text-emerald-800">Verifikasi kelengkapan keselamatan kendaraan sesuai standar.</p>
                                </div>
                            </div>
                        </article>
                    </div>
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

            // Real-time clock for WIB timezone
            function updateWIBTime() {
                const now = new Date();
                // WIB is UTC+7
                const wibOffset = 7 * 60; // 7 hours in minutes
                const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
                const wibTime = new Date(utc + (wibOffset * 60000));
                
                // Format time
                const hours = String(wibTime.getHours()).padStart(2, '0');
                const minutes = String(wibTime.getMinutes()).padStart(2, '0');
                const timeString = `${hours}:${minutes} WIB`;
                
                // Format date
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                const dayName = days[wibTime.getDay()];
                const day = String(wibTime.getDate()).padStart(2, '0');
                const month = months[wibTime.getMonth()];
                const year = wibTime.getFullYear();
                const dateString = `${day} ${month} ${year}`;
                
                // Update DOM
                const timeElement = document.getElementById('currentTime');
                const dateElement = document.getElementById('currentDate');
                if (timeElement) {
                    timeElement.textContent = timeString;
                }
                if (dateElement) {
                    dateElement.textContent = dateString;
                }
            }

            // Update immediately
            updateWIBTime();
            
            // Update every second
            setInterval(updateWIBTime, 1000);
        });

        // Toggle HSE menu (global function)
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
    </script>
</body>
</html>

