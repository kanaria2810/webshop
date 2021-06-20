<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings

    // Enable verbose debug output
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    // send mail SMTP
    $mail->isSMTP();
    // Set the SMTP server to send through
    $mail->Host = 'smtp.gmail.com';
    // Enable SMTP authentication
    $mail->SMTPAuth = true;
    // SMTP username & password
    $mail->Username = 'webshop020721@gmail.com';
    $mail->Password = 'webshop0207'; 
    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // TCP port to connect to
    $mail->Port = 587;

    //Info Receiver
    $mail->setFrom('webshop020721@gmail.com', 'Mailer');
    $mail->addAddress('nguyenyen281099@gmail.com', 'Yen Nguen'); // Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');
    //Copie
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

    // Content
    $mail->isHTML(true);   // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>