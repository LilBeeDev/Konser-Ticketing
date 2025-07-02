<?php
use Dompdf\Dompdf;
use Dompdf\Options;
require 'dompdf/vendor/autoload.php';
include 'config/koneksi.php';

function generateTicketPDF($kode_booking, $outputPath = null) {
    // Ambil data pesanan & event
    $data = mysqli_query($GLOBALS['koneksi'], "SELECT pesanan.*, event_konser.nama_event, event_konser.tanggal_event, event_konser.lokasi 
    FROM pesanan 
    JOIN event_konser ON pesanan.id_event = event_konser.id_event 
    WHERE pesanan.kode_booking='$kode_booking'") or die(mysqli_error($GLOBALS['koneksi']));
    $d = mysqli_fetch_array($data);

    // Set dompdf option
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    // Template HTML PDF — INI TEMPLATE CETAKNYA, tinggal atur rapi di sini
    $html = "
    <style>
      body { font-family: 'DejaVuSans', sans-serif; padding:20px; }
      h2 { text-align:center; color:#e84118; }
      p { margin:5px 0; font-size:14px; }
      .kode { font-size:18px; text-align:center; margin-top:15px; }
    </style>
    <h2>{$d['nama_event']}</h2>
    <p><strong>Tanggal:</strong> {$d['tanggal_event']}</p>
    <p><strong>Lokasi:</strong> {$d['lokasi']}</p>
    <p><strong>Nama:</strong> {$d['nama_pembeli']}</p>
    <p><strong>Email:</strong> {$d['email']}</p>
    <p><strong>Jumlah Tiket:</strong> {$d['jumlah_tiket']}</p>
    <p><strong>Total:</strong> Rp ".number_format($d['total_harga'])."</p>
    <div class='kode'>Kode Booking: {$d['kode_booking']}</div>
    <div class='kode' style='font-size:12px; margin-top:10px;'>Powered by Pattyville Ticketing System</div>
    ";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A6', 'portrait');
    $dompdf->render();

    if ($outputPath) {
        // Simpan ke file
        file_put_contents($outputPath, $dompdf->output());
    } else {
        // Stream ke browser
        $dompdf->stream("E-Ticket_".$kode_booking.".pdf", array("Attachment" => false));
    }
}
?>
