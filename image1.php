<?php
include "koneksi.php";
session_start();

// Pastikan user sudah login
if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit();
}

// Ambil data menu dari database
$sql = "SELECT * FROM menu";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
  <style>
    .menu-item {
      border: 1px solid #ddd;
      padding: 10px;
      margin-bottom: 20px;
      text-align: center;
    }

    .menu-item img {
      max-width: 200px;
      height: auto;
    }

    .quantity-control {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 10px;
    }

    .quantity-control button {
      font-size: 18px;
      padding: 5px 10px;
      margin: 0 5px;
    }

    .quantity-control input {
      width: 50px;
      text-align: center;
    }
  </style>
</head>

<body>
  <h1>Menu</h1>
  <table border=2>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Gambar</th>
        <th>Harga</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["nama"] . "</td>";
          echo "<td>" . $row["gambar_id"] . "</td>";
          echo "<td>Rp " . number_format($row["harga"], 0, ',', '.') . "</td>";
          echo "<td>
                            <div class='quantity-control'>
                                <button onclick='decreaseQuantity(" . $row["id"] . ")'>-</button>
                                <input type='number' id='quantity-" . $row["id"] . "' value='0' min='0' readonly>
                                <button onclick='increaseQuantity(" . $row["id"] . ")'>+</button>
                            </div>
                          </td>";
          echo "<td><button onclick='addToReservation(" . $row["id"] . ")'>Reservasi</button></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='5'>Tidak ada menu tersedia.</td></tr>";
      }
      ?>
      <a href="reserve.php"><button class="btn btn-primary">Tambah Data</button></a>
    </tbody>
  </table>

  <?php
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<div class='menu-item'>";
      echo "<h2>" . $row["nama"] . "</h2>";
      echo "<img src='" . $row["gambar"] . "' alt='" . $row["nama"] . "'>";
      echo "<p>Harga: Rp " . number_format($row["harga"], 0, ',', '.') . "</p>";
      echo "<div class='quantity-control'>";
      echo "<button onclick='decreaseQuantity(" . $row["id"] . ")'>-</button>";
      echo "<input type='number' id='quantity-" . $row["id"] . "' value='0' min='0'>";
      echo "<button onclick='increaseQuantity(" . $row["id"] . ")'>+</button>";
      echo "</div>";
      echo "<button onclick='addToReservation(" . $row["id"] . ")'>Reservasi</button>";
      echo "</div>";
    }
  }
  ?>

  <script>
    function decreaseQuantity(id) {
      var input = document.getElementById('quantity-' + id);
      var value = parseInt(input.value, 10);
      if (value > 0) {
        input.value = value - 1;
      }
    }

    function increaseQuantity(id) {
      var input = document.getElementById('quantity-' + id);
      var value = parseInt(input.value, 10);
      input.value = value + 1;
    }

    function addToReservation(id) {
      var quantity = document.getElementById('quantity-' + id).value;
      if (quantity > 0) {
        window.location.href = 'reserve.php?id=' + id + '&quantity=' + quantity;
      } else {
        alert('Silakan pilih jumlah terlebih dahulu.');
      }
    }
  </script>
</body>

</html>
