{{-- Premium Analytics Section with Charts --}}
<div class="lg:col-span-2 space-y-8 mt-8">
    {{-- Distribution Trends Chart --}}
    <article
        class="group relative overflow-hidden rounded-[2.5rem] border border-slate-200 bg-gradient-to-br from-white via-emerald-50/30 to-teal-50/30 p-10 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-slate-300/50 transition-all duration-500">
        {{-- Decorative Background Elements --}}
        <div
            class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-gradient-to-br from-emerald-400/10 to-teal-400/10 blur-3xl group-hover:scale-110 transition-transform duration-700">
        </div>
        <div
            class="absolute -left-20 -bottom-20 h-64 w-64 rounded-full bg-gradient-to-tr from-teal-400/10 to-emerald-400/10 blur-3xl group-hover:scale-110 transition-transform duration-700">
        </div>

        <div class="relative z-10">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg shadow-emerald-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                        <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-emerald-600">
                            Distribution Analytics</h2>
                    </div>
                    <p class="text-2xl font-black text-slate-900 tracking-tight">Tren Distribusi Bulanan</p>
                    <p class="text-xs text-slate-500 mt-1 font-medium">Performa pemeriksaan barang - 6 bulan terakhir
                    </p>
                </div>
                <div
                    class="flex items-center gap-2 rounded-xl bg-white/80 backdrop-blur-sm border border-slate-200/50 p-1 shadow-sm">
                    <button
                        class="px-4 py-2 text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg shadow-md shadow-emerald-200">6
                        Bulan</button>
                    <button
                        class="px-4 py-2 text-xs font-bold text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-lg transition-all">3
                        Bulan</button>
                </div>
            </div>

            {{-- Chart Container with Premium Styling --}}
            <div class="relative rounded-2xl bg-white/60 backdrop-blur-sm border border-slate-200/50 p-6 shadow-inner">
                <div class="relative h-[400px]">
                    <canvas id="distributionTrendsChart"></canvas>
                </div>
            </div>
        </div>
    </article>

    {{-- Quality Breakdown & Recent Activities --}}
    <div class="grid gap-8 sm:grid-cols-2">
        {{-- Quality Breakdown Donut Chart --}}
        <article
            class="group relative overflow-hidden rounded-[2.5rem] border border-slate-200 bg-gradient-to-br from-white to-emerald-50/40 p-8 shadow-lg hover:shadow-xl transition-all duration-500">
            <div
                class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-emerald-400/10 blur-3xl group-hover:scale-110 transition-transform duration-700">
            </div>

            <div class="relative z-10">
                <div class="mb-6">
                    <div class="flex items-center gap-2 mb-2">
                        <div
                            class="h-8 w-8 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-md shadow-emerald-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                        </div>
                        <h3 class="text-[9px] font-black uppercase tracking-[0.3em] text-emerald-600">Quality Metrics
                        </h3>
                    </div>
                    <p class="text-lg font-black text-slate-900">Status Pemeriksaan</p>
                </div>

                <div class="relative h-[280px] flex items-center justify-center">
                    <canvas id="qualityBreakdownChart"></canvas>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-3">
                    <div class="text-center p-3 rounded-xl bg-emerald-50/50 border border-emerald-100/50">
                        <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Lolos</p>
                        <p class="text-2xl font-black text-emerald-700 mt-1">{{ $lolosCount }}</p>
                    </div>
                    <div class="text-center p-3 rounded-xl bg-amber-50/50 border border-amber-100/50">
                        <p class="text-xs font-bold text-amber-600 uppercase tracking-wider">Ditahan</p>
                        <p class="text-2xl font-black text-amber-700 mt-1">{{ $ditahanCount }}</p>
                    </div>
                    <div class="text-center p-3 rounded-xl bg-red-50/50 border border-red-100/50">
                        <p class="text-xs font-bold text-red-600 uppercase tracking-wider">Ditolak</p>
                        <p class="text-2xl font-black text-red-700 mt-1">{{ $ditolakCount }}</p>
                    </div>
                </div>
            </div>
        </article>

        {{-- Recent Activity Feed --}}
        <article
            class="group relative overflow-hidden rounded-[2.5rem] border border-slate-200 bg-gradient-to-br from-white to-teal-50/40 shadow-lg hover:shadow-xl transition-all duration-500">
            <div
                class="absolute -left-10 -bottom-10 h-40 w-40 rounded-full bg-teal-400/10 blur-3xl group-hover:scale-110 transition-transform duration-700">
            </div>

            <div class="relative z-10">
                <div class="px-8 pt-8 pb-6 border-b border-slate-100">
                    <div class="flex items-center gap-2 mb-2">
                        <div
                            class="h-8 w-8 rounded-lg bg-gradient-to-br from-teal-500 to-emerald-600 flex items-center justify-center shadow-md shadow-teal-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-[9px] font-black uppercase tracking-[0.3em] text-teal-600">Live Activity</h3>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-lg font-black text-slate-900">Aktivitas Terbaru</p>
                        <a href="{{ route('cek-barang.index') }}"
                            class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors">Lihat
                            Semua →</a>
                    </div>
                </div>

                <div class="divide-y divide-slate-100 max-h-[400px] overflow-y-auto">
                    @forelse($recentActivities as $activity)
                        <div class="px-8 py-4 flex items-center justify-between hover:bg-white/50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $activity->status_akhir == 'Lolos' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                        <path
                                            d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10V8a1 1 0 011-1h5a1 1 0 011 1v2h1.05a2.5 2.5 0 014.9 0H23V9l-3.29-3.29A1 1 0 0019 5.42V4a1 1 0 00-1-1H3z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">{{ $activity->nomor_polisi }}</p>
                                    <p class="text-[10px] uppercase font-bold tracking-wider text-slate-400">
                                        {{ $activity->nama_pengemudi }} • {{ $activity->jenis_barang }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p
                                    class="text-xs font-bold {{ $activity->status_akhir == 'Lolos' ? 'text-emerald-600' : 'text-amber-600' }}">
                                    {{ $activity->status_akhir }}</p>
                                <p class="text-[10px] font-bold text-slate-400">
                                    {{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="px-8 py-12 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-12 w-12 mx-auto mb-2 opacity-50 text-slate-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <p class="text-sm text-slate-500 font-medium">Belum ada aktivitas distribusi terdata.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </article>
    </div>
</div>