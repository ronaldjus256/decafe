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

// Simulasi harga makanan dan minuman
$total_harga = 0;

// Contoh: menghitung harga makanan dan minuman
$makanan_list = explode(',', $data['makanan']);
$minuman_list = explode(',', $data['minuman']);

foreach ($makanan_list as $makanan) {
    // Misalnya, setiap makanan dihargai 50.000
    $total_harga += 50000;
}

foreach ($minuman_list as $minuman) {
    // Misalnya, setiap minuman dihargai 20.000
    $total_harga += 20000;
}

// Jika tombol bayar ditekan
if (isset($_POST['bayar'])) {
    // Update status menjadi 'Paid'
    $update = mysqli_query($koneksi, "UPDATE pemesanan SET status = 'Paid' WHERE nomeja = $nomeja");
    if ($update) {
        echo "<script>
        alert('Pembayaran berhasil!');
        document.location='index.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
        }
        .payment-details {
            display: flex;
            justify-content: space-between;
        }
        .payment-footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="payment-header">
        <h2>Detail Pembayaran</h2>
    </div>
    <div class="payment-details">
        <div class="payment-item">
            <span>Total Harga:</span>
            <span><?php echo number_format($total_harga, 0, ',', '.'); ?> IDR</span>
        </div>
    </div>
    <div class="payment-footer">
        <form method="POST">
            <button type="submit" name="bayar" class="btn btn-success">Bayar</button>
        </form>
    </div>
</body>
</html>
