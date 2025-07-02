<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

function kirimEmail($emailTujuan, $nama, $kode_booking, $nama_event, $jumlah_tiket, $pdf_file){
  $mail = new PHPMailer(true);
  try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'arbykalengke@gmail.com';
    $mail->Password   = 'nswe clfb ibqt znit';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('arbykalengke@gmail.com', 'Pattyville Ticketing');
    $mail->addAddress($emailTujuan, $nama);

    $mail->isHTML(true);
    $mail->Subject = 'Booking Tiket: '.$kode_booking;
    $mail->Body    = "
      <h3>Halo $nama,</h3>
      <p>Terima kasih sudah pesan tiket:</p>
      <p><strong>Event:</strong> $nama_event<br>
      <strong>Kode Booking:</strong> $kode_booking<br>
      <strong>Jumlah Tiket:</strong> $jumlah_tiket</p>
      <p>🎟️ E-ticket ada di lampiran email ini.</p>";

    $mail->addAttachment($pdf_file);
    $mail->send();
    return true;

  } catch (Exception $e) {
    return false;
  }
}
?>
