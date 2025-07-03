<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    include 'koneksi.php';
    if ($search !== '') {
        $query = "SELECT * FROM products WHERE nama_produk LIKE '%".mysqli_real_escape_string($conn, $search)."%' OR deskripsi LIKE '%".mysqli_real_escape_string($conn, $search)."%' ORDER BY id DESC";
    } else {
        $query = "SELECT * FROM products ORDER BY id DESC";
    }
    $result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">Manajemen Produk</div>
    <div class="container">
    <form method="get" style="max-width:400px;margin:0 auto 24px auto;display:flex;gap:8px;">
        <input type="text" name="search" placeholder="Cari produk atau deskripsi..." value="<?= htmlspecialchars($search) ?>" style="flex:1;">
        <button type="submit">Cari</button>
    </form>
    <a href="dashboard.php">Dashboard</a> |
    <a href="tambah_produk.php">Tambah Produk</a>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
            <tr style="text-align:center;">
                <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['deskripsi'])); ?></td>
                <td>Rp <?php echo number_format($row['harga'],0,',','.'); ?></td>
                <td>
                    <img src="<?php echo 'gambar/'.htmlspecialchars($row['gambar']); ?>" alt="" >
                </td>
                <td>
                    <a href='edit_produk.php?id=<?php echo $row['id']; ?>'>Edit</a> | <a href='delete_produk.php?id=<?php echo $row['id']; ?>' onclick="return confirm('Yakin hapus produk?')">Delete</a>
                </td>
            </tr>
            <?php }
            } else {?>
            <tr><td colspan="5" style="color:#ff7043;font-weight:bold;text-align:center;">Produk tidak ditemukan.</td></tr>
            <?php } 
                $conn->close();
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>
