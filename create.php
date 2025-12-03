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
