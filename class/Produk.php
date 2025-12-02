<?php

class Produk
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAll()
  {
    $sql = "select * from produk order by id_produk asc";
    return $this->db->query($sql)->fetchAll();
  }

  public function getById($id_produk)
  {
    $sql = "select * from produk where id_produk = :id_produk";
    return $this->db->query($sql, ['id_produk' => $id_produk])->fetch();
  }

  public function create($data)
  {
    $sql = "insert into produk (nama, harga, stok, kategori, status, gambar_path) values (:nama, :harga, :stok, :kategori, :status, :gambar_path)";

    return $this->db->query($sql, [
      'nama' => $data['nama'],
      'harga' => $data['harga'],
      'stok' => $data['stok'],
      'kategori' => $data['kategori'],
      'status' => $data['status'],
      'gambar_path' => $data['gambar_path']
    ]);
  }

  public function update($id_produk, $data)
  {
    $sql = "update produk set nama = :nama, harga = :harga, stok = :stok, kategori = :kategori, status = :status, gambar_path = :gambar_path where id_produk = :id_produk";

    return $this->db->query($sql, [
      'id_produk' => $id_produk,
      'nama' => $data['nama'],
      'harga' => $data['harga'],
      'stok' => $data['stok'],
      'kategori' => $data['kategori'],
      'status' => $data['status'],
      'gambar_path' => $data['gambar_path']
    ]);
  }

  public function delete($id_produk)
  {
    $sql = "delete from produk where id_produk = :id_produk";
    return $this->db->query($sql, ['id_produk' => $id_produk]);
  }
}
