<?php
$host = "localhost"; // atau 127.0.0.1
$user = "root"; // ganti sesuai user MySQL kamu
$password = ""; // kosongin kalau belum diset
$database = "pemweb"; // ganti dengan nama database kamu

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
?>

