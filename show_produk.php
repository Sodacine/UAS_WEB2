<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

include 'koneksi.php';

$id = $_GET['id'];

$query = "SELECT * FROM products WHERE id = '$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lihat Product</title>
</head>
<body>
  <h2><?php echo $row['nama_produk']; ?></h2>
  <p>Harga: <?php echo $row['harga']; ?></p> br
  <p>Deskripsi: <?php echo $row['deskripsi']; ?></p>
  <img src="<?php echo $row['gambar']; ?>" alt="Gambar Produk">
</body>
</html>


