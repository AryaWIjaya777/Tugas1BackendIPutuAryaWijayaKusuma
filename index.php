<?php
require_once 'inc/config.php';

$produkModel = new Produk();
$allProduk = $produkModel->getAll();
