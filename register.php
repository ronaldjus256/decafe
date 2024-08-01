<?php
include "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Validasi panjang password
    if (strlen($password) < 5 || strlen($password) > 15) {
        echo "<script>
        alert('Password harus antara 8 hingga 20 karakter.');
        window.history.back();
        </script>";
        exit();
    }

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO login (username, password, role) VALUES ('$username', '$hashed_password', '$role')";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>
        alert('User baru berhasil ditambahkan');
        document.location.href = 'login1.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/regis.css">
    <style>
      /* Reset some basic elements */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Style the body to center the form */
body {
    background-color: burlywood;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Style the form container */
form {
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

/* Style the form groups */
label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

/* Style the input fields */
input[type="text"], input[type="password"], select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-bottom: 15px;
}

/* Style the submit button */
input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Add hover effect to the submit button */
input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Style the link */
a {
    display: block;
    margin-top: 15px;
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br><br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br><br>
        <label>Role:</label>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <br><br>
        <input type="submit" value="Register">
        <a href="login1.php"> Ke login</a>
    </form>
</body>
</html>

