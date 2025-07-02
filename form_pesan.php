<?php
include 'config/koneksi.php';
$id = $_GET['id_event'];
$data = mysqli_query($koneksi,"SELECT * FROM event_konser WHERE id_event='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pemesanan Tiket: <?= $d['nama_event']; ?></title>
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
    .btn-custom {
      background-color: #ff4757;
      color: #fff;
      font-weight: 600;
      border: none;
    }
    .btn-custom:hover {
      background-color: #e84118;
    }
    label {
      font-weight: 600;
    }
  </style>
</head>

<body class="container mt-5">

  <h2>Pesan Tiket: <?= $d['nama_event']; ?></h2>

  <div class="card p-4">
    <form action="proses_pesan.php" method="POST">
      <input type="hidden" name="id_event" value="<?= $d['id_event']; ?>">

      <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama_pembeli" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Jumlah Tiket (max <?= $d['kuota']; ?>)</label>
        <input type="number" name="jumlah_tiket" class="form-control" required min="1" max="<?= $d['kuota']; ?>">
      </div>

      <button type="submit" class="btn btn-custom">Pesan Sekarang 🎟️</button>
      <a href="detail.php?id_event=<?= $d['id_event']; ?>" class="btn btn-secondary">Kembali</a>
    </form>
  </div>

</body>
</html>
