<?php 

    session_start();
    $sid = $_SESSION['id'];
    $shippingname = $_SESSION['firstname'].' '.$_SESSION['lastname'];
    $shippingemail = $_SESSION['username'];
    $shippingadress = $_SESSION['address'];
    $zip = $_SESSION['zip'];
    $city = $_SESSION['city'];
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
            $sqlorder = "INSERT INTO webshop.wsorder (idorder,iduser,idcart,totalvalue,shippingmethod,shippingname,shippingemail,shippingaddress,zip,city,paymentmethod,paymentname,paymentnumber,placedtime,isclosed) VALUES ('', $sid, $idcart, 0, '', '$shippingname', '$shippingemail', '$shippingadress', '$zip', '$city', NULL, NULL, NULL, NULL, 0)";
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
    header('Location: ../overview.php');

?>