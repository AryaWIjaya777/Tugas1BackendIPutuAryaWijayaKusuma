<?php
require_once 'inc/config.php';
$produkModel = new Produk();

if (!isset($_GET['id'])) die('id produk tidak diberikan');

$produk = $produkModel->getById($_GET['id']);
if (!$produk) die('Produk tidak ditemukan');

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($produk['gambar_path']) && file_exists('uploads/' . $produk['gambar_path'])) {
    unlink('uploads/' . $produk['gambar_path']);
  }

  if ($produkModel->delete($_GET['id'])) {
    $message = 'Produk berhasil dihapus.';
    header("Refresh:1; url=index.php");
  } else {
    $message = 'Gagal menghapus produk.';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Hapus Produk</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="confirm-container">
    <?php if ($message): ?>
      <p class="message"><?php echo $message; ?></p>
    <?php else: ?>
      <p>Apakah Anda yakin ingin menghapus produk <strong><?php echo Utility::e($produk['nama']); ?></strong>?</p>
      <form method="post" class="confirm-actions">
        <button class="btn delete" type="submit">Hapus</button>
        <a class="btn" href="index.php">Batal</a>
      </form>
    <?php endif; ?>
  </div>
</body>

</html>