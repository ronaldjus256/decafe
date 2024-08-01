<?php
include("koneksi.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Email']) && isset($_POST['Password'])) {
        $Email = $koneksi->real_escape_string($_POST['Email']);
        $Password = $_POST['Password'];

        $sql = "SELECT ID, Nama, Password, is_admin FROM login WHERE Email = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($Password, $row['Password'])) {
                $_SESSION['user_id'] = $row['ID'];
                $_SESSION['user_nama'] = $row['Nama'];
                $_SESSION['role'] = $row['role'];
                if ($row['role'] == "admin") {
                    header("Location: image.php");
                } else {
                    header("Location: index.php");
                }
                exit();
            } else {
                $error_message = "Email atau password salah!";
            }
        } else {
            $error_message = "Email tidak ditemukan!";
        }
        $stmt->close();
    } else {
        $error_message = "Mohon isi email dan password!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <title>Login</title>
    <style>
        .min-vh-100 {
            min-height: 100vh !important;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center bg-warning  min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Login</h1>
                        <?php
                        if (isset($error_message)) {
                            echo "<div class='alert alert-danger' role='alert'>" . $error_message . "</div>";
                        }
                        ?>
                        <form method="POST" action="login.php">
                            <div class="form-group">
                                <label for="Email">Email:</label>
                                <input type="email" id="Email" name="Email" class="form-control" placeholder="Input Email Anda" required>
                            </div><br>
                            <div class="form-group">
                                <label for="Password">Password:</label>
                                <input type="password" id="Password" name="Password" class="form-control" placeholder="Input Password Anda" required>
                            </div><br>
                            <div>
                            <button type="submit" class="btn btn-primary btn-block"">Login</button>
                            </div>
                        </form>
                        <p class="mt-3">Belum punya akun? <a href="register.php" class="btn btn-primary">Daftar di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
