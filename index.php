<?php
include 'config/koneksi.php';
$data = mysqli_query($koneksi,"SELECT * FROM event_konser");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Daftar Konser</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      font-weight: 400;
    }
    h2 {
      font-weight: 700;
      margin-bottom: 30px;
    }
    .card {
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      transition: 0.3s;
      cursor: pointer;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
    .card-title {
      font-weight: 600;
      font-size: 1.25rem;
      color: #1e272e;
    }
    .card-text {
      font-weight: 400;
      color: #57606f;
    }
    a.card-link {
      text-decoration: none;
      color: inherit;
    }
  </style>
</head>

<body class="container mt-5">
  <h2>Daftar Konser</h2>

  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php while($d = mysqli_fetch_array($data)) { ?>
      <div class="col">
        <a href="detail.php?id_event=<?= $d['id_event']; ?>" class="card-link">
          <div class="card h-100">
            <img src="img/<?= $d['gambar']; ?>" class="card-img-top" alt="<?= $d['nama_event']; ?>">
            <div class="card-body">
              <h5 class="card-title"><?= $d['nama_event']; ?></h5>
              <p class="card-text">Rp <?= number_format($d['harga']); ?></p>
              <p class="card-text">Kuota: <?= $d['kuota']; ?> tiket</p>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
  </div>

</body>
</html>
