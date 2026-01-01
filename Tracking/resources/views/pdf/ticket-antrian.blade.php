<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Antrian - {{ $antrian->no_antrian }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            /* Monospace for ticket feel */
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        .ticket-container {
            width: 300px;
            /* Standard thermal printer width approx */
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border: 1px dashed #aaa;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header .logo-img {
            width: 60px;
            height: 60px;
            margin: 0 auto 10px;
        }

        .logo {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .sub-logo {
            font-size: 12px;
        }

        .queue-number {
            text-align: center;
            font-size: 42px;
            font-weight: bold;
            margin: 20px 0;
            border: 2px solid #333;
            padding: 10px;
        }

        .details {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .details-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .label {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .priority-badge {
            display: inline-block;
            background: #333;
            color: #fff;
            padding: 4px 8px;
            font-size: 12px;
            border-radius: 4px;
            margin-top: 5px;
        }

        @media print {
            body {
                background: none;
                padding: 0;
            }

            .ticket-container {
                box-shadow: none;
                border: none;
                width: 100%;
            }

            /* Hide everything else if this page is embedded, but since it's a dedicated page, it's fine */
        }
    </style>
</head>

<body onload="window.print()">
    <div class="ticket-container">
        <div class="header">
            @php
                $logoPath = public_path('images/wgilogo.jpg');
                $logoData = base64_encode(file_get_contents($logoPath));
                $logoSrc = 'data:image/jpeg;base64,' . $logoData;
            @endphp
            <img src="{{ $logoSrc }}" alt="Logo PT WGI" class="logo-img">
            <div class="logo">PT. WGI</div>
            <div class="sub-logo">Tracking System - Pos 1</div>
        </div>

        <div style="text-align: center;">
            <div style="font-size: 12px; text-transform: uppercase;">Nomor Antrian</div>
            <div class="queue-number">{{ $antrian->no_antrian }}</div>

            @if($antrian->emr && $antrian->emr !== 'Normal')
                <div class="priority-badge">{{ strtoupper($antrian->emr) }}</div>
            @endif
        </div>

        <div class="details">
            <div class="details-row">
                <span class="label">Tanggal:</span>
                <span>{{ date('d-m-Y', strtotime($antrian->tgl_antrian)) }}</span>
            </div>
            <div class="details-row">
                <span class="label">Jam Masuk:</span>
                <span>{{ $antrian->jam_diizinkan_masuk }}</span>
            </div>
            <div class="details-row">
                <span class="label">No. Polisi:</span>
                <span>{{ $antrian->nomor_polisi }}</span>
            </div>
            <div class="details-row">
                <span class="label">Supir:</span>
                <span>{{ \Illuminate\Support\Str::limit($antrian->nama_driver, 15) }}</span>
            </div>
            <div class="details-row">
                <span class="label">Tujuan:</span>
                <span>{{ \Illuminate\Support\Str::limit($antrian->tujuan, 15) }}</span>
            </div>
            <div class="details-row">
                <span class="label">Jenis:</span>
                <span>{{ $antrian->jenis_antrian }}</span>
            </div>
        </div>

        <div class="footer">
            <p>Silakan menunggu panggilan petugas.</p>
            <p>Dicetak: {{ date('d-m-Y H:i') }}</p>
        </div>
    </div>
</body>

</html>