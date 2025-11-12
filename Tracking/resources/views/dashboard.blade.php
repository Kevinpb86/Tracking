<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracking Dashboard - PT. WGI</title>

    <style>
        :root {
            --primary: #0c2c78;
            --secondary: #1f4172;
            --accent: #ffc107;
            --danger: #c62c28;
            --danger-dark: #a8201b;
            --sidebar-bg: #f6f8fb;
            --table-header: #e5e7eb;
            --text-dark: #1f2937;
            --text-muted: #4b5563;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #edf1f6;
            color: var(--text-dark);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: linear-gradient(135deg, rgba(12, 44, 120, 0.95), rgba(31, 65, 114, 0.95));
            color: var(--white);
            padding: 18px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .brand {
            display: flex;
            align-items: center;
        }

        .header .brand img {
            height: 58px;
            margin-right: 16px;
            border-radius: 8px;
            background: var(--white);
            padding: 6px;
        }

        .header .brand h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .header .brand span {
            display: block;
            font-size: 13px;
            font-weight: 400;
            margin-top: 4px;
            letter-spacing: 0.2px;
        }

        .header .partner img {
            height: 52px;
        }

        .sub-header {
            background: #e6ebf6;
            border-bottom: 1px solid #d7dce5;
            padding: 10px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: var(--text-muted);
        }

        .sub-header .welcome {
            font-weight: 600;
            color: var(--primary);
        }

        .content-area {
            flex: 1;
            display: flex;
            min-height: 0;
        }

        .sidebar {
            width: 220px;
            background: var(--sidebar-bg);
            border-right: 1px solid #dae0ec;
            padding: 24px 18px;
            display: flex;
            flex-direction: column;
        }

        .sidebar .user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 18px;
            text-transform: capitalize;
        }

        .sidebar .menu-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li + li {
            margin-top: 10px;
        }

        .sidebar a,
        .sidebar button {
            display: block;
            width: 100%;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid transparent;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            color: var(--text-dark);
            background: transparent;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .sidebar a:hover,
        .sidebar button:hover {
            background: var(--white);
            border-color: rgba(12, 44, 120, 0.25);
            color: var(--primary);
        }

        .sidebar .logout-btn {
            color: #d0302f;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            min-width: 0;
        }

        .actions-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .refresh-button {
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 6px;
            padding: 10px 18px;
            font-weight: 600;
            letter-spacing: 0.4px;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(12, 44, 120, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .refresh-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(12, 44, 120, 0.35);
        }

        .last-update {
            font-size: 12px;
            color: var(--text-muted);
        }

        .table-wrapper {
            background: var(--white);
            border-radius: 10px;
            border: 1px solid #d7dce5;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(31, 65, 114, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        thead {
            background: var(--table-header);
            color: var(--text-dark);
        }

        thead th {
            padding: 12px 10px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            border-right: 1px solid #d1d5db;
            letter-spacing: 0.03em;
        }

        thead th:last-child {
            border-right: none;
        }

        tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        tbody td {
            padding: 12px 10px;
            font-size: 13px;
            text-align: center;
            background: linear-gradient(180deg, rgba(214, 40, 40, 0.95), rgba(168, 32, 27, 0.95));
            color: var(--white);
            border-right: 1px solid rgba(255, 255, 255, 0.12);
        }

        tbody td:first-child {
            font-weight: 700;
            font-size: 14px;
            width: 62px;
        }

        tbody td:last-child {
            border-right: none;
        }

        tbody td strong {
            font-weight: 700;
        }

        .status-tag {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 1px solid rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.15);
        }

        .status-open {
            background: rgba(16, 185, 129, 0.25);
            border-color: rgba(16, 185, 129, 0.45);
        }

        .finish-link {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 6px;
            background: var(--accent);
            color: #1a202c;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            box-shadow: 0 2px 6px rgba(255, 193, 7, 0.4);
        }

        .finish-link:hover {
            background: #ffb000;
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            background: #fef2f2;
            color: #b91c1c;
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        @media (max-width: 1100px) {
            .content-area {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                align-items: flex-start;
                gap: 24px;
                padding: 16px 24px;
            }

            .sidebar ul {
                display: flex;
                gap: 12px;
            }

            .sidebar li {
                margin: 0 !important;
            }

            .sidebar a,
            .sidebar button {
                white-space: nowrap;
            }
        }

        @media (max-width: 920px) {
            .table-wrapper {
                overflow-x: auto;
            }

            table {
                min-width: 1200px;
            }
        }
    </style>
</head>
<body>
    @php
        $queueItems = $queues ?? [];
        $now = now();

        $columns = [
            'queue_number' => 'No. Queue',
            'nomor_do' => 'No. DO',
            'tanggal_antrian' => 'Tgl Antrian',
            'jenis_antrian' => 'Jenis Antrian',
            'no_pol' => 'No. Pol',
            'angkutan' => 'Angkutan',
            'tipe_kendaraan' => 'Tipe Kendaraan',
            'supir' => 'Supir',
            'lokasi' => 'Lokasi',
            'lapor_pos_1' => 'Lapor Pos 1',
            'ambil_do' => 'Ambil DO',
            'masuk_plant' => 'Masuk Plant',
            'keluar_plant' => 'Keluar Plant',
            'status' => 'Status',
            'tujuan' => 'Tujuan',
        ];
    @endphp

    <div class="page-wrapper">
        <header class="header">
            <div class="brand">
                <img src="{{ asset('images/wgilogo.jpg') }}" alt="PT. WGI Logo">
                <div>
                    <h1>PT. Wiraswasta Gemilang Indonesia</h1>
                    <span>Tracking Information System</span>
                </div>
            </div>
            <div class="partner">
                <img src="{{ asset('images/evalube-logo.png') }}" alt="Evalube Lubricants">
            </div>
        </header>

        <div class="sub-header">
            <div class="welcome">Selamat datang, {{ Auth::user()->name }}</div>
            <div>Posisi: POS 1</div>
        </div>

        <div class="content-area">
            <aside class="sidebar">
                <div class="user-name">Welcome {{ Auth::user()->name }}</div>
                <div>
                    <div class="menu-title">Menu for Role POS 1</div>
                    <ul>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="logout-btn">Logout</button>
                            </form>
                        </li>
                        <li><a href="{{ route('dashboard') }}">Antrian</a></li>
                        <li><a href="#">HSE</a></li>
                    </ul>
                </div>
            </aside>

            <main class="main-content">
                <div class="actions-bar">
                    <button type="button" class="refresh-button" onclick="window.location.reload()">Refresh List</button>
                    <div class="last-update">Terakhir diperbarui: {{ $now->format('d-m-Y H:i') }} WIB</div>
                </div>

                <div class="table-wrapper">
                    @if (count($queueItems))
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    @foreach($columns as $label)
                                        <th>{{ $label }}</th>
                                    @endforeach
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($queueItems as $queue)
                                    @php
                                        $noDo = data_get($queue, 'nomor_do', data_get($queue, 'no_do', '-'));
                                        if (is_iterable($noDo)) {
                                            $noDo = collect($noDo)->filter()->implode(', ');
                                        }

                                        $status = strtoupper((string) data_get($queue, 'status', 'Close'));
                                        $actionUrl = data_get($queue, 'action_url', '#');
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $noDo ?: '-' }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse(data_get($queue, 'tanggal_antrian', $now))->format('d-m-Y') }}</td>
                                        <td>{{ data_get($queue, 'jenis_antrian', 'Finish Product') }}</td>
                                        <td>{{ data_get($queue, 'no_pol', '-') }}</td>
                                        <td>{{ data_get($queue, 'angkutan', '-') }}</td>
                                        <td>{{ data_get($queue, 'tipe_kendaraan', '-') }}</td>
                                        <td>{{ data_get($queue, 'supir', '-') }}</td>
                                        <td>{{ data_get($queue, 'lokasi', '-') }}</td>
                                        <td>{{ data_get($queue, 'lapor_pos_1', '-') }}</td>
                                        <td>{{ data_get($queue, 'ambil_do', '-') }}</td>
                                        <td>{{ data_get($queue, 'masuk_plant', '-') }}</td>
                                        <td>{{ data_get($queue, 'keluar_plant', '-') }}</td>
                                        <td>
                                            <span class="status-tag {{ $status === 'OPEN' ? 'status-open' : '' }}">
                                                {{ $status }}
                                            </span>
                                        </td>
                                        <td>{{ data_get($queue, 'tujuan', '-') }}</td>
                                        <td>
                                            <a href="{{ $actionUrl }}" class="finish-link">
                                                {{ data_get($queue, 'action_label', 'Finish') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            Belum ada data antrian untuk ditampilkan.
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>
</html>
