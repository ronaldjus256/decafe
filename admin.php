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
  <style>
    /* Reset some basic elements */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Style the body */
body {
    background-color: #f2f2f2;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 100px; /* Add padding to prevent content from being hidden behind the fixed header */
}

/* Style the fixed header container */
.header {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    padding: 20px;
    text-align: center;
}

/* Style the container with a background image */
.container {
    text-align: center;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    width: 100%;
    margin-top: 20px; /* Adjust margin to align with header */
    background-image: url('image/gambar 5.jpeg');
    background-size: cover;
    background-position: center;
}

/* Style the headings */
h1 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

/* Style the paragraph */
p {
    margin-bottom: 20px;
    font-size: 18px;
    color: #666;
}

/* Style the link as a button */
a {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
}

/* Add hover effect to the button */
a:hover {
    background-color: #0056b3;
}

  </style>
  <title>Admin Dashboard</title>
</head>
<body>
  <h1>Welcome, Admin <?php echo $username; ?></h1>
  <p>Admin-spesific content goes here.</p>
  <a href="index.php">Index</a><br>
  <img src="image/gambar 5.jpeg" width="50%" height="auto">
</body>
</html>
