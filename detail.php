<?php
require_once 'inc/config.php';
if (!isset($_GET['id'])) die('ID produk tidak diberikan');

$produkModel = new Produk();
$produk = $produkModel->getById($_GET['id']);
if (!$produk) die('Produk tidak ditemukan');

$message = '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Detail Produk</title>
</head>

<body>
  <h1>Detail Produk</h1>
  <p><a href="index.php">Kembali</a></p>
  <ul>
    <li>Id_produk: <?php echo $produk['id_produk']; ?></li>
    <li>Nama: <?php echo Utility::e($produk['nama']); ?></li>
    <li>Harga: <?php echo $produk['harga']; ?></li>
    <li>Stok: <?php echo $produk['stok']; ?></li>
    <li>Kategori: <?php echo Utility::e($produk['kategori']); ?></li>
    <li>Status: <?php echo Utility::e($produk['status']); ?></li>
    <li>Gambar: <?php if ($produk['gambar_path']): ?>
        <img src="uploads/<?php echo Utility::e($produk['gambar_path']); ?>" width="100">
      <?php endif; ?>
    </li>
  </ul>
</body>

</html>