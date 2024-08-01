<?php
include("koneksi.php");

if(isset($_GET['hal']) && $_GET['hal'] == "edit") {
    $tampil = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE nomeja = '$_GET[nomeja]'");
    $data = mysqli_fetch_assoc($tampil);
    if ($data) {
        $nomeja = $data['nomeja'];
        $nama = $data['nama'];
        $tgl = $data['tgl'];
        $waktu = date('H:i', strtotime($data['waktu']));
        $makanan = $data['makanan'];
        $minuman = $data['minuman'];
    }
}

if (isset($_POST['update'])) {
    $nomeja = $_POST['nomeja'];
    $nama = $_POST['nama'];
    $tgl = $_POST['tgl'];
    $waktu = $_POST['time'];
    $timestamp = date('Y-m-d H:i:s', strtotime("$tgl $waktu"));
    $makanan = $_POST['makanan'];
    $minuman = $_POST['minuman'];

    $simpan = mysqli_query($koneksi, "UPDATE pemesanan SET
                                    nomeja = '$nomeja',
                                    nama = '$nama',
                                    tgl = '$tgl',
                                    waktu = '$timestamp',
                                    makanan = '$makanan',
                                    minuman = '$minuman'
                                    WHERE nomeja = '$nomeja'
                                    ");

    if ($simpan) {
        echo "<script>
        alert('Edit data Sukses!');
        document.location='index.php';
        </script>";
    } else {
        echo "<script>
        alert('Edit data Gagal!');
        document.location='index.php';
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
    <title>Edit Data Pelanggan</title>
</head>
<body>
    <div class="container mt-3">
        <h2 class="mb-10 text-center">Edit Data Pelanggan</h2>
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="p-4 border rounded bg-light col-9 row mt-1">
                <div class="form-group">
                    <form method="POST">
                        <div class="mb-3 mt-3 col-12">
                            <label class="form-label">No Meja</label>
                            <input type="number" name="nomeja" value="<?= isset($nomeja) ? $nomeja : '' ?>" class="form-control" placeholder="Input No Meja Anda disini" required>
                        </div>
                        <div class="mb-3 mt-3 col-12">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" value="<?= isset($nama) ? $nama : '' ?>" class="form-control" placeholder="Input Nama Anda disini" required>
                        </div>
                        <div class="mb-3 mt-3 col-12">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tgl" value="<?= isset($tgl) ? $tgl : '' ?>" class="form-control" placeholder="YYY-MM-DD" required>
                        </div>
                        <div class="mb-3 mt-3 col-12">
                            <label class="form-label">Waktu</label>
                            <input type="time" name="time" value="<?= isset($waktu) ? $waktu : '' ?>" class="form-control" placeholder="Input Waktu Pemesanan Anda disini" required>
                        </div>
                        <div class="mb-3 mt-3 col-12">
                            <label class="form-label">Makanan</label>
                            <select class="form-control" name="makanan">
                                <option value="<?= isset($makanan) ? $makanan : '' ?>"><?= isset($makanan) ? $makanan : '' ?></option>
                                <option>Pilih Paket Makanan Anda</option>
                                <option value="Paket Panas 1">Paket Panas 1</option>
                                <option value="Paket Panas 2">Paket Panas 2</option>
                                <option value="Paket Panas 3">Paket Panas 3</option>
                                <option value="Paket Panas 4">Paket Panas 4</option>
                                <option value="Paket Panas 5">Paket Panas 5</option>
                            </select>
                        </div>
                        <div class="mb-3 mt-3 col-12">
                            <label class="form-label">Minuman</label>
                            <select class="form-control" name="minuman">
                                <option value="<?= isset($minuman) ? $minuman : '' ?>"><?= isset($minuman) ? $minuman : '' ?></option>
                                <option>Pilih Paket Minuman Anda</option>
                                <option value="Paket Minuman 1">Paket Minuman 1</option>
                                <option value="Paket Minuman 2">Paket Minuman 2</option>
                                <option value="Paket Minuman 3">Paket Minuman 3</option>
                                <option value="Paket Teh">Paket Teh</option>
                                <option value="Paket Kopi">Paket Kopi</option>
                            </select>
                        </div>
                        <div><br>
                            <button type="submit" class="btn btn-warning" name="update">Update</button>
                            <a class="btn btn-primary" href="index.php">Kembali</a><br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
