<?php
require_once 'inc/config.php';
$produkModel = new Produk();

if (!isset($_GET['id'])) die('id produk tidak diberikan');

$produk = $produkModel->getById($_GET['id']);
if (!$produk) die('Produk tidak ditemukan');

if (!empty($produk['gambar_path']) && file_exists('uploads/' . $produk['gambar_path'])) {
  unlink('uploads/' . $produk['gambar_path']);
}

$produkModel->delete($_GET['id']);

header('Location: index.php');
exit;
