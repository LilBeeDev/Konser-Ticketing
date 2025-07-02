<?php
include 'config/koneksi.php';

// Ambil data pesanan
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT pesanan.*, event_konser.* FROM pesanan 
  JOIN event_konser ON pesanan.id_event=event_konser.id_event 
  WHERE pesanan.id_pesanan='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>
  <title>E-Ticket <?= $d['nama_event'] ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f5f7fa;
      padding: 30px;
    }
    .ticket {
      max-width: 600px;
      margin: auto;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.08);
      padding: 25px;
    }
    .poster {
      width: 100%;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    .judul {
      font-weight: 600;
      font-size: 28px;
      margin-bottom: 10px;
    }
    .info {
      margin: 10px 0;
    }
    .label {
      font-weight: 600;
      color: #444;
    }
    .value {
      color: #555;
    }
    .qr {
      width: 100px;
      margin-top: 20px;
    }
    .order-date {
      font-size: 13px;
      color: #888;
      margin-top: 10px;
    }
    .btn-print {
      margin-top: 20px;
    }
    @media print {
      .btn-print {
        display: none;
      }
    }
  </style>
</head>
<body>

<div class="ticket text-center">
  <img src="img/<?= $d['poster'] ?>" class="poster">

  <div class="judul"><?= $d['nama_event'] ?></div>

  <div class="info"><span class="label">Tanggal & Waktu:</span> <span class="value"><?= $d['tanggal_event'] ?>, <?= $d['waktu'] ?> WIB</span></div>
  <div class="info"><span class="label">Lokasi:</span> <span class="value"><?= $d['lokasi'] ?></span></div>
  <div class="info"><span class="label">Nama:</span> <span class="value"><?= $d['nama_pembeli'] ?></span></div>
  <div class="info"><span class="label">Jumlah Tiket:</span> <span class="value"><?= $d['jumlah_tiket'] ?> tiket</span></div>
  <div class="info"><span class="label">Total:</span> <span class="value">Rp <?= number_format($d['total_harga']) ?></span></div>
  <div class="info"><span class="label">Kode Booking:</span> <span class="value"><?= $d['kode_booking'] ?></span></div>

  <img src="img/qr.png" class="qr">

  <div class="order-date">Order Date: <?= date('d M Y') ?></div>

  <button class="btn btn-danger btn-print" onclick="window.print()">Cetak Tiket 🎫</button>
  <a href="index.php" class="btn btn-secondary btn-print">Kembali</a>
</div>

</body>
</html>
