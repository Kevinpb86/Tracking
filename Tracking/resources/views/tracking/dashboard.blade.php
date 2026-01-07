@extends('layouts.app')

@section('content')
    <div class="p-6">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Tracking Dashboard</h1>
                <p class="text-slate-500 text-sm">Monitoring pergerakan kendaraan secara real-time</p>
            </div>
            <div class="flex items-center gap-3">
                <div
                    class="px-4 py-2 bg-emerald-50 text-emerald-600 rounded-lg text-sm font-semibold border border-emerald-100 italic">
                    Sistem Tracking Online
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
            {{-- Total --}}
            <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Hari Ini</p>
                <p class="text-2xl font-bold text-slate-800">{{ $stats['total_hari_ini'] }}</p>
            </div>
            {{-- Menunggu --}}
            <div class="bg-amber-50 p-4 rounded-xl shadow-sm border border-amber-100">
                <p class="text-xs font-bold text-amber-500 uppercase tracking-wider mb-1">Menunggu</p>
                <p class="text-2xl font-bold text-amber-700">{{ $stats['menunggu'] }}</p>
            </div>
            {{-- Dalam Pemeriksaan --}}
            <div class="bg-blue-50 p-4 rounded-xl shadow-sm border border-blue-100">
                <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-1">Pemeriksaan</p>
                <p class="text-2xl font-bold text-blue-700">{{ $stats['dalam_pemeriksaan'] }}</p>
            </div>
            {{-- Lolos --}}
            <div class="bg-emerald-50 p-4 rounded-xl shadow-sm border border-emerald-100">
                <p class="text-xs font-bold text-emerald-500 uppercase tracking-wider mb-1">Lolos</p>
                <p class="text-2xl font-bold text-emerald-700">{{ $stats['lolos'] }}</p>
            </div>
            {{-- Ditolak --}}
            <div class="bg-rose-50 p-4 rounded-xl shadow-sm border border-rose-100">
                <p class="text-xs font-bold text-rose-500 uppercase tracking-wider mb-1">Ditolak</p>
                <p class="text-2xl font-bold text-rose-700">{{ $stats['ditolak'] }}</p>
            </div>
            {{-- Selesai --}}
            <div class="bg-slate-50 p-4 rounded-xl shadow-sm border border-slate-100">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Selesai</p>
                <p class="text-2xl font-bold text-slate-700">{{ $stats['selesai'] }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Tracking Aktif --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="font-bold text-slate-800">Tracking Aktif (Live)</h2>
                        <span
                            class="px-2 py-1 bg-blue-100 text-blue-600 rounded text-xs font-bold">{{ count($trackingAktif) }}
                            Kendaraan</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th
                                        class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">
                                        Kendaraan</th>
                                    <th
                                        class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">
                                        Lokasi Terakhir</th>
                                    <th
                                        class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-slate-500 border-b border-slate-100">
                                        Waktu Masuk</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($trackingAktif as $tracking)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-slate-800">{{ $tracking->nomor_polisi }}</div>
                                            <div class="text-xs text-slate-500">{{ $tracking->nama_driver }}
                                                ({{ $tracking->perusahaan }})</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-medium border border-slate-200">
                                                {{ $tracking->lokasi_terakhir }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusClasses = [
                                                    'Menunggu' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                    'Dalam Pemeriksaan' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                    'Lolos' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                                    'Lolos Bersyarat' => 'bg-cyan-100 text-cyan-700 border-cyan-200',
                                                    'Ditahan' => 'bg-orange-100 text-orange-700 border-orange-200',
                                                    'Ditolak' => 'bg-rose-100 text-rose-700 border-rose-200',
                                                    'Selesai' => 'bg-slate-100 text-slate-700 border-slate-200',
                                                ];
                                                $class = $statusClasses[$tracking->status_keseluruhan] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                            @endphp
                                            <span
                                                class="px-3 py-1 rounded-full text-[10px] uppercase font-bold border {{ $class }}">
                                                {{ $tracking->status_keseluruhan }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-500">
                                            {{ $tracking->waktu_masuk }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-slate-500 italic">
                                            Tidak ada aktivitas tracking saat ini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Lokasi Overview --}}
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h2 class="font-bold text-slate-800 mb-4">Distribusi Lokasi</h2>
                    <div class="space-y-4">
                        @foreach($distribusiLokasi as $lokasi)
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-slate-600">{{ $lokasi->lokasi_terakhir }}</div>
                                <div class="flex items-center gap-2">
                                    <div class="h-2 w-24 bg-slate-100 rounded-full overflow-hidden">
                                        @php
                                            $percentage = ($stats['total_hari_ini'] > 0) ? ($lokasi->total / $stats['total_hari_ini']) * 100 : 0;
                                        @endphp
                                        <div class="h-full bg-blue-500" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-slate-800">{{ $lokasi->total }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div
                    class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-6 text-white shadow-lg shadow-blue-500/20">
                    <h3 class="font-bold mb-2">Butuh Bantuan?</h3>
                    <p class="text-blue-100 text-xs mb-4 leading-relaxed">Hubungi admin IT jika terdapat kendala pada sistem
                        tracking real-time.</p>
                    <a href="#"
                        class="inline-flex items-center text-xs font-bold uppercase tracking-wider bg-white/20 hover:bg-white/30 px-3 py-2 rounded-lg transition-colors">
                        Lihat Panduan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection