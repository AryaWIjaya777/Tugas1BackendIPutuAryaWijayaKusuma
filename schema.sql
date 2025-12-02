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