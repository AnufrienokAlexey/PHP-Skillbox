<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
	//Server settings
//	$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.beget.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'alexey-test@blacktonptz.store';                     //SMTP username
	$mail->Password   = 'alexey-test22';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	//Recipients
	$mail->setFrom('alexey-test@blacktonptz.store', 'Administator');
	$mail->addAddress($_POST['email'], $_POST['author']);     //Add a recipient
	$mail->addReplyTo('spam.anufrienok@gmail.com', 'Information');

	//Attachments
	$mail->addAttachment($formObject->slug);         //Add attachments

	//Content
	$mail->isHTML(true);                                  //Set email format to HTML
	$mail->Subject = 'Тема сообщения';
	$mail->Body    = $_POST['text'];
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	$mail->send();
	$_POST['send'] = true;

//	echo 'Сообщение было отправлено!';
} catch (Exception $e) {
//	echo "Сообщение не было отправлено. Mailer Error: {$mail->ErrorInfo}";
	$_POST['send'] = false;
}