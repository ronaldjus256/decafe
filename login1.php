<?php
include "koneksi.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM login WHERE username='$username'";
  $result = $koneksi->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])) {
      $_SESSION["username"] = $username;
      $_SESSION["role"] = $row["role"];
      if ($row["role"] == "admin") {
        //Login admin
        header("Location: admin.php");
      } else {
        //login user
        header("Location: image.php");
      }
      exit();
    }
  }
  $error = true;
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="css/login.css">
  <style>
    /* Reset some basic elements */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    /* gaya css untuk mempercantik tampilan login */
    body {
      background-color: blue;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    /* gaya  */
    .login-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      text-align: center;
    }

    /* Style the headings */
    h2 {
      margin-bottom: 20px;
      font-size: 24px;
      color: #333;
    }

    /* Style the error message */
    p {
      color: red;
      margin-bottom: 10px;
    }

    /* Style the form groups */
    .input-group {
      margin-bottom: 15px;
      text-align: left;
    }

    /* Style the labels */
    .input-group label {
      display: block;
      margin-bottom: 5px;
      color: #333;
    }

    /* Style the input fields */
    .input-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    /* Style the login button */
    .login-button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #28a745;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    /* Add hover effect to the login button */
    .login-button:hover {
      background-color: #218838;
    }

    /* Style the signup link */
    .signup-link {
      margin-top: 15px;
      color: #333;
    }

    .signup-link a {
      color: #007bff;
      text-decoration: none;
    }

    .signup-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h2>Login</h2>
    <?php if (isset($error)) : ?>
      <p>User name / password salah</p>
    <?php endif; ?>
    <form action="#" method="post">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" name="login" class="login-button">Login</button>
    </form>
    <p class="signup-link">Don't have an account? <a href="register.php">Sign Up</a></p>
  </div>
</body>

</html>
