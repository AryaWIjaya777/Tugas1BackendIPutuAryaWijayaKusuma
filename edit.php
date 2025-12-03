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
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <h1>Edit Produk</h1>
    <p><a class="btn" href="index.php">Kembali</a></p>
  </header>

  <main>
    <?php if ($message) echo "<p class='message'>$message</p>"; ?>
    <form method="post" enctype="multipart/form-data" class="form">
      <label>Nama: <input type="text" name="nama" value="<?php echo Utility::e($produk['nama']); ?>" required></label>
      <label>Harga: <input type="number" name="harga" value="<?php echo $produk['harga']; ?>" required></label>
      <label>Stok: <input type="number" name="stok" value="<?php echo $produk['stok']; ?>" required></label>
      <label>Kategori: <input type="text" name="kategori" value="<?php echo Utility::e($produk['kategori']); ?>" required></label>
      <label>Status:
        <select name="status">
          <option value="aktif" <?php echo $produk['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
          <option value="nonaktif" <?php echo $produk['status'] == 'nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
        </select>
      </label>
      <label>Gambar: <input type="file" name="gambar"></label>
      <?php if ($produk['gambar_path']): ?>
        <img src="uploads/<?php echo Utility::e($produk['gambar_path']); ?>" alt="<?php echo Utility::e($produk['nama']); ?>" width="100">
      <?php endif; ?>
      <button type="submit" class="btn">Edit</button>
    </form>
  </main>
</body>

</html>