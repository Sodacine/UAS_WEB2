<?php
include 'koneksi.php';
$errMsg = '';
$successMsg = '';
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($query) === TRUE) {
        $successMsg = "Registrasi berhasil! Silakan login.";
    } else {
        $errMsg = "Registrasi gagal: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">Registrasi Admin</div>
    <div class="container">
    <form action="" method="post">
        <h2 style="text-align:center;margin-bottom:18px;">Registrasi</h2>
        <?php if($errMsg): ?><div style="color:#ff7043;text-align:center;margin-bottom:10px;"><b><?= $errMsg ?></b></div><?php endif; ?>
        <?php if($successMsg): ?><div style="color:green;text-align:center;margin-bottom:10px;"><b><?= $successMsg ?></b></div><?php endif; ?>
        <label>Username:</label>
        <input type="text" name="username" required autofocus><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <input type="submit" name="register" value="Register">
    </form>
    <p style="text-align:center;margin-top:18px;">Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
