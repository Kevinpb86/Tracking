<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS 2 Dashboard - Zona Distribusi</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">

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
                    <div class="flex-1 space-y-0.5">
                        <span class="block text-[10px] font-bold uppercase tracking-[0.3em] text-slate-400">Tracking
                            System</span>
                        <span class="block text-sm font-bold leading-tight text-slate-900">PT. Wiraswasta Gemilang
                            Indonesia</span>
                    </div>
                </a>

                {{-- Navigation --}}
                <nav class="space-y-2">
                    <p class="px-2 text-[10px] font-bold uppercase tracking-[0.25em] text-slate-400">Menu Utama</p>

                    <a href="{{ route('dashboard.main') }}"
                        class="group flex items-center gap-3 rounded-xl px-4 py-3 text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-600 transition group-hover:bg-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium">Dashboard Utama</span>
                    </a>

                    <p class="px-2 pt-4 text-[10px] font-bold uppercase tracking-[0.25em] text-slate-400">Pos Checkpoint
                    </p>

                    <a href="{{ route('pos1.dashboard') }}"
                        class="group flex items-center gap-3 rounded-xl px-4 py-3 text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 transition group-hover:bg-blue-500 group-hover:text-white">
                            <span class="text-sm font-bold">1</span>
                        </div>
                        <div class="flex-1">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-blue-500">POS 1</div>
                            <div class="text-sm font-medium">Checkpoint Kedatangan</div>
                        </div>
                    </a>

                    <a href="{{ route('pos2.dashboard') }}"
                        class="group flex items-center gap-3 rounded-xl bg-emerald-50 px-4 py-3 text-emerald-700 shadow-sm ring-1 ring-emerald-100">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500 text-white shadow-sm">
                            <span class="text-sm font-bold">2</span>
                        </div>
                        <div class="flex-1">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-emerald-600">POS 2</div>
                            <div class="text-sm font-bold">Zona Distribusi</div>
                        </div>
                    </a>
                </nav>

                {{-- Logout Button --}}
                <button type="button" onclick="handleLogout()"
                    class="group mt-auto flex items-center gap-3 rounded-xl bg-rose-50 px-4 py-3 text-rose-700 transition hover:bg-rose-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="text-sm font-semibold">Sign Out</span>
                </button>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </aside>

        <div id="sidebarOverlay"
            class="fixed inset-0 z-40 bg-slate-900/10 opacity-0 transition-opacity duration-300 ease-in-out pointer-events-none">
        </div>

        <main class="relative flex min-h-screen flex-col pt-32 sm:pt-36 lg:pt-40">
            <section class="fixed inset-x-0 top-0 z-40">
                <div class="overflow-hidden border-b border-slate-200 bg-white text-slate-700 shadow-sm">
                    <div class="h-3 w-full bg-[#2736a3]"></div>
                    <div class="flex flex-wrap items-center gap-6 px-6 py-6 pl-20 sm:px-10 sm:pl-28">
                        <a href="{{ route('dashboard.main') }}"
                            class="flex min-w-[220px] flex-1 items-center gap-5 text-emerald-900 transition hover:opacity-80"
                            aria-label="Kembali ke halaman utama">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-full border border-emerald-900/20 bg-white p-2 shadow-lg shadow-emerald-900/20">
                                <img src="{{ asset('images/wgilogo.jpg') }}"
                                    alt="Logo PT. Wiraswasta Gemilang Indonesia" class="h-full w-full object-contain">
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
                        </a>
                        <div class="hidden h-14 w-0.5 bg-slate-900 sm:ml-5 sm:block lg:ml-10"></div>
                        <div class="flex min-w-[200px] flex-1 justify-center text-center sm:justify-start sm:text-left">
                            <span
                                class="text-base font-medium uppercase tracking-[0.45em] text-slate-500 whitespace-nowrap">
                                Tracking Information System
                            </span>
                        </div>
                        <div class="hidden h-14 w-0.5 bg-slate-900 sm:ml-7 sm:block lg:ml-16 xl:ml-20"></div>
                        <div class="flex min-w-[160px] flex-1 justify-center sm:justify-end">
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

            {{-- Hero Section --}}
            <header class="px-8 pt-12 sm:px-12 lg:px-24">
                <div
                    class="mx-auto rounded-[2rem] bg-gradient-to-br from-emerald-600 via-emerald-600 to-emerald-700 p-10 shadow-2xl">
                    <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                        <div class="max-w-2xl space-y-6">
                            <div class="flex items-center gap-3">
                                <p class="text-xs font-semibold uppercase tracking-[0.45em] text-emerald-100">
                                    Dashboard POS 2
                                </p>
                                <div class="flex items-center gap-2">
                                    <span class="relative flex h-2 w-2">
                                        <span
                                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-yellow-400 opacity-75"></span>
                                        <span class="relative inline-flex h-2 w-2 rounded-full bg-yellow-300"></span>
                                    </span>
                                    <span class="text-xs font-medium text-yellow-200">Sistem Aktif</span>
                                </div>
                            </div>
                            <h1 class="text-4xl font-bold text-white sm:text-5xl leading-tight">
                                Selamat Datang di<br>Zona Distribusi
                            </h1>
                            <p class="text-base text-emerald-50 leading-relaxed">
                                Kelola proses distribusi dan bongkar muat dengan efisien.<br>
                                Pastikan semua prosedur keselamatan terlaksana dengan optimal.
                            </p>
                        </div>
                        <div
                            class="flex-1 space-y-4 rounded-2xl border border-white/20 bg-white/10 backdrop-blur-sm p-6 text-sm lg:ml-8 lg:max-w-sm">
                            <div class="space-y-3">
                                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-emerald-100">
                                    Waktu Operasional
                                </p>
                                <div class="text-4xl font-bold text-white">
                                    <span id="currentTime">{{ $now->format('H:i') }}</span>
                                    <span class="text-2xl font-medium text-emerald-200">WIB</span>
                                </div>
                            </div>
                            <div class="border-t border-white/20 pt-3 space-y-2">
                                <div class="flex items-center justify-between text-emerald-50">
                                    <span class="text-xs uppercase tracking-[0.25em]">Tanggal</span>
                                    <span id="currentDate"
                                        class="text-sm font-semibold text-white">{{ $now->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center justify-between text-emerald-50">
                                    <span class="text-xs uppercase tracking-[0.25em]">Pengguna</span>
                                    <span
                                        class="text-sm font-semibold text-white">{{ Auth::user()->name ?? 'Guest User' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Main Content --}}
            <section class="relative mx-auto w-full flex-1 px-8 py-16 sm:px-12 lg:px-24">
                <div class="grid gap-8 lg:grid-cols-3">
                    {{-- Stats Cards --}}
                    <div class="lg:col-span-2 grid gap-6 sm:grid-cols-2">
                        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs uppercase tracking-[0.3em] text-emerald-500 font-semibold">Total
                                        Distribusi</p>
                                    <p class="mt-2 text-3xl font-bold text-emerald-900">{{ count($pos2Queues ?? []) }}
                                    </p>
                                    <p class="mt-2 text-xs text-slate-600">
                                        Kendaraan dalam proses distribusi
                                    </p>
                                </div>
                            </div>
                        </article>

                        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs uppercase tracking-[0.3em] text-amber-500 font-semibold">Waktu
                                        Rata-rata</p>
                                    <p class="mt-2 text-3xl font-bold text-amber-900">25 <span
                                            class="text-lg">Menit</span></p>
                                    <p class="mt-2 text-xs text-slate-600">
                                        Durasi proses bongkar muat
                                    </p>
                                </div>
                            </div>
                        </article>

                        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs uppercase tracking-[0.3em] text-blue-500 font-semibold">
                                        Keselamatan
                                    </p>
                                    <p class="mt-2 text-3xl font-bold text-blue-900">100%</p>
                                    <p class="mt-2 text-xs text-slate-600">
                                        Tingkat kepatuhan HSE
                                    </p>
                                </div>
                            </div>
                        </article>

                        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs uppercase tracking-[0.3em] text-purple-500 font-semibold">
                                        Dokumentasi
                                    </p>
                                    <p class="mt-2 text-3xl font-bold text-purple-900">Lengkap</p>
                                    <p class="mt-2 text-xs text-slate-600">
                                        Status verifikasi dokumen
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>

                    {{-- Info Panel --}}
                    <div class="space-y-8">
                        <article class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                            <div class="mb-6">
                                <h2 class="text-xs font-semibold uppercase tracking-[0.35em] text-emerald-600">Info
                                    Penting</h2>
                                <p class="mt-2 text-lg font-bold text-slate-900">Panduan Operasional</p>
                            </div>
                            <div class="space-y-3">
                                <div class="rounded-xl border-l-4 border-emerald-400 bg-emerald-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.3em] text-emerald-600 font-semibold mb-1">
                                        Keselamatan</p>
                                    <p class="text-sm font-semibold text-emerald-900">Pastikan semua pekerja menggunakan
                                        APD lengkap.</p>
                                </div>
                                <div class="rounded-xl border-l-4 border-amber-400 bg-amber-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.3em] text-amber-600 font-semibold mb-1">
                                        Prosedur</p>
                                    <p class="text-sm font-semibold text-amber-900">Verifikasi dokumen sebelum memulai
                                        proses bongkar muat.</p>
                                </div>
                                <div class="rounded-xl border-l-4 border-blue-400 bg-blue-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.3em] text-blue-600 font-semibold mb-1">
                                        Koordinasi</p>
                                    <p class="text-sm font-semibold text-blue-900">Komunikasi dengan POS 1 untuk update
                                        status kendaraan.</p>
                                </div>
                            </div>
                        </article>

                        <article
                            class="rounded-2xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-white p-6 shadow-sm">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-500 text-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold uppercase tracking-wider text-emerald-700">Status Sistem
                                </h3>
                            </div>
                            <p class="text-2xl font-bold text-emerald-900 mb-2">✓ Beroperasi Normal</p>
                            <p class="text-xs text-emerald-700">Semua sistem berjalan dengan baik. Tidak ada gangguan
                                yang
                                terdeteksi.</p>
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
                    overlay.classList.remove('pointer-events-none', 'opacity-0');
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
                const timeString = `${hours}:${minutes} WIB`;

                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ];
                const day = String(wibTime.getDate()).padStart(2, '0');
                const month = months[wibTime.getMonth()];
                const year = wibTime.getFullYear();
                const dateString = `${day} ${month} ${year}`;

                const timeElement = document.getElementById('currentTime');
                const dateElement = document.getElementById('currentDate');
                if (timeElement) timeElement.textContent = timeString.split(' ')[0];
                if (dateElement) dateElement.textContent = dateString;
            }

            updateWIBTime();
            setInterval(updateWIBTime, 1000);
        });

        function handleLogout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                document.getElementById('logoutForm').submit();
            }
        }
    </script>
</body>

</html>