<?php
require_once 'inc/config.php';
$produkModel = new Produk();
if (!isset($_GET['id'])) die('id produk tidak diberikan');

$produkModel->delete($_GET['id']);
header('Location: index.php');
exit;
