<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

include 'koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM products WHERE id = '$id'";
if ($conn->query($query) === TRUE) {
    echo "Produk berhasil dihapus!";
} else {
    echo "Produk gagal dihapus: " . $conn->error;
}
$conn->close(); // Tutup koneksi 
header("Location: produk.php");
?>