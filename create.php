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
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $maxSize = 2 * 1024 * 1024; // 2 MB
    $fileType = $_FILES['gambar']['type'];
    $fileSize = $_FILES['gambar']['size'];

    if (!in_array($fileType, $allowedTypes)) {
      $message = "Format file tidak diperbolehkan. Hanya jpg, jpeg, png.";
    } elseif ($fileSize > $maxSize) {
      $message = "Ukuran file terlalu besar. Maksimal 2 MB.";
    } else {
      $filename = Utility::uniqueFilename($_FILES['gambar']['name']);
      move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads/' . $filename);
      $data['gambar_path'] = $filename;
    }
  }

  if ($produkModel->create($data)) {
    header('Location: index.php');
    exit;
  } else {
    $message = 'Gagal menambahkan produk';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <h1>Tambah Produk</h1>
    <p><a class="btn" href="index.php">Kembali</a></p>
  </header>

  <main>
    <?php if ($message) echo "<p class='message'>$message</p>"; ?>
    <form method="post" enctype="multipart/form-data" class="form">
      <label>Nama: <input type="text" name="nama" required></label>
      <label>Harga: <input type="number" name="harga" required></label>
      <label>Stok: <input type="number" name="stok" required></label>
      <label>Kategori: <input type="text" name="kategori" required></label>
      <label>Status:
        <select name="status">
          <option value="aktif">Aktif</option>
          <option value="nonaktif">Nonaktif</option>
        </select>
      </label>
      <label>Gambar: <input type="file" name="gambar"></label>
      <button type="submit" class="btn">Tambah</button>
    </form>
  </main>
</body>

</html>