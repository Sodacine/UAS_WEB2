<?php
// index.php - Halaman utama foodcourt (tamu umum)
require 'koneksi.php';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($search !== '') {
    $produk = mysqli_query($conn, "SELECT * FROM products WHERE nama_produk LIKE '%".mysqli_real_escape_string($conn, $search)."%' OR deskripsi LIKE '%".mysqli_real_escape_string($conn, $search)."%' ORDER BY id DESC");
} else {
    $produk = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodcourt - Daftar Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">Foodcourt - Daftar Produk</div>
    <div class="container">
        <form method="get" style="max-width:400px;margin:0 auto 24px auto;display:flex;gap:8px;">
            <input type="text" name="search" placeholder="Cari produk atau deskripsi..." value="<?= htmlspecialchars($search) ?>" style="flex:1;">
            <button type="submit">Cari</button>
        </form>
        <div class="products">
            <?php if(mysqli_num_rows($produk) > 0): while($row = mysqli_fetch_assoc($produk)): ?>
            <div class="product-card">
                <img src="gambar/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>">
                <div class="product-info">
                    <div class="product-title"><?= htmlspecialchars($row['nama_produk']) ?></div>
                    <div class="product-price">Rp <?= number_format($row['harga'],0,',','.') ?></div>
                    <div class="product-desc"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></div>
                </div>
            </div>
            <?php endwhile; else: ?>
            <div style="width:100%;text-align:center;color:#ff7043;font-weight:bold;">Produk tidak ditemukan.</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
