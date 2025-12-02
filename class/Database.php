<?php

class Database
{
  private $pdo;

  public function __construct()
  {
    $this->connect();
  }

  public function connect()
  {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    try {
      $this->pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
    } catch (PDOException $e) {
      echo "DB connection error: " . $e->getMessage();
      exit;
    }
    return $this->pdo;
  }

  public function getConnection()
  {
    return $this->pdo;
  }

  public function query($sql, $params = [])
  {
    $stmt = $this->pdo->prepare($sql);
    if ($stmt->execute($params)) {
      return $stmt;
    }
    return false;
  }
}
