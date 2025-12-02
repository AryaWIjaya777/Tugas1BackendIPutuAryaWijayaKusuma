<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'produk_crud');

define('BASE_URL', 'http://localhost:8000/');

const NAV_PAGES = [
  ['title' => 'Home',          'url' => 'index.php'],
  ['title' => 'Daftar Produk', 'url' => 'index.php'],
  ['title' => 'Tambah Produk', 'url' => 'create.php']
];

spl_autoload_register(function ($class) {
  $path = __DIR__ . '/../class/' . $class . '.php';
  if (file_exists($path)) require_once $path;
});
