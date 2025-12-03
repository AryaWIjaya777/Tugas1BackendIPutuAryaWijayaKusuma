# Aplikasi CRUD Produk

## Deskripsi Aplikasi

**Entitas Utama:**

- Produk
  - Atribut: `id_produk`, `nama`, `harga`, `stok`, `kategori`, `status`, `gambar_path`, `created_at`

**Fungsi aplikasi:**

- Menambahkan produk baru beserta gambar.
- Menampilkan daftar produk.
- Mengubah data produk yang sudah ada.
- Menghapus produk dan file gambar terkait.
- Melihat detail produk.

## Spesifikasi Teknis

- **Versi PHP:** 8.4.13
- **DBMS:** MySQL
- **Struktur Folder:**
  produk-root/
  ├─ class/
  │ ├─ Database.php
  │ ├─ Produk.php
  │ └─ Utility.php
  ├─ uploads/
  | └─ .gitkeep
  ├─ inc/
  │ └─ config.php
  ├─ css/
  │ └─ style.css
  ├─ .gitignore
  ├─ index.php
  ├─ create.php
  ├─ edit.php
  ├─ delete.php
  ├─ detail.php
  ├─ README.md
  └─ schema.sql

- **Class Utama:**
  - `Database` → menangani koneksi database dan eksekusi query menggunakan PDO.
  - `Produk` → entity dan repository untuk crud produk.
  - `Utility` → fungsi bantuan, mis. sanitasi teks dan membuat nama file unik.

1. **Impor Basis Data**

   - Buka MySQL dan jalankan schema SQL:

   ```sql
   create database produk_crud;
   use produk_crud;
   create table produk (
   id_produk int auto_increment primary key,
   nama varchar(100) not null,
   harga decimal(10,2) not null,
   stok int not null,
   kategori varchar(50) not null,
   status enum('aktif', 'nonaktif') not null default 'aktif',
   gambar_path varchar(255),
   created_at timestamp default current_timestamp
   );

   ```

2. **Konfigurasi Koneksi Database**
   Buka inc/config.php dan sesuaikan:
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'produk_crud');
   define('BASE_URL', 'http://localhost:8000/');

3. **Menjalankan Aplikasi**
   - Jalankan server PHP built-in:
     php -S localhost:8000
   - Akses aplikasi melalui browser:
     http://localhost:8000

## Contoh Skenario Uji Singkat

1. **Tambah 1 data**

   - Buka halaman `Tambah Produk` (create.php)
   - Isi form produk, unggah gambar, lalu klik tambah
   - Produk baru akan muncul di halaman utama

2. **Tampilkan daftar data**

   - Buka halaman utama (`index.php`)
   - Semua produk yang tersimpan akan ditampilkan
   - Untuk mengecek detail dari produk bisa klik lihat detail

3. **Ubah data tertentu**

   - Klik tombol `Edit` pada salah satu produk
   - Ubah data yang diinginkan dan klik edit
   - Data produk akan diperbarui di halaman utama dan detail produk

4. **Hapus data**
   - Klik tombol `Hapus` pada salah satu produk
   - Konfirmasi penghapusan akan muncul
   - Jika dikonfirmasi, produk akan dihapus dari database (dan file gambar terkait jika ada)
