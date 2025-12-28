<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail HSE - {{ $hse->nama_petugas }}</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/wgilogo.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @media print {
            body {
                background: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .print\\:hidden {
                display: none !important;
            }

            main {
                padding-top: 0 !important;
            }

            section.fixed {
                display: none !important;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 font-sans antialiased text-slate-900">
    @php
        $evalubeLogoExists = file_exists(public_path('images/evalube.png'));
        $statusColor = match ($hse->kondisi_apd) {
            'Lengkap' => 'emerald',
            'Tidak Lengkap' => 'amber',
            'Tidak Ada' => 'rose',
            default => 'slate',
        };
    @endphp

    <div class="relative min-h-screen overflow-x-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 -z-10">
            <div class="h-full w-full bg-gradient-to-b from-white via-slate-50 to-slate-100"></div>
        </div>

        {{-- Main Content --}}
        <main class="relative flex min-h-screen flex-col pt-32 sm:pt-36 lg:pt-40">
            {{-- Branded Header Bar --}}
            <section class="fixed inset-x-0 top-0 z-40">
                <div class="overflow-hidden border-b border-slate-200 bg-white text-slate-700 shadow-sm">
                    <div class="h-3 w-full bg-[#2736a3]"></div>
                    <div class="flex flex-wrap items-center gap-6 px-6 py-6 sm:px-10">
                        <div class="flex min-w-[220px] flex-1 items-center gap-5 text-blue-900">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-full border border-blue-900/20 bg-white p-2 shadow-lg shadow-blue-900/20">
                                <img src="{{ asset('images/wgilogo.jpg') }}"
                                    alt="Logo PT. Wiraswasta Gemilang Indonesia" class="h-full w-full object-contain">
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
                        <div class="flex min-w-[200px] flex-1 justify-center text-center sm:justify-start sm:text-left">
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

            {{-- Content --}}
            <section class="flex-1 px-6 pb-12 sm:px-8">
                <div class="mx-auto max-w-4xl">
                    {{-- Report Card --}}
                    <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-slate-200">

                        {{-- Status Bar Top --}}
                        <div class="h-1.5 w-full bg-{{ $statusColor }}-500"></div>

                        {{-- Header Section --}}
                        <div class="border-b border-slate-100 bg-white px-6 py-5 sm:px-8">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-600 text-lg font-bold text-white">
                                        {{ substr($hse->nama_petugas, 0, 1) }}
                                    </div>
                                    <div>
                                        <h1 class="text-base font-bold text-slate-800">{{ $hse->nama_petugas }}</h1>
                                        <p class="text-xs text-slate-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-3.5 w-3.5 mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd" />
                                            </svg>{{ \Carbon\Carbon::parse($hse->tanggal)->format('d M Y') }} •
                                            {{ $hse->waktu }}
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="rounded-lg bg-{{ $statusColor }}-100 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-{{ $statusColor }}-700">
                                    {{ $hse->kondisi_apd }}
                                </span>
                            </div>
                        </div>

                        {{-- Body --}}
                        <div class="px-8 py-6 sm:px-12">
                            {{-- Date & Time Row --}}
                            <div class="mb-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div class="rounded-2xl border border-slate-100 bg-slate-50/50 p-6">
                                    <div class="mb-3 flex items-center gap-2 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-xs font-bold uppercase tracking-widest">Tanggal</span>
                                    </div>
                                    <p class="text-xl font-bold text-slate-800">
                                        {{ \Carbon\Carbon::parse($hse->tanggal)->translatedFormat('l, d F Y') }}
                                    </p>
                                </div>

                                <div class="rounded-2xl border border-slate-100 bg-slate-50/50 p-6">
                                    <div class="mb-3 flex items-center gap-2 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-xs font-bold uppercase tracking-widest">Waktu</span>
                                    </div>
                                    <p class="text-xl font-bold text-slate-800">{{ $hse->waktu }}</p>
                                </div>
                            </div>

                            {{-- Location & APD Status --}}
                            <div class="mb-10 grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div class="rounded-2xl border border-blue-100 bg-blue-50/50 p-6">
                                    <div class="mb-3 flex items-center gap-2 text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-xs font-bold uppercase tracking-widest">Lokasi /
                                            Checkpoint</span>
                                    </div>
                                    <p class="text-lg font-semibold text-slate-700">{{ $hse->lokasi }}</p>
                                </div>

                                <div
                                    class="rounded-2xl border border-{{ $statusColor }}-100 bg-{{ $statusColor }}-50/50 p-6">
                                    <div class="mb-3 flex items-center gap-2 text-{{ $statusColor }}-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-xs font-bold uppercase tracking-widest">Kondisi APD</span>
                                    </div>
                                    <p class="text-lg font-bold text-{{ $statusColor }}-700">{{ $hse->kondisi_apd }}</p>
                                </div>
                            </div>

                            {{-- Temuan, Tindak Lanjut, Penanggung Jawab Grid --}}
                            <div class="mb-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                                {{-- Temuan --}}
                                <div class="rounded-2xl border border-amber-100 bg-amber-50/50 p-6">
                                    <div class="mb-3 flex items-center gap-2 text-amber-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-xs font-bold uppercase tracking-widest">Temuan</span>
                                    </div>
                                    <p class="text-lg font-semibold text-slate-700">
                                        {{ $hse->temuan ?? 'Tidak ada temuan yang dicatat.' }}
                                    </p>
                                </div>

                                {{-- Tindak Lanjut --}}
                                <div class="rounded-2xl border border-emerald-100 bg-emerald-50/50 p-6">
                                    <div class="mb-3 flex items-center gap-2 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-xs font-bold uppercase tracking-widest">Tindak Lanjut</span>
                                    </div>
                                    <p class="text-lg font-semibold text-slate-700">
                                        {{ $hse->tindak_lanjut ?? 'Tidak ada tindak lanjut yang diperlukan.' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Penanggung Jawab --}}
                            <div class="rounded-2xl border border-slate-100 bg-slate-50/50 p-6">
                                <div class="mb-3 flex items-center gap-2 text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-xs font-bold uppercase tracking-widest">Penanggung Jawab</span>
                                </div>
                                <p class="text-lg font-semibold text-slate-700">{{ $hse->penanggung_jawab ?? '-' }}</p>
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div class="border-t border-slate-100 bg-slate-50/50 px-8 py-6 sm:px-12 print:hidden">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <a href="{{ route('hse.daftar') }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-lg transition-all hover:bg-emerald-700 hover:scale-105 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Kembali ke Daftar HSE
                                </a>
                                <button onclick="window.print()"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-lg transition-all hover:bg-emerald-700 hover:scale-105 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Simpan PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>