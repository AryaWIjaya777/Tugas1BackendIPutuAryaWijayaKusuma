<?php
require_once 'inc/config.php';

$produkModel = new Produk();
$allProduk = $produkModel->getAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Daftar Produk</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <h1>Daftar Produk</h1>
    <p><a class="btn" href="create.php">Tambah Produk</a></p>
  </header>

  <main>
    <div class="product-grid">
      <?php foreach ($allProduk as $produk): ?>
        <div class="product-item">
          <h3><?php echo Utility::e($produk['nama']); ?></h3>
          <?php if ($produk['gambar_path']): ?>
            <img src="uploads/<?php echo Utility::e($produk['gambar_path']); ?>" alt="<?php echo Utility::e($produk['nama']); ?>">
          <?php else: ?>
            <div class="no-image">Tidak ada gambar</div>
          <?php endif; ?>
          <div class="action-links">
            <a class="btn" href="edit.php?id=<?php echo $produk['id_produk']; ?>">Edit</a>
            <a class="btn delete" href="delete.php?id=<?php echo $produk['id_produk']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            <a class="btn detail" href="detail.php?id=<?php echo $produk['id_produk']; ?>">Lihat Detail</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
</body>

</html>