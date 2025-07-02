<?php
function generatePDFHtml($d){
  $tglOrder = date('d M Y');
  $barcode = 'https://barcode.tec-it.com/barcode.ashx?data='.$d['kode_booking'].'&code=Code128&translate-esc=true';

  $html = '
  <style>
    body { font-family: "Inter", sans-serif; background: #f5f6fa; margin: 0; padding: 20px; }
    .ticket { background: #fff; border: 2px solid #e84118; border-radius: 16px; max-width: 680px; margin: 20px auto; padding: 25px; }
    h1 { font-size: 28px; color: #e84118; text-align: center; margin-bottom: 16px; }
    .deskripsi { font-size: 13px; color: #444; margin-bottom: 16px; text-align: center; }
    .info p { font-size: 14px; margin: 6px 0; }
    .info span { font-weight: 600; color: #2f3640; }
    .kode { font-size: 18px; text-align: center; margin-top: 25px; }
    .barcode { text-align: center; margin-top: 10px; }
    .barcode img { width: 60%; }
    .order-date { font-size: 12px; color: #555; margin-top: 6px; text-align: center; }
    .footer { font-size: 11px; color: #666; text-align: center; margin-top: 18px; line-height: 1.4; }
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
      <p><span>Total:</span> Rp '.number_format($d['total_harga']).'</p>
    </div>
    <div class="kode">Kode Booking: '.$d['kode_booking'].'</div>
    <div class="barcode">
      <img src="'.$barcode.'" alt="Barcode">
    </div>
    <div class="order-date">Order date: '.$tglOrder.'</div>
    <div class="footer">
      Bawa & tunjukkan e-ticket ini saat masuk venue.<br>
      Powered by Pattyville Ticketing System
    </div>
  </div>';
  
  return $html;
}
?>
