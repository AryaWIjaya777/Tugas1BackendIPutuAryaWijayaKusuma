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
  <h1>Daftar Produk</h1>
  <p><a href="create.php">Tambah Produk</a></p>

  <table>
    <thead>
      <tr>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($allProduk as $produk): ?>
        <tr>
          <td><?php echo Utility::e($produk['nama']); ?></td>
          <td>
            <?php if ($produk['gambar_path'] && file_exists('uploads/' . $produk['gambar_path'])): ?>
              <img src="uploads/<?php echo Utility::e($produk['gambar_path']); ?>" alt="<?php echo Utility::e($produk['nama']); ?>">
            <?php else: ?>
              <img src="uploads/no-image.png" alt="No Image">
            <?php endif; ?>
          </td>
          <td>
            <a href="edit.php?id=<?php echo $produk['id_produk']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $produk['id_produk']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a> |
            <a href="detail.php?id=<?php echo $produk['id_produk']; ?>">Detail</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>