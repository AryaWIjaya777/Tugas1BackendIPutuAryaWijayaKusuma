<?php
require_once 'inc/config.php';
$produkModel = new Produk();
$message = '';

if (!isset($_GET['id'])) die('id produk tidak diberikan');

$produk = $produkModel->getById($_GET['id']);
if (!$produk) die('Produk tidak ditemukan');
