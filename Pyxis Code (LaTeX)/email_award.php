<?php
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

// Enable verbose debug output
$mail->SMTPDebug = 3;                               

// Specify main and backup SMTP servers
$mail->Host = 'localhost';  

$mail->setFrom('awards@pyxis.com', 'Pyxis Corporation');
// Add a recipient
$mail->addAddress($_POST['recipient_email'], $_POST['recipient_first_name'] . ' ' . $_POST['recipient_last_name']);

// Add attachments
$mail->addAttachment('/nfs/stak/students/c/channa/public_html/pyxis/certificates/' . $_POST['award_id'] . '.pdf', 'award.pdf');
// Set email format to HTML
$mail->isHTML(true);

$mail->Subject = 'Pyxis Employee of the ' . ucfirst($_POST['award_type']) . ' Award';
$mail->Body    = '<p>Dear ' . $_POST['recipient_first_name'] . ' ' . $_POST['recipient_last_name'] . ',</p>
<p>Our employees are our greatest asset. Please know that you are a valued member of the team.</p>
<p>In recognition of your outstanding excellence and dedication, we are pleased to present you with the Employee of the ' . ucfirst($_POST['award_type']) . ' Award.</p>
<p>The attached certificate will also be displayed at the celebratory banquet.</p>
<p>Congratulations and best wishes for your continued success,</p>
<p>Pyxis</p>';
$mail->AltBody = 'Dear ' . $_POST['recipient_first_name'] . ' ' . $_POST['recipient_last_name'] . ',
Our employees are our greatest asset. Please know that you are a valued member of the team.
In recognition of your outstanding excellence and dedication, we are pleased to present you with the Employee of the ' . ucfirst($_POST['award_type']) . ' Award.
The attached certificate will also be displayed at the celebratory banquet.
Congratulations and best wishes for your continued success,
Pyxis';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}