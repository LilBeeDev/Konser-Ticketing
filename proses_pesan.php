<?php
include 'config/koneksi.php';
require 'dompdf/vendor/autoload.php';
require 'send_email.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$id_event = $_POST['id_event'];
$nama     = $_POST['nama_pembeli'];
$email    = $_POST['email'];
$jumlah   = $_POST['jumlah_tiket'];

$data = mysqli_query($koneksi, "SELECT * FROM event_konser WHERE id_event='$id_event'");
$d    = mysqli_fetch_array($data);

$total_harga  = $jumlah * $d['harga'];
$kode_booking = 'TK' . date("YmdHis");
$waktu        = date("Y-m-d H:i:s");

mysqli_query($koneksi,"INSERT INTO pesanan VALUES (NULL, '$id_event', '$nama', '$email', '$jumlah', '$total_harga', '$kode_booking', 'PAID', '$waktu')");

// Ambil data pesanan full
$p = mysqli_query($koneksi, "SELECT pesanan.*, event_konser.nama_event, event_konser.tanggal_event, event_konser.lokasi 
FROM pesanan JOIN event_konser ON pesanan.id_event=event_konser.id_event WHERE kode_booking='$kode_booking'");
$pesanan = mysqli_fetch_array($p);

// PDF Generate
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Template PDF clean
$html = "
<style>
body { font-family: Arial; padding:20px; }
.ticket { border: 2px solid #e84118; padding:20px; border-radius:10px; }
h2 { text-align:center; color:#e84118; }
p { margin:6px 0; }
.kode { background:#e84118; color:#fff; padding:10px; text-align:center; margin-top:15px; font-size:18px; }
.footer { text-align:center; margin-top:15px; font-size:12px; color:#555; }
</style>

<div class='ticket'>
<h2>E-Ticket</h2>
<p><strong>Event:</strong> {$pesanan['nama_event']}</p>
<p><strong>Tanggal:</strong> {$pesanan['tanggal_event']}</p>
<p><strong>Lokasi:</strong> {$pesanan['lokasi']}</p>
<p><strong>Nama:</strong> {$pesanan['nama_pembeli']}</p>
<p><strong>Email:</strong> {$pesanan['email']}</p>
<p><strong>Jumlah Tiket:</strong> {$pesanan['jumlah_tiket']}</p>
<p><strong>Total:</strong> Rp ".number_format($pesanan['total_harga'])."</p>
<div class='kode'>Kode Booking: {$pesanan['kode_booking']}</div>
<div class='footer'> Tunjukkan e-ticket ini saat masuk venue.<br>Powered by Pattyville Ticketing System</div>
</div>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait');
$dompdf->render();

// Simpan PDF
$pdf_file = 'tickets/Tiket_'.$kode_booking.'.pdf';
file_put_contents($pdf_file, $dompdf->output());

// Kirim email + attach PDF
kirimEmail($email, $nama, $kode_booking, $pesanan['nama_event'], $pesanan['jumlah_tiket'], $pdf_file);

// Redirect ke sukses
header("Location: sukses.php?kode=$kode_booking");
?>
