<?php
$kode = $_GET['kode'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pesanan Berhasil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      font-weight: 400;
      background-color: #f8f9fa;
    }
    h2 {
      font-weight: 700;
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
    .card {
      border-radius: 16px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      padding: 30px;
    }
  </style>
</head>

<body class="container mt-5 text-center">

  <div class="card mx-auto" style="max-width: 500px;">
    <h2 class="mb-4">Pesanan Berhasil!</h2>
    <p>Kode Booking Kamu:</p>
    <h3 class="mb-4"><?= $kode; ?></h3>

    <a href="cetak_pdf.php?kode=<?= $kode; ?>" class="btn btn-custom mb-2">Cetak Tiket PDF 🎫</a><br>
    <a href="index.php" class="btn btn-secondary">Kembali ke Daftar Konser</a>
  </div>
  
<audio id="notifSound" src="sounds/notif.mp3" preload="auto"></audio>
<script>
  window.onload = function() {
    document.getElementById('notifSound').play();
  }
</script>
</body>
</html>
