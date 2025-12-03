<?php
require_once 'inc/config.php';
if (!isset($_GET['id'])) die('ID produk tidak diberikan');

$produkModel = new Produk();
$produk = $produkModel->getById($_GET['id']);
if (!$produk) die('Produk tidak ditemukan');

$message = '';
