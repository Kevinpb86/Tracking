<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pemeriksaan Barang Distribusi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 10px;
        }

        .header h1 {
            font-size: 18px;
            margin: 0;
            text-transform: uppercase;
        }

        .header p {
            margin: 2px 0;
            font-size: 10px;
        }

        .section {
            margin-bottom: 15px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 5px;
            margin-bottom: 10px;
            border-left: 4px solid #10b981;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            text-align: left;
            padding: 6px;
            border-bottom: 1px solid #ddd;
        }

        th {
            width: 35%;
            font-weight: bold;
            color: #555;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            color: #fff;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }

        .status-lolos {
            background-color: #10b981;
        }

        .status-ditahan {
            background-color: #f59e0b;
        }

        .status-ditolak {
            background-color: #ef4444;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #777;
        }

        .checkbox-item {
            display: inline-block;
            margin-right: 15px;
        }

        .checkbox-symbol {
            font-family: DejaVu Sans, sans-serif;
        }

        .warning-section {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 10px;
            margin-bottom: 15px;
        }

        .warning-section .section-title {
            background-color: transparent;
            border-left: none;
            color: #92400e;
            padding: 0;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        @php
            $logoPath = public_path('images/wgilogo.jpg');
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoSrc = 'data:image/jpeg;base64,' . $logoData;
        @endphp
        <img src="{{ $logoSrc }}" alt="Logo PT WGI" class="logo">
        <h1>Laporan Pemeriksaan Barang Distribusi</h1>
        <p>PT. Wiraswasta Gemilang Indonesia</p>
        <p>Pos 2 - Distribution Check</p>
    </div>

    <div class="section">
        <div class="section-title">Informasi Umum</div>
        <table>
            <tr>
                <th>Tanggal Pemeriksaan</th>
                <td>{{ date('d F Y', strtotime($cekBarang->tanggal)) }}</td>
            </tr>
            <tr>
                <th>Waktu Masuk</th>
                <td>{{ substr($cekBarang->waktu, 0, 5) }}</td>
            </tr>
            <tr>
                <th>Petugas Pemeriksa</th>
                <td>{{ $cekBarang->nama_pemeriksa }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Data Kendaraan & Pengemudi</div>
        <table>
            <tr>
                <th>Nomor Polisi</th>
                <td style="font-weight: bold; font-size: 14px;">{{ $cekBarang->nomor_polisi }}</td>
            </tr>
            <tr>
                <th>Jenis Kendaraan</th>
                <td>{{ $cekBarang->jenis_kendaraan }}</td>
            </tr>
            <tr>
                <th>Nama Pengemudi</th>
                <td>{{ $cekBarang->nama_pengemudi }}</td>
            </tr>
            <tr>
                <th>Nomor DO</th>
                <td>{{ $cekBarang->nomor_do ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Informasi Barang</div>
        <table>
            <tr>
                <th>Jenis Barang</th>
                <td>{{ $cekBarang->jenis_barang }}</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td><strong>{{ $cekBarang->jumlah_barang }} {{ $cekBarang->satuan }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Hasil Pemeriksaan</div>
        <table>
            <tr>
                <th>Kondisi Kemasan</th>
                <td><strong>{{ $cekBarang->kondisi_kemasan }}</strong></td>
            </tr>
            <tr>
                <th>Kesesuaian Jumlah</th>
                <td><strong>{{ $cekBarang->kesesuaian_jumlah }}</strong></td>
            </tr>
            <tr>
                <th>Kelengkapan Dokumen</th>
                <td><strong>{{ $cekBarang->kelengkapan_dokumen }}</strong></td>
            </tr>
            <tr>
                <th>Status Akhir</th>
                <td>
                    @php
                        $statusClass = match ($cekBarang->status_akhir) {
                            'Lolos' => 'status-lolos',
                            'Ditahan' => 'status-ditahan',
                            'Ditolak' => 'status-ditolak',
                            default => ''
                        };
                    @endphp
                    <span class="status-badge {{ $statusClass }}">{{ $cekBarang->status_akhir }}</span>
                </td>
            </tr>
            @if($cekBarang->catatan)
                <tr>
                    <th>Catatan</th>
                    <td>{{ $cekBarang->catatan }}</td>
                </tr>
            @endif
        </table>
    </div>

    @if($cekBarang->jenis_kendaraan === 'Truck Tangki')
        <div class="warning-section">
            <div class="section-title">⚠ Pemeriksaan Khusus Truck Tangki</div>
            <table>
                <tr>
                    <th>Kebocoran Tangki</th>
                    <td><strong>{{ $cekBarang->kebocoran_tangki ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <th>Kondisi Seal Tangki</th>
                    <td><strong>{{ $cekBarang->kondisi_seal_tangki ?? '-' }}</strong></td>
                </tr>
                @if($cekBarang->lokasi_kebocoran)
                    <tr>
                        <th>Lokasi Kebocoran</th>
                        <td>{{ $cekBarang->lokasi_kebocoran }}</td>
                    </tr>
                @endif
            </table>
        </div>
    @endif

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>Dokumen ini digenerate secara otomatis oleh sistem.</p>
    </div>

    <script type="text/javascript">
        window.onload = function () {
            window.print();
    }
    </script>
</body>

</html>