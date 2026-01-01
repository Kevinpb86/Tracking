<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Distribusi - POS 2</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

        <main class="relative flex min-h-screen flex-col pt-20">
            <section class="fixed inset-x-0 top-0 z-40">
                <div class="overflow-hidden border-b border-slate-200 bg-white text-slate-700 shadow-sm">
                    <div class="h-3 w-full bg-[#2736a3]"></div>
                    <div class="flex flex-wrap items-center gap-6 px-6 py-6">
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

            <div class="px-8 py-12 sm:px-12 lg:px-24">
                <div class="mx-auto max-w-5xl">
                    {{-- Back Button --}}
                    <div class="mb-8">
                        <a href="{{ route('cek-barang.index') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Kembali ke Daftar Distribusi
                        </a>
                    </div>

                    {{-- Header Card --}}
                    <div class="mb-8 rounded-3xl bg-gradient-to-r from-emerald-500 to-emerald-600 p-8 shadow-xl">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="mb-2 inline-flex items-center gap-2 rounded-full bg-white/20 px-4 py-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                        <path fill-rule="evenodd"
                                            d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-xs font-bold uppercase tracking-wider text-white">Detail
                                        Distribusi</span>
                                </div>
                                <h1 class="text-3xl font-bold text-white mb-2">
                                    CB-{{ str_pad($cekBarang->id, 3, '0', STR_PAD_LEFT) }}</h1>
                                <p class="text-emerald-50">{{ $cekBarang->jenis_barang }}</p>
                            </div>
                            <div class="text-right">
                                @php
                                    $statusColor = match ($cekBarang->status_akhir) {
                                        'Lolos' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                        'Ditahan' => 'bg-amber-100 text-amber-700 border-amber-200',
                                        'Ditolak' => 'bg-rose-100 text-rose-700 border-rose-200',
                                        default => 'bg-slate-100 text-slate-700 border-slate-200'
                                    };
                                @endphp
                                <span
                                    class="inline-flex items-center gap-2 rounded-full {{ $statusColor }} border px-4 py-2 text-sm font-bold">
                                    <span
                                        class="h-2 w-2 rounded-full {{ $cekBarang->status_akhir === 'Lolos' ? 'bg-emerald-500' : ($cekBarang->status_akhir === 'Ditahan' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                                    {{ strtoupper($cekBarang->status_akhir) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Main Content --}}
                    <div class="space-y-6">
                        {{-- Informasi Dasar --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-slate-800">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                Informasi Dasar
                            </h2>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Tanggal
                                        Pemeriksaan</p>
                                    <p class="mt-1 text-sm font-medium text-slate-700">
                                        {{ date('d F Y', strtotime($cekBarang->tanggal)) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Waktu</p>
                                    <p class="mt-1 text-sm font-medium text-slate-700">
                                        {{ substr($cekBarang->waktu, 0, 5) }} WIB</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Nama
                                        Pemeriksa</p>
                                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $cekBarang->nama_pemeriksa }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Nomor DO
                                    </p>
                                    <p class="mt-1 text-sm font-medium text-slate-700 font-mono">
                                        {{ $cekBarang->nomor_do ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Kendaraan & Pengemudi --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-slate-800">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                        <path
                                            d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                                    </svg>
                                </div>
                                Informasi Kendaraan & Pengemudi
                            </h2>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Nomor
                                        Polisi</p>
                                    <p
                                        class="mt-1 text-sm font-bold font-mono text-slate-700 bg-slate-50 px-2 py-1 rounded border border-slate-200 inline-block">
                                        {{ $cekBarang->nomor_polisi }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Nama
                                        Pengemudi</p>
                                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $cekBarang->nama_pengemudi }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Jenis
                                        Kendaraan</p>
                                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $cekBarang->jenis_kendaraan }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Barang --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-slate-800">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                        <path fill-rule="evenodd"
                                            d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                Informasi Barang
                            </h2>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Jenis
                                        Barang</p>
                                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $cekBarang->jenis_barang }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Jumlah</p>
                                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $cekBarang->jumlah_barang }}
                                        {{ $cekBarang->satuan }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Hasil Pemeriksaan --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-slate-800">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                        <path fill-rule="evenodd"
                                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                Hasil Pemeriksaan
                            </h2>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Kondisi
                                        Kemasan</p>
                                    <p class="mt-1">
                                        <span
                                            class="inline-flex items-center rounded-full {{ $cekBarang->kondisi_kemasan === 'Baik' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200' }} border px-3 py-1 text-xs font-semibold">
                                            {{ $cekBarang->kondisi_kemasan }}
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Kesesuaian
                                        Jumlah</p>
                                    <p class="mt-1">
                                        <span
                                            class="inline-flex items-center rounded-full {{ $cekBarang->kesesuaian_jumlah === 'Sesuai' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }} border px-3 py-1 text-xs font-semibold">
                                            {{ $cekBarang->kesesuaian_jumlah }}
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Kelengkapan
                                        Dokumen</p>
                                    <p class="mt-1">
                                        <span
                                            class="inline-flex items-center rounded-full {{ $cekBarang->kelengkapan_dokumen === 'Lengkap' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }} border px-3 py-1 text-xs font-semibold">
                                            {{ $cekBarang->kelengkapan_dokumen }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Pemeriksaan Khusus Truck Tangki --}}
                        @if($cekBarang->jenis_kendaraan === 'Truck Tangki')
                            <div class="rounded-2xl border border-amber-200 bg-amber-50/50 p-6 shadow-sm">
                                <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-amber-800">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    Pemeriksaan Khusus Truck Tangki
                                </h2>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-wider text-amber-600">Kebocoran
                                            Tangki</p>
                                        <p class="mt-1">
                                            <span
                                                class="inline-flex items-center rounded-full {{ $cekBarang->kebocoran_tangki === 'Tidak Ada' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200' }} border px-3 py-1 text-xs font-semibold">
                                                {{ $cekBarang->kebocoran_tangki ?? '-' }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-wider text-amber-600">Kondisi
                                            Seal Tangki</p>
                                        <p class="mt-1">
                                            <span
                                                class="inline-flex items-center rounded-full {{ $cekBarang->kondisi_seal_tangki === 'Baik' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200' }} border px-3 py-1 text-xs font-semibold">
                                                {{ $cekBarang->kondisi_seal_tangki ?? '-' }}
                                            </span>
                                        </p>
                                    </div>
                                    @if($cekBarang->lokasi_kebocoran)
                                        <div class="md:col-span-2">
                                            <p class="text-xs font-semibold uppercase tracking-wider text-amber-600">Lokasi
                                                Kebocoran</p>
                                            <p
                                                class="mt-1 text-sm text-amber-800 bg-white rounded-lg p-3 border border-amber-200">
                                                {{ $cekBarang->lokasi_kebocoran }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Catatan --}}
                        @if($cekBarang->catatan)
                            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                                <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-slate-800">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    Catatan
                                </h2>
                                <p
                                    class="text-sm text-slate-700 leading-relaxed bg-slate-50 rounded-lg p-4 border border-slate-200">
                                    {{ $cekBarang->catatan }}</p>
                            </div>
                        @endif

                        {{-- Action Buttons --}}
                        <div class="flex gap-4 pt-4">
                            <a href="{{ route('cek-barang.edit', $cekBarang->id) }}"
                                class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 transition-all hover:bg-emerald-700 hover:scale-105 active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Edit Data
                            </a>
                            <a href="{{ route('cek-barang.export-pdf', $cekBarang->id) }}" target="_blank"
                                class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/20 transition-all hover:bg-slate-800 hover:scale-105 active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                        clip-rule="evenodd" />
                                </svg>
                                Export PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>