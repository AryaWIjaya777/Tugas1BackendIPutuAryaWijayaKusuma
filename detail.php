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
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <h1>Detail Produk</h1>
    <p><a class="btn" href="index.php">Kembali</a></p>
  </header>

  <main>
    <div class="product-detail">
      <h2><?php echo Utility::e($produk['nama']); ?></h2>
      <?php if ($produk['gambar_path']): ?>
        <img src="uploads/<?php echo Utility::e($produk['gambar_path']); ?>" alt="<?php echo Utility::e($produk['nama']); ?>">
      <?php else: ?>
        <div class="no-image">Tidak ada gambar</div>
      <?php endif; ?>
      <p><strong>Harga:</strong> <?php echo $produk['harga']; ?></p>
      <p><strong>Stok:</strong> <?php echo $produk['stok']; ?></p>
      <p><strong>Kategori:</strong> <?php echo Utility::e($produk['kategori']); ?></p>
      <p><strong>Status:</strong> <?php echo Utility::e($produk['status']); ?></p>

      <div class="action-links">
        <a class="btn" href="edit.php?id=<?php echo $produk['id_produk']; ?>">Edit</a>
        <a class="btn delete" href="delete.php?id=<?php echo $produk['id_produk']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
      </div>
    </div>
  </main>
</body>

</html>