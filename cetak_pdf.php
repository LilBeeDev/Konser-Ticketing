<?php
require 'dompdf/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
include 'config/koneksi.php';

$kode = $_GET['kode'];
$data = mysqli_query($koneksi, "SELECT pesanan.*, event_konser.nama_event, event_konser.tanggal_event, event_konser.lokasi, event_konser.deskripsi 
FROM pesanan 
JOIN event_konser ON pesanan.id_event = event_konser.id_event 
WHERE pesanan.kode_booking='$kode'") or die(mysqli_error($koneksi));
$d = mysqli_fetch_array($data);

// Tanggal order
$tglOrder = date('d M Y');

// Dompdf config
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// HTML Template
$html = '
<style>
  body {
    font-family: "Inter", sans-serif;
    background: #f5f6fa;
    margin: 0;
    padding: 20px;
  }
  .ticket {
    background: #fff;
    border: 2px solid #e84118;
    border-radius: 16px;
    max-width: 680px;
    margin: 20px auto;
    padding: 25px;
  }
  h1 {
    font-size: 28px;
    color: #e84118;
    text-align: center;
    margin-bottom: 16px;
  }
  .deskripsi {
    font-size: 13px;
    color: #444;
    margin-bottom: 16px;
    text-align: center;
  }
  .info p {
    font-size: 14px;
    margin: 6px 0;
  }
  .info span {
    font-weight: 600;
    color: #2f3640;
  }
  .kode {
    margin: 20px 0 10px;
    padding: 12px;
    text-align: center;
    background: #e84118;
    color: #fff;
    font-size: 20px;
    border-radius: 8px;
  }
  .order-date {
    font-size: 12px;
    color: #555;
    margin-top: 6px;
    text-align: center;
  }
  .footer {
    font-size: 11px;
    color: #666;
    text-align: center;
    margin-top: 18px;
    line-height: 1.4;
  }
</style>

<div class="ticket">
  <h1>'.$d['nama_event'].'</h1>
  <div class="deskripsi">'.$d['deskripsi'].'</div>
  <div class="info">
    <p><span>Tanggal:</span> '.$d['tanggal_event'].'</p>
    <p><span>Lokasi:</span> '.$d['lokasi'].'</p>
    <p><span>Nama:</span> '.$d['nama_pembeli'].'</p>
    <p><span>Email:</span> '.$d['email'].'</p>
    <p><span>Jumlah Tiket:</span> '.$d['jumlah_tiket'].'</p>
    <p><span>Total Harga:</span> Rp '.number_format($d['total_harga']).'</p>
  </div>
  <div class="kode">Kode Booking: '.$d['kode_booking'].'</div>
  <div class="order-date">Order date: '.$tglOrder.'</div>
  <div class="footer">
    Bawa & tunjukkan e-ticket ini saat masuk venue.<br>
    Powered by Pattyville Ticketing System
  </div>
</div>
';

$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait');
$dompdf->render();
$dompdf->stream("E-Ticket_".$kode.".pdf", array("Attachment" => false));
exit();
?>
