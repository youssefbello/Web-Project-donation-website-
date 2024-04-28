<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

function sendEmail($to, $subject, $html, $fullname) {
	$mail = new PHPMailer(true);
	try{
		$mail->isSMTP();
		$mail->CharSet = "utf-8";
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';

		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);
		$mail->isHTML(true);

		$mail->Username = 'chamkhi.badreddine@esprit.tn';//
		$mail->Password = 'Hardtoget1.0';

		$mail->setFrom('chamkhi.badreddine@esprit.tn', 'SADAKA Support');
		$mail->Subject = $subject;
		$mail->MsgHTML($html);
		$mail->addAddress($to, $fullname);

		$mail->send();
	}
	catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}
?>