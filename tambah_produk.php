<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($ext, $allowed)) {
        $newName = uniqid('img_', true) . '.' . $ext;
        $path = 'gambar/' . $newName;
        // Resize image
        list($w, $h) = getimagesize($tmp_name);
        $maxDim = 500;
        $ratio = $w / $h;
        if ($w > $maxDim || $h > $maxDim) {
            if ($ratio > 1) {
                $new_w = $maxDim;
                $new_h = $maxDim / $ratio;
            } else {
                $new_w = $maxDim * $ratio;
                $new_h = $maxDim;
            }
        } else {
            $new_w = $w;
            $new_h = $h;
        }
        $dst = imagecreatetruecolor($new_w, $new_h);
        if ($ext == 'jpg' || $ext == 'jpeg') {
            $src = imagecreatefromjpeg($tmp_name);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
            imagejpeg($dst, $path);
        } elseif ($ext == 'png') {
            $src = imagecreatefrompng($tmp_name);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
            imagepng($dst, $path);
        } elseif ($ext == 'gif') {
            $src = imagecreatefromgif($tmp_name);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
            imagegif($dst, $path);
        }
        imagedestroy($dst);
        if (isset($src)) imagedestroy($src);
        $gambar_db = $newName;
        $query = "INSERT INTO products (nama_produk, harga, deskripsi, gambar) VALUES ('$nama_produk', '$harga', '$deskripsi', '$gambar_db')";
        if ($conn->query($query) === TRUE) {
            echo "Produk berhasil ditambahkan!";
        } else {
            echo "Produk gagal ditambahkan: " . $conn->error;
        }
        $conn->close();
        header("Location: produk.php");
        exit;
    } else {
        echo "Format gambar tidak didukung!";
    }
}
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">Tambah Produk</div>
    <div class="container">
    <p><a href="produk.php">Kembali</a></p>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Nama Produk:</label>
        <input type="text" name="nama_produk" required><br><br>
        <label>Harga:</label>
        <input type="number" name="harga" required><br><br>
        <label>Deskripsi:</label>
        <textarea name="deskripsi" required></textarea><br><br>
        <label>Gambar:</label>
        <input type="file" name="gambar" accept="image/*" required><br><br>
        <input type="submit" name="tambah" value="Tambah Produk">
    </form>
    </div>
</body>
</html>
