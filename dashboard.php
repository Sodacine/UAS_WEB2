<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">Dashboard Admin</div>
    <div class="container">
        <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
        <a href="produk.php">Lihat Produk</a> |
        <a href="tambah_produk.php">Tambah Produk</a> |
        <a href="laporan_pdf.php" target="_blank">Cetak Laporan PDF</a> |
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>


