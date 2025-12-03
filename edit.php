<?php
require_once 'inc/config.php';
$produkModel = new Produk();
$message = '';

if (!isset($_GET['id'])) die('id produk tidak diberikan');

$produk = $produkModel->getById($_GET['id']);
if (!$produk) die('Produk tidak ditemukan');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [
    'nama' => $_POST['nama'],
    'harga' => $_POST['harga'],
    'stok' => $_POST['stok'],
    'kategori' => $_POST['kategori'],
    'status' => $_POST['status'],
    'gambar_path' => $produk['gambar_path']
  ];

  if (!empty($_FILES['gambar']['name'])) {
    $filename = Utility::uniqueFilename($_FILES['gambar']['name']);
    move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads/' . $filename);
    $data['gambar_path'] = $filename;
  }

  if ($produkModel->update($_GET['id'], $data)) {
    $_SESSION['flash']['message'] = 'Produk berhasil diedit';
    header('Location: index.php');
    exit;
  } else {
    $_SESSION['flash']['message'] = 'Gagal mengedit produk';
    header('Location: edit.php?id=' . $_GET['id']);
    exit;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
</head>

<body>
  <h1>Edit Produk</h1>
  <p><a href="index.php">Kembali</a></p>
  <?php if ($message) echo "<p>$message</p>"; ?>
  <form method="post" enctype="multipart/form-data">
    <label>Nama: <input type="text" name="nama" value="<?php echo Utility::e($produk['nama']); ?>" required></label><br>
    <label>Harga: <input type="number" name="harga" value="<?php echo $produk['harga']; ?>" required></label><br>
    <label>Stok: <input type="number" name="stok" value="<?php echo $produk['stok']; ?>" required></label><br>
    <label>Kategori: <input type="text" name="kategori" value="<?php echo Utility::e($produk['kategori']); ?>" required></label><br>
    <label>Status:
      <select name="status">
        <option value="aktif" <?php echo $produk['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
        <option value="nonaktif" <?php echo $produk['status'] == 'nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
      </select>
    </label><br>
    <label>Gambar: <input type="file" name="gambar"></label>
    <?php if ($produk['gambar_path']): ?>
      <img src="uploads/<?php echo Utility::e($produk['gambar_path']); ?>" width="50">
    <?php endif; ?><br>
    <button type="submit">Edit</button>
  </form>
</body>

</html>