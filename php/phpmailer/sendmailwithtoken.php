<?php 

    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../PHPMailer/src/Exception.php';
    require '../../PHPMailer/src/PHPMailer.php';
    require '../../PHPMailer/src/SMTP.php';



    //Generate a new token

    $token = openssl_random_pseudo_bytes(16);

    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    //Send confirm email with link to reset password

    $emailaddress = 'nguyenyen281099@gmail.com';
    $nameaddress = '';
    if (isset($_GET['email'])) {
        $emailaddress = $_POST['email'];
    }
    $subject = '';
    $body = '';
    $altbody = '';

    
    //Add token with mail to database
    try {
        //Datenbank settings
        $datenbankname = "webshop";
        $benutzername = "root";
        $benutzerpassword = "";
        $servername = "localhost";

        //Verbindung zur Datenbank
        $conn = new PDO("mysql:host=$servername; dbname = $datenbankname", $benutzername, $benutzerpassword);

        //Set the PDO error node to exception
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->query("SELECT * FROM webshop.wsuser where username = '$emailaddress'");
        //echo $stmt->rowCount();

        if ( $stmt->rowCount() != 0) {
            $sqltoken = "UPDATE webshop.wsuser SET token = '$token' WHERE username = '$emailaddress'";
            $conn -> query($sqltoken);

            $subject = 'Armbanduhr.de - Passwort vergessen?';
            $body = 'Password hier zur&uuml;cksetzen: http://localhost/webshop/php/setpassword.php?emailaddress='.$emailaddress.'&token='.$token;
            $altbody = 'Password hier zuruecksetzen: http://localhost/webshop/php/setpassword.php?emailaddress='.$emailaddress.'&token='.$token;

        
            //Close connection
            $conn = NULL;

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
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
            $mail->setFrom('webshop020721@gmail.com', 'Armbanduhr.de');
            $mail->addAddress($emailaddress, $nameaddress); // Add a recipient
            //$mail->addReplyTo('info@example.com', 'Information');
            //Copie
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

            // Content
            $mail->isHTML(true);   // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $altbody;

            $mail->send();
            echo 'Message has been sent';
        };
            //Close connection
            $conn = NULL;

        } catch (Exception $th) {
        $handle = fopen ("error_login.txt", "w");
        fwrite ($handle, $th -> getMessage());
        fclose ($handle);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../../node_modules/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>
    <script>
        swal({
                title: "Alles oke!",
                text: "Die Email wird nur gesendet, wenn damit ein Account registriert ist.",
                icon: "info",
                button: "OK!",
              }).then(function() {
                window.location = "../../login.html";
                });
    </script>
</body>
</html>