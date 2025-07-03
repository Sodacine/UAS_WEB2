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
if (isset($_POST['edit'])) {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], 'gambar/' . $gambar);
        $query = "UPDATE products 
            SET nama_produk = '$nama_produk', harga = '$harga', deskripsi = '$deskripsi', gambar = '$gambar' 
            WHERE id = '$id'
        ";
    } else {
        $query = "UPDATE products SET nama_produk = '$nama_produk', harga = '$harga', deskripsi = '$deskripsi' 
                    WHERE id = '$id'
                ";
    }

    if ($conn->query($query) === TRUE) {
        echo "Produk berhasil diedit!";
    } else {
        echo "Produk gagal diedit: " . $conn->error;
    }
    $conn->close(); // Tutup koneksi 
    header("Location: produk.php");
}
$conn->close(); // Tutup koneksi 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <p><a href="produk.php">Kembali</a></p>
    <form action="" method="post" enctype="multipart/form-data">
    <label>Nama Produk:</label>
    <input type="text" name="nama_produk" value="<?php echo $row['nama_produk']; ?>"><br><br>
    <label>Harga:</label>
    <input type="number" name="harga" value="<?php echo $row['harga']; ?>"><br><br>
    <label>Deskripsi:</label>
    <textarea name="deskripsi"><?php echo $row['deskripsi']; ?></textarea><br><br>
    <label>Gambar:</label>
    <input type="file" name="gambar"><br><br>
    <img src="<?php echo 'gambar/'.$row['gambar']; ?>" alt="Gambar Produk"><br><br>
    <input type="submit" name="edit" value="Edit Produk">
</form>    
</body>
</html>

