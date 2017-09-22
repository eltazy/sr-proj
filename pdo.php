<?php
	include('PHPMailer/_lib/phpmailer-fe.php');
	include('PHPMailer/_lib/class.phpmailer.php');
	$mail = new PHPMailer(true);
	try {
	    //Server settings
	    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'smtp.gmail.com;smtp.ueab.ac.ke';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = false;
	    $mail->Port = 587;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom('contact@tazsoft.com', 'TazSoft');
	    $mail->addAddress('buhendwami@ueab.ac.ke');     // Add a recipient, Name is optional

	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Validation';
	    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>