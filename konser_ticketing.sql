CREATE DATABASE IF NOT EXISTS konser_ticketing;
USE konser_ticketing;

CREATE TABLE event_konser (
  id_event INT PRIMARY KEY AUTO_INCREMENT,
  nama_event VARCHAR(100),
  harga INT,
  kuota INT
);

CREATE TABLE pesanan (
  id_pesanan INT PRIMARY KEY AUTO_INCREMENT,
  id_event INT,
  nama_pembeli VARCHAR(100),
  email VARCHAR(100),
  jumlah_tiket INT,
  total_harga INT,
  kode_booking VARCHAR(50),
  status VARCHAR(20),
  waktu_pesan DATETIME
);

INSERT INTO event_konser (nama_event, harga, kuota) VALUES
('Dreamville Festival', 250000, 100),
('Java Jazz 2025', 300000, 80),
('Summerland Party', 200000, 50);
