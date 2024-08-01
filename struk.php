<?php
include("koneksi.php");

// Ambil nomor meja dari URL
$nomeja = isset($_GET['nomeja']) ? $_GET['nomeja'] : 0;

// Query untuk mendapatkan data pemesanan berdasarkan nomor meja
$query = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE nomeja = $nomeja");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
        }
        .receipt-header, .receipt-footer {
            text-align: center;
        }
        .receipt-item {
            display: flex;
            justify-content: space-between;
        }
        .receipt-total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="receipt-header">
        <h2>Struk Pembelian</h2>
    </div>
    <div class="receipt-details">
        <div class="receipt-item">
            <span>No Meja:</span>
            <span><?php echo htmlspecialchars($data['nomeja']); ?></span>
        </div>
        <div class="receipt-item">
            <span>Nama:</span>
            <span><?php echo htmlspecialchars($data['nama']); ?></span>
        </div>
        <div class="receipt-item">
            <span>Tanggal:</span>
            <span><?php echo htmlspecialchars($data['tgl']); ?></span>
        </div>
        <div class="receipt-item">
            <span>Waktu:</span>
            <span><?php echo htmlspecialchars(date('H:i:s', strtotime($data['waktu']))); ?></span>
        </div>
        <div class="receipt-item">
            <span>Makanan:</span>
            <span><?php echo htmlspecialchars($data['makanan']); ?></span>
        </div>
        <div class="receipt-item">
            <span>Minuman:</span>
            <span><?php echo htmlspecialchars($data['minuman']); ?></span>
        </div>
    </div>
    <div class="receipt-footer">
        <p>Terima kasih telah berbelanja!</p>
        <a href="pembayaran.php?nomeja=<?php echo $nomeja; ?>" class="btn btn-success">Lanjut ke Pembayaran</a>
    </div>
</body>
</html>