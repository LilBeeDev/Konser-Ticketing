<?php
include 'config/koneksi.php';
$id = $_GET['id_event'];
$data = mysqli_query($koneksi,"SELECT * FROM event_konser WHERE id_event='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Detail Konser</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      font-weight: 400;
    }
    h2 {
      font-weight: 700;
      margin-bottom: 20px;
    }
    .card {
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .card-img-top {
      height: 350px;
      object-fit: cover;
    }
    .btn-custom {
      background-color: #ff4757;
      color: #fff;
      font-weight: 600;
      border: none;
    }
    .btn-custom:hover {
      background-color: #e84118;
    }
    .text-label {
      font-weight: 600;
    }
  </style>
</head>

<body class="container mt-5">

  <h2><?= $d['nama_event']; ?></h2>

  <div class="card mb-4">
    <img src="img/<?= $d['gambar']; ?>" class="card-img-top" alt="<?= $d['nama_event']; ?>">
    <div class="card-body">
      <p><span class="text-label">Tanggal:</span> <?= $d['tanggal_event']; ?></p>
      <p><span class="text-label">Lokasi:</span> <?= $d['lokasi']; ?></p>
      <p><span class="text-label">Harga:</span> Rp <?= number_format($d['harga']); ?></p>
      <p><span class="text-label">Kuota:</span> <?= $d['kuota']; ?> tiket</p>
      <p><span class="text-label">Deskripsi:</span> <?= $d['deskripsi']; ?></p>

      <a href="form_pesan.php?id_event=<?= $d['id_event']; ?>" class="btn btn-custom mt-3">Pesan Tiket 🎟️</a>
      <a href="index.php" class="btn btn-secondary mt-3">Kembali</a>
    </div>
  </div>

</body>
</html>
