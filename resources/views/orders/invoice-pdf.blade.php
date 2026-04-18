<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran #{{ $order->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
        }
        .container {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #2563eb;
            font-size: 28px;
            margin-bottom: 5px;
        }
        .header p {
            color: #666;
            font-size: 12px;
        }
        .invoice-info {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .invoice-info-left, .invoice-info-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .invoice-info-right {
            text-align: right;
        }
        .invoice-label {
            font-weight: bold;
            color: #2563eb;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .invoice-number {
            font-size: 20px;
            font-weight: bold;
            color: #1e40af;
        }
        .section {
            margin-bottom: 13px;
        }
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #2563eb;
            text-transform: uppercase;
            margin-top: 15px;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        .info-row {
            margin-bottom: 8px;
            font-size: 13px;
        }
        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 180px;
            color: #333;
        }
        .info-value {
            display: inline;
            color: #333;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-pending {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .status-completed {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .buyer-info {
            margin-bottom: 8px;
            font-size: 13px;
        }
        .buyer-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 3px;
        }
        .buyer-value {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table thead {
            background-color: #2563eb;
            color: white;
        }
        table th {
            padding: 10px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        table th.center {
            text-align: center;
        }
        table th.right {
            text-align: right;
        }
        table tbody td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 12px;
        }
        table tbody td.center {
            text-align: center;
        }
        table tbody td.right {
            text-align: right;
        }
        .product-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
        }
        .summary-section {
            margin-top: 25px;
            text-align: right;
        }
        .summary-row {
            margin-bottom: 8px;
            font-size: 13px;
        }
        .summary-label {
            display: inline-block;
            width: 150px;
            text-align: right;
            font-weight: 600;
            color: #333;
            margin-right: 20px;
        }
        .summary-value {
            display: inline-block;
            width: 150px;
            text-align: right;
            color: #333;
        }
        .total-section {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
            text-align: right;
        }
        .total-label {
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            color: #2563eb;
            text-transform: uppercase;
            margin-right: 20px;
        }
        .total-value {
            display: inline-block;
            font-size: 20px;
            font-weight: bold;
            color: #2563eb;
            width: 150px;
            text-align: right;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 11px;
        }
        .footer p {
            margin-bottom: 5px;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .info-cell {
            display: table-cell;
            width: 50%;
            padding-right: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>MEDIA-TECH</h1>
            <p>Toko Elektronik Terpercaya</p>
            <p>Email: info@media-tech.com | Telp: (021) 1234-5678</p>
        </div>

        <!-- Invoice Info -->
        <div class="invoice-info">
            <div class="invoice-info-left">
                <div class="invoice-label">Nota</div>
                <div class="invoice-number">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="invoice-info-right">
                <div style="color: #666; font-size: 12px;">
                    {{ $order->placed_on->format('d F Y') }} WIB
                </div>
            </div>
        </div>

        <!-- Transaction Info -->
        <div style="margin-bottom: 25px;">
            <div class="info-row">
                <span class="info-label">Tanggal:</span>
                <span class="info-value">{{ $order->placed_on->format('d F Y') }} WIB</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                @if($order->payment_status == 'pending')
                    <span class="status-badge status-pending">Pending</span>
                @elseif($order->payment_status == 'completed')
                    <span class="status-badge status-completed">Selesai</span>
                @elseif($order->payment_status == 'cancelled')
                    <span class="status-badge status-cancelled">Dibatalkan</span>
                @endif
            </div>
            <div class="info-row">
                <span class="info-label">Metode Pembayaran:</span>
                <span class="status-badge status-pending">{{ strtoupper($order->method) }}</span>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="section">
            <div class="section-title">INFORMASI PEMBELI</div>
            <div class="buyer-info">
                <div class="buyer-label">Nama:</div>
                <div class="buyer-value">{{ $order->name }}</div>
            </div>
            <div class="buyer-info">
                <div class="buyer-label">Email:</div>
                <div class="buyer-value">{{ $order->email }}</div>
            </div>
            <div class="buyer-info">
                <div class="buyer-label">No. Telepon:</div>
                <div class="buyer-value">{{ $order->number }}</div>
            </div>
            <div class="buyer-info">
                <div class="buyer-label">Alamat:</div>
                <div class="buyer-value">{{ $order->address }}</div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="section">
            <div class="section-title">DETAIL PRODUK</div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 40px;">NO</th>
                        <th>NAMA PRODUK</th>
                        <th class="center" style="width: 100px;">JUMLAH</th>
                        <th class="right" style="width: 130px;">HARGA SATUAN</th>
                        <th class="right" style="width: 130px;">SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $products = explode(', ', $order->total_products);
                        $totalItems = 0;
                    @endphp
                    @foreach($products as $index => $product)
                        @php
                            preg_match('/(.+?)\s*\((\d+)\)/', $product, $matches);
                            $productName = $matches[1] ?? $product;
                            $quantity = isset($matches[2]) ? (int)$matches[2] : 1;
                            $totalItems += $quantity;
                            
                            // Estimasi harga satuan berdasarkan total
                            $estimatedUnitPrice = count($products) > 0 ? $order->total_price / $totalItems : 0;
                            $subtotal = $estimatedUnitPrice * $quantity;
                        @endphp
                        <tr>
                            <td class="center">{{ $index + 1 }}</td>
                            <td>
                                <div class="product-name">{{ $productName }}</div>
                            </td>
                            <td class="center">{{ $quantity }} item</td>
                            <td class="right">Rp {{ number_format($estimatedUnitPrice, 0, ',', '.') }}</td>
                            <td class="right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="summary-section">
            <div class="summary-row">
                <span class="summary-label">Subtotal:</span>
                <span class="summary-value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Biaya Admin:</span>
                <span class="summary-value">Rp 0</span>
            </div>
        </div>

        <!-- Total -->
        <div class="total-section">
            <span class="total-label">Total Pembayaran:</span>
            <span class="total-value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Terima kasih telah berbelanja di Media-Tech!</strong></p>
            <p>Dokumen ini adalah nota resmi yang dihasilkan secara otomatis</p>
            <p>Untuk pertanyaan, silakan hubungi customer service kami</p>
        </div>
    </div>
</body>
</html>
