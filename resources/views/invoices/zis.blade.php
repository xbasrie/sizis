<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice ZIS - {{ $record->order_id ?? $record->id }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            color: #1f2937;
            margin: 0;
            padding: 40px;
            font-size: 14px;
            line-height: 1.5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #e5e7eb;
            padding: 40px;
            border-radius: 8px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #ff7300; /* Lazismu Orange */
        }

        .logo img {
            height: 72px;
            width: auto;
        }

        .company-info {
            text-align: right;
        }

        .company-name {
            font-weight: 700;
            font-size: 18px;
            color: #ff7300;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .company-address {
            font-size: 12px;
            color: #6b7280;
        }

        .invoice-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .invoice-title h1 {
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
            color: #111827;
        }

        .invoice-title p {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .detail-box h3 {
            font-size: 12px;
            text-transform: uppercase;
            color: #6b7280;
            font-weight: 600;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 8px;
        }

        .detail-label {
            width: 120px;
            font-weight: 600;
            color: #374151;
        }

        .detail-value {
            flex: 1;
            color: #111827;
        }

        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .transaction-table th {
            text-align: left;
            padding: 12px 16px;
            background-color: #f9fafb;
            color: #374151;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .transaction-table td {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            color: #111827;
        }

        .transaction-table tr:last-child td {
            border-bottom: none;
        }

        .amount-row {
            font-weight: 700;
            font-size: 16px;
            color: #ff7300;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
            text-align: center;
        }

        .signature-box {
            width: 200px;
        }

        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #374151;
            padding-top: 5px;
            font-weight: 600;
        }

        @media print {
            body { padding: 0; margin: 0; }
            .container { border: none; padding: 20px; max-width: 100%; }
            .header { border-bottom-color: #000; }
            .company-name { color: #000; }
            .amount-row { color: #000; }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <div class="logo">
                <!-- Pastikan path logo sesuai dengan struktur folder public Anda -->
                <img src="{{ asset('assets/images/logo-lazismu-WAGE-.png') }}" alt="Lazismu Logo">
            </div>
            <div class="company-info">
                <div class="company-name">Lazismu Unit Layanan Wage</div>
                <div class="company-address">
                    Gedung Pusat Dakwah Muhammadiyah<br>
                    Jl. Menteng Raya No.62, Jakarta Pusat<br>
                    Telp: 021-3150400 | Email: info@lazismu.org
                </div>
            </div>
        </div>

        <div class="invoice-title">
            <h1>Bukti Penerimaan ZIS</h1>
            <p>No. Transaksi: #{{ $record->order_id ?? $record->id }}</p>
        </div>

        <div class="details-grid">
            <div class="detail-box">
                <h3>Data Donatur</h3>
                <div class="detail-row">
                    <span class="detail-label">Nama</span>
                    <span class="detail-value">{{ $record->nama ?? $record->donatur->nama ?? 'Hamba Allah' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Alamat</span>
                    <span class="detail-value">{{ $record->alamat ?? $record->donatur->alamat ?? '-' }}</span>
                </div>
                 <div class="detail-row">
                    <span class="detail-label">No. Tlp</span>
                    <span class="detail-value">{{ $record->tlp ?? $record->donatur->notlp ?? '-' }}</span>
                </div>
            </div>
            <div class="detail-box">
                <h3>Detail Transaksi</h3>
                <div class="detail-row">
                    <span class="detail-label">Tanggal</span>
                    <span class="detail-value">{{ $record->created_at->format('d F Y H:i') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Amil</span>
                    <span class="detail-value">{{ $record->amil->nama_amil ?? 'Online System' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Pembayaran</span>
                    <span class="detail-value">{{ $record->rekening->bank ?? 'Manual Transfer' }}</span>
                </div>
            </div>
        </div>

        <table class="transaction-table">
            <thead>
                <tr>
                    <th>Keterangan</th>
                    <th style="text-align: right;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $record->kategoriZis->kategori ?? 'ZIS' }} - {{ $record->kategoriZis->jenis ?? 'Umum' }}</strong><br>
                        <span style="font-size: 12px; color: #6b7280;">{{ $record->keterangan ?? '-' }}</span>
                    </td>
                    <td style="text-align: right;" class="amount-row">
                        Rp {{ number_format($record->uang, 0, ',', '.') }}
                    </td>
                </tr>
                @if($record->beras > 0)
                <tr>
                    <td>Beras</td>
                    <td style="text-align: right;">{{ $record->beras }} Kg</td>
                </tr>
                @endif
            </tbody>
        </table>

        <div class="signature-section">
            <div class="signature-box">
                <p>Penyetor,</p>
                <div class="signature-line">{{ $record->nama ?? 'Donatur' }}</div>
            </div>
            <div class="signature-box">
                <p>Penerima,</p>
                <div class="signature-line">{{ $record->amil->nama_amil ?? 'Lazismu Wage' }}</div>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda menyalurkan ZIS melalui Lazismu.<br>
            <i>"Ambillah zakat dari sebagian harta mereka, dengan zakat itu kamu membersihkan dan mensucikan mereka..." (QS. At-Taubah: 103)</i></p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>