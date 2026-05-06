<?php
require_once 'config/database.php';

$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = trim($_POST['nama_barang'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $jumlah = $_POST['jumlah'] ?? '';
    $harga = $_POST['harga'] ?? '';
    $lokasi = trim($_POST['lokasi'] ?? '');

    if (!empty($nama_barang) && !empty($kategori) && !empty($lokasi) && is_numeric($jumlah) && is_numeric($harga)) {
        $stmt = $pdo->prepare("INSERT INTO barang (nama_barang, kategori, jumlah, harga, lokasi) VALUES (:nama, :kategori, :jumlah, :harga, :lokasi)");
        $stmt->execute([
            ':nama' => $nama_barang,
            ':kategori' => $kategori,
            ':jumlah' => $jumlah,
            ':harga' => $harga,
            ':lokasi' => $lokasi
        ]);
        header("Location: index.php?status=added");
        exit;
    } else {
        $pesan = "Semua field wajib diisi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 600px;">
    <h2>Tambah Barang</h2>
    <?php if ($pesan): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga (Rp)</label>
            <input type="number" step="0.01" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>