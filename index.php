<?php
include("koneksi.php");

session_start();

    if(isset($_GET['hal']) && $_GET['hal'] == "hapus"){
        $nomeja = $_GET['nomeja'];
        $hapus = mysqli_query($koneksi, "DELETE FROM pemesanan WHERE nomeja = '$_GET[nomeja]'");

        if($hapus){
            echo  "<script>
            alert('hapus data sukses!');
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
    <title>Sistem Reservasi Sederhana</title>
</head>
<body>
<nav class="navbar bg-primary border-bottom border-body" data-bs-theme="dark">
  <!-- Navbar content -->
<nav class="navbar bg-body-tertiary">
<div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="image/kafe sukses dipa logo.jpeg" alt="Logo" width="35" height="30" class="d-inline-block align-text-top">
      Kafe Sukses Dipa
    </a>
</div>
</nav>
</nav>
<nav class="navbar navbar-expand-lg bg-body-tertiary" class="navbar" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login1.php">Login</a>
        </li>
        <li class="nav-item dropdown">
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-disabled="true" href="register.php">Register</a>
        </li>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="logout.php">LogOut</a>
          </li>
        </ul>
      </ul>
    </div>
  </div>
</nav>

    <div class="container mt-3">
    <table class="table table-bordered">
        <thead class="table-danger">
        <tr>
            <th>No</th>
            <th>No Meja</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Makanan</th>
            <th>Minuman</th>
            <th>Aksi</th>
        </tr>
        </thead>

        <?php
        $no = 1;
        $tampil = mysqli_query($koneksi, "SELECT * FROM pemesanan");

        if ($tampil && mysqli_num_rows($tampil) > 0) {
            while ($data = mysqli_fetch_array($tampil)) {
        ?>

        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($data['nomeja']);?></td>
            <td><?= htmlspecialchars($data['nama']);?></td>
            <td><?= htmlspecialchars($data['tgl']);?></td>
            <td><?= htmlspecialchars($data['waktu']);?></td>
            <td><?= htmlspecialchars($data['makanan']);?></td>
            <td><?= htmlspecialchars($data['minuman']);?></td>


            <td>
                <a href="update.php?hal=edit&nomeja=<?= htmlspecialchars($data['nomeja']); ?>" class="btn btn-info">Edit</a>
                <a href="index.php?hal=hapus&nomeja=<?= htmlspecialchars($data['nomeja'] );?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>

        <?php
            }
        } else {
            echo "<tr><td colspan='8'>Tidak ada data.</td></tr>";
        }
        ?>
    </table>
    </div>


</body>
</html>
