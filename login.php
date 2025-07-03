<?php
include 'koneksi.php';
session_start();
$errMsg = '';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $errMsg = "Password salah!";
        }
    } else {
        $errMsg = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">Login Admin</div>
    <div class="container">
    <form action="" method="post">
        <h2 style="text-align:center;margin-bottom:18px;">Login</h2>
        <?php if($errMsg): ?><div style="color:#ff7043;text-align:center;margin-bottom:10px;"><b><?= $errMsg ?></b></div><?php endif; ?>
        <label>Username:</label>
        <input type="text" name="username" required autofocus><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
    <p style="text-align:center;margin-top:18px;">Belum punya akun? <a href="registrasi.php">Register</a></p>
    </div>
</body>
</html>


