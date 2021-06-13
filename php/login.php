<?php

    //echo ("TEST");

   session_start();

    $sUsername = "";
    $sPassword = "";
    $bLoginSuccess = false;
    if (isset($_POST['username'])) {
        $sUsername = $_POST['username'];
    }

    if (isset($_POST['password'])) {
        $sPassword = $_POST['password'];
    }

    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fehler</title>
    </head>
    <body>
    </body>
    </html>';
    

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


        $sql = "SELECT * FROM webshop.wsuser WHERE username = '$sUsername' AND password = '$sPassword'";

        foreach ($conn -> query($sql) as $row) {
            $bLoginSuccess = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['active'] = 1;
            $_SESSION['lastlogin'] = $row['lastlogin'];
        }
        //Close connection
        $conn = NULL;
    } catch (PDOException $th) {
        echo $th -> getMessage();
    }

    //Login Erfolgreich
     if ($bLoginSuccess) {

        //Weiterleiten
        header("Location: overview.php");
        

    } else{
        echo (
            '<script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
            <script> swal({
                title: "Oops",
                text: "Ungültige Email oder Password!",
                icon: "error",
                button: "OK!",
              }).then(function() {
                window.location = "../login.html";
                });
              </script>'
        );


    }
?>

