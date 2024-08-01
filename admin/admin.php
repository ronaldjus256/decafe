<?php
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["role"] != "admin") {
  header("Location: ../index.php");
  exit();
}

$username = $_SESSION["username"]
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
</head>
<body>
  <h1>Welcome, Admin <?php echo $username; ?></h1>
  <p>Admin-spesific content goes here.</p>
  <a href="index.php">Index</a>
</body>
</html>
