<?php

    //echo ("TEST");

   session_start();

    $sUsername = "";
    $sPassword = "";
    $sid = "";
    $shippingname ="";
    $shippingadress ="";
    $shippingemail="";
    $bLoginSuccess = false;
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        header("Location: ../login.html");
    }

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
        <title>Login...</title>
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
            $sid =  $row['id'];
            $shippingname = $row['firstname'].' '.$row['lastname'];
            $shippingemail = $row['username'];
            $shippingadress = $row['address'].' '.$row['zip'].' '.$row['city'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['active'] = 1;
            $_SESSION['lastlogin'] = $row['lastlogin'];
            $_SESSION['ispwreseted'] = $row['ispwreseted'];

        }

        //set active = 1 for user
        $sql2 = "UPDATE webshop.wsuser SET active = '1' WHERE id = $sid";
        $conn->query($sql2);

        //set lastlogin = now()
        $sql3 = "UPDATE webshop.wsuser SET lastlogin = CURRENT_TIMESTAMP() WHERE id = $sid";
        $conn->exec($sql3);

        // Hier wird der Warenkorbdaten erstellen/aufrufen
        // Check if es einen Order gibt, die isClosed == false
        $sql4 = "SELECT COUNT(*) FROM webshop.wsorder WHERE iduser = '$sid' AND isclosed = '0'";
        $object = $conn -> query($sql4);
        $countorder = $object -> fetchColumn();
        
        if ($countorder == 0) { // Heißt es gibt keine offene Order
            // // Wenn keine, erstell neuen Shopping cart
            $sqlcart = "INSERT INTO webshop.wscart (idcart, iduser, createdat) VALUES ('',$sid,CURRENT_TIMESTAMP())";
            $conn->exec($sqlcart);
            //Take cartid
            $sqlcartid = "SELECT idcart FROM webshop.wscart WHERE iduser= '$sid' ORDER BY createdat DESC LIMIT 1";
            $res = $conn -> query($sqlcartid);
            $idcart = $res -> fetchColumn();
            //erstell neuen order not closed
            $sqlorder = "INSERT INTO webshop.wsorder (idorder,iduser,idcart,shippingname,shippingemail,shippingaddress,paymentmethod,paymentname,paymentnumber,isclosed) VALUES ('', $sid, $idcart, '$shippingname', '$shippingemail', '$shippingadress', NULL, NULL, NULL, 0)";
            $conn -> query($sqlorder);
                $_SESSION['idcart'] = $idcart;

        } else {
            //Es gibt zumindest eine offene Order
            $sqlqueryfororder = "SELECT * FROM webshop.wsorder WHERE iduser = '$sid' AND isclosed = '0' ORDER BY idcart DESC LIMIT 1";
            foreach ($conn -> query($sqlqueryfororder) as $row) {
                $_SESSION['idcart'] = $row['idcart'];
            }
        }
        echo $_SESSION['idcart'];




        //Close connection
        $conn = NULL;
    } catch (PDOException $th) {
        echo $th -> getMessage();
    }


    // Login Erfolgreich
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

