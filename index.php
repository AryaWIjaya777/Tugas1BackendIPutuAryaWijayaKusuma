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
</head>

<body>
  <h1>Daftar Produk</h1>
  <p><a href="create.php">Tambah Produk</a></p>
  <table border="1" cellpadding="5">
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Kategori</th>
      <th>Status</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>
    <?php foreach ($allProduk as $produk): ?>
      <tr>
        <td><?php echo $produk['id_produk']; ?></td>
        <td><?php echo Utility::e($produk['nama']); ?></td>
        <td><?php echo $produk['harga']; ?></td>
        <td><?php echo $produk['stok']; ?></td>
        <td><?php echo Utility::e($produk['kategori']); ?></td>
        <td><?php echo Utility::e($produk['status']); ?></td>
        <td>
          <?php if ($produk['gambar_path']): ?>
            <img src="uploads/<?php echo Utility::e($produk['gambar_path']); ?>" width="50">
          <?php endif; ?>
        </td>
        <td>
          <a href="edit.php?id=<?php echo $produk['id_produk']; ?>">Edit</a> |
          <a href="delete.php?id=<?php echo $produk['id_produk']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a> |
          <a href="detail.php?id=<?php echo $produk['id_produk']; ?>">Detail</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>