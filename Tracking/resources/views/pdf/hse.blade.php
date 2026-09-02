<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan HSE</title>
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

        .status-perbaikan {
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
        <h1>Laporan Health Safety Environment</h1>
        <p>PT. Wiraswasta Gemilang Indonesia</p>
        <p>Pos 1 - Security Gate Inspection</p>
    </div>

    <div class="section">
        <div class="section-title">Informasi Umum</div>
        <table>
            <tr>
                <th>Tanggal Pemeriksaan</th>
                <td>{{ \Carbon\Carbon::parse($hse->tanggal)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Jam</th>
                <td>{{ $hse->waktu }}</td>
            </tr>
            <tr>
                <th>Petugas Pemeriksa</th>
                <td>{{ $hse->nama_petugas }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Data Kendaraan & Pengemudi</div>
        <table>
            <tr>
                <th>Nomor Polisi</th>
                <td style="font-weight: bold; font-size: 14px;">{{ $hse->nomor_polisi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nama Driver</th>
                <td>{{ $hse->nama_driver ?? '-' }}</td>
            </tr>
            <tr>
                <th>Perusahaan / Vendor</th>
                <td>{{ $hse->perusahaan ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Checklist Keselamatan</div>
        <table>
            <tr>
                <th>Alat Pelindung Diri (APD)</th>
                <td>
                    <div class="checkbox-item"><span class="checkbox-symbol">{{ $hse->helm_safety ? '☑' : '☐' }}</span>
                        Helm Safety
                    </div>
                    <div class="checkbox-item"><span
                            class="checkbox-symbol">{{ $hse->sepatu_safety ? '☑' : '☐' }}</span> Sepatu Safety</div>
                    <div class="checkbox-item"><span class="checkbox-symbol">{{ $hse->rompi_safety ? '☑' : '☐' }}</span>
                        Rompi Safety</div>
                    <div class="checkbox-item"><span class="checkbox-symbol">{{ $hse->masker ? '☑' : '☐' }}</span>
                        Masker</div>
                    <br>
                    <div class="checkbox-item"><span
                            class="checkbox-symbol">{{ $hse->sarung_tangan ? '☑' : '☐' }}</span> Sarung Tangan</div>
                    <div class="checkbox-item"><span
                            class="checkbox-symbol">{{ $hse->kacamata_safety ? '☑' : '☐' }}</span> Kacamata Safety</div>
                </td>
            </tr>
            <tr>
                <th>Perlengkapan Area / Kendaraan</th>
                <td>
                    <div class="checkbox-item"><span
                            class="checkbox-symbol">{{ $hse->apar_tersedia ? '☑' : '☐' }}</span> APAR Tersedia
                    </div>
                    <div class="checkbox-item"><span class="checkbox-symbol">{{ $hse->kotak_p3k ? '☑' : '☐' }}</span>
                        Kotak P3K</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Hasil Pemeriksaan</div>
        <table>
            <tr>
                <th>Catatan Safety (Temuan)</th>
                <td>{{ $hse->catatan_safety ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tindak Lanjut</th>
                <td>{{ $hse->tindak_lanjut ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status Akhir</th>
                <td>
                    @php
                        $statusClass = match ($hse->status) {
                            'Lolos' => 'status-lolos',
                            'Perbaikan' => 'status-perbaikan',
                            'Ditolak' => 'status-ditolak',
                            default => ''
                        };
                    @endphp
                    <span class="status-badge {{ $statusClass }}">{{ $hse->status }}</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>Dokumen ini digenerate secara otomatis oleh sistem.</p>
    </div>

    <script type="text/javascript">
        window.onload = function () { // Wait for content to load
            window.print();
        }
    </script>
</body>

</html>