<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pemeriksaan Kendaraan</title>
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
            border-left: 4px solid #0056b3;
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

        .status-bersyarat {
            background-color: #f59e0b;
        }

        .status-tidak {
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
        <h1>Laporan Pemeriksaan Kendaraan</h1>
        <p>PT. Wiraswasta Gemilang Indonesia</p>
        <p>Pos 1 - Security Gate Inspection</p>
    </div>

    <div class="section">
        <div class="section-title">Informasi Umum</div>
        <table>
            <tr>
                <th>Tanggal Pemeriksaan</th>
                <td>{{ $cekKendaraan->tanggal->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Waktu Masuk</th>
                <td>{{ $cekKendaraan->waktu_masuk->format('H:i') }}</td>
            </tr>
            <tr>
                <th>Waktu Keluar</th>
                <td>{{ $cekKendaraan->waktu_keluar ? $cekKendaraan->waktu_keluar->format('H:i') : '-' }}</td>
            </tr>
            <tr>
                <th>Petugas Pemeriksa</th>
                <td>{{ $cekKendaraan->nama_petugas }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Data Kendaraan & Pengemudi</div>
        <table>
            <tr>
                <th>Nomor Polisi</th>
                <td style="font-weight: bold; font-size: 14px;">{{ $cekKendaraan->nomor_polisi }}</td>
            </tr>
            <tr>
                <th>Jenis Kendaraan</th>
                <td>{{ $cekKendaraan->jenis_kendaraan }}</td>
            </tr>
            <tr>
                <th>Nama Pengemudi</th>
                <td>{{ $cekKendaraan->nama_driver }}</td>
            </tr>
            <tr>
                <th>Perusahaan / Vendor</th>
                <td>{{ $cekKendaraan->perusahaan ?? '-' }}</td>
            </tr>

        </table>
    </div>

    <div class="section">
        <div class="section-title">Hasil Pemeriksaan</div>
        <table>
            <tr>
                <th>Kelengkapan Dokumen</th>
                <td>
                    <div class="checkbox-item"><span
                            class="checkbox-symbol">{{ $cekKendaraan->surat_jalan ? '☑' : '☐' }}</span> Surat Jalan
                    </div>
                    <div class="checkbox-item"><span
                            class="checkbox-symbol">{{ $cekKendaraan->stnk_valid ? '☑' : '☐' }}</span> STNK Valid</div>
                    <div class="checkbox-item"><span
                            class="checkbox-symbol">{{ $cekKendaraan->sim_valid ? '☑' : '☐' }}</span> SIM Valid</div>
                    <div class="checkbox-item"><span
                            class="checkbox-symbol">{{ $cekKendaraan->kir_valid ? '☑' : '☐' }}</span> KIR Valid</div>
                </td>
            </tr>
            <tr>
                <th>Kondisi Fisik</th>
                <td>
                    <div class="checkbox-item">Ban: <strong>{{ $cekKendaraan->kondisi_ban }}</strong></div>
                    <div class="checkbox-item">Lampu: <strong>{{ $cekKendaraan->kondisi_lampu }}</strong></div>
                    <div class="checkbox-item">Rem: <strong>{{ $cekKendaraan->kondisi_rem }}</strong></div>
                    <div class="checkbox-item">Sein: <strong>{{ $cekKendaraan->kondisi_lampu_sen }}</strong></div>
                    <br>
                    <div class="checkbox-item"><span
                            class="checkbox-symbol">{{ $cekKendaraan->kaca_spion_lengkap ? '☑' : '☐' }}</span> Spion
                        Lengkap</div>

                </td>
            </tr>
            <tr>
                <th>Status Akhir</th>
                <td>
                    @php
                        $statusClass = match ($cekKendaraan->hasil_pemeriksaan) {
                            'Lolos' => 'status-lolos',
                            'Lolos Bersyarat' => 'status-bersyarat',
                            'Tidak Lolos' => 'status-tidak',
                            default => ''
                        };
                    @endphp
                    <span class="status-badge {{ $statusClass }}">{{ $cekKendaraan->hasil_pemeriksaan }}</span>
                </td>
            </tr>
            <tr>
                <th>Catatan</th>
                <td>{{ $cekKendaraan->catatan ?? '-' }}</td>
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