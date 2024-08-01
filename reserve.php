<?php
include("koneksi.php");

if (isset($_POST['simpan'])) {
    // mengambil data dari form dan mengamankannya menggunakan mysqli_real_escape_string
    $nomeja = mysqli_real_escape_string($koneksi, $_POST['nomeja']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tgl = mysqli_real_escape_string($koneksi, $_POST['date']);
    $waktu = mysqli_real_escape_string($koneksi, $_POST['time']);
    $makanan = mysqli_real_escape_string($koneksi, $_POST['makanan']);
    $minuman = mysqli_real_escape_string($koneksi, $_POST['minuman']);

    // Mengonversi tanggal dan waktu ke format timestamp
    $timestamp = date('Y-m-d H:i:s', strtotime("$tgl $waktu"));

    // Query untuk menyimpan data kedalam tabel pemesanan
    $simpan = mysqli_query($koneksi, "INSERT INTO pemesanan (nomeja, nama, tgl, waktu, makanan, minuman) VALUES ('$nomeja', '$nama', '$tgl', '$timestamp', '$makanan', '$minuman')");

    // Tampilkan data debugging
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    if ($simpan) {
        $nomeja = mysqli_insert_id($koneksi);
        echo "<script>
        alert('Simpan data sukses!');
        document.location='dashboard.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
        echo "<script>
        alert('Simpan data gagal!');
        document.location='reserve.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <title>Reserve</title>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Make a Reservation</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group mb-3">
                            <label for="nomeja">No Meja:</label>
                            <input type="number" id="nomeja" name="nomeja" class="form-control" placeholder="Input No Meja Anda disini" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama">Nama:</label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Input Nama Anda disini" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="date">Date:</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="time">Time:</label>
                            <input type="time" id="time" name="time" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="makanan">Makanan:</label>
                            <input type="text" id="makanan" name="makanan" class="form-control" placeholder="Input Makanan Anda Disini" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="minuman">Minuman:</label>
                            <input type="text" id="minuman" name="minuman" class="form-control" placeholder="Input Minuman Anda Disini" required>
                        </div>
                        <button type="submit" name="simpan" class="btn btn-success">Confirm</button>
                        <a class="btn btn-primary" href="dashboard.php">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
