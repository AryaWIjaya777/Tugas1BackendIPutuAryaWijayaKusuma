<?php
require_once 'inc/config.php';
$produkModel = new Produk();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [
    'nama' => $_POST['nama'],
    'harga' => $_POST['harga'],
    'stok' => $_POST['stok'],
    'kategori' => $_POST['kategori'],
    'status' => $_POST['status'],
    'gambar_path' => ''
  ];

  if (!empty($_FILES['gambar']['name'])) {
    $filename = Utility::uniqueFilename($_FILES['gambar']['name']);
    move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads/' . $filename);
    $data['gambar_path'] = $filename;
  }

  $message = $produkModel->create($data) ? 'Produk berhasil ditambahkan' : 'Gagal menambahkan produk';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
</head>

<body>
  <h1>Tambah Produk</h1>
  <p><a href="index.php">Kembali</a></p>
  <?php if ($message) echo "<p>$message</p>"; ?>
  <form method="post" enctype="multipart/form-data">
    <label>Nama: <input type="text" name="nama" required></label><br>
    <label>Harga: <input type="number" name="harga" required></label><br>
    <label>Stok: <input type="number" name="stok" required></label><br>
    <label>Kategori: <input type="text" name="kategori" required></label><br>
    <label>Status:
      <select name="status">
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
      </select>
    </label><br>
    <label>Gambar: <input type="file" name="gambar"></label><br>
    <button type="submit">Simpan</button>
  </form>
</body>

</html>