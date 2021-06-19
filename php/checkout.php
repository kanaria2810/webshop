<?php
    session_start();

    if ($_SESSION['active'] != 1) {
    
      //Sofort logout
      header("Location: /startsite.php");
    
    }

    $cid = $_SESSION['idcart']; 
    $shippingname="";
    $shippingemail="";
    $shippingaddress="";
    $zip="";
    $city="";
    $paymentmethod="";
    $paymentname="";
    $paymentnumber="";
    if (isset($_POST['username'])) {
        $sUsername = $_POST['username'];
    }

    try {
        //Gesambetrag
        $total = 0;
        //Mengenrabatt
        $rabattrate = 0.15;
        $totalrabatt = 0;
        //Datenbank settings
        $datenbankname = "webshop";
        $benutzername = "root";
        $benutzerpassword = "";
        $servername = "localhost";

        //Verbindung zur Datenbank
        $conn = new PDO("mysql:host=$servername;dbname=$datenbankname", $benutzername, $benutzerpassword);

        //Set the PDO error node to exception
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




        //`shippingmethod`, `shippingname`, `shippingemail`, `shippingaddress`, `zip`, `city`, `paymentmethod`, `paymentname`, `paymentnumber`, `isclosed`

        //isclosed = 1 :)

        //Gui mail
        
        //Sucessfull info bei pay.php and return to startsite 
        
        //Close connection
        $conn = NULL;   
    } catch (PDOException $th) {
        echo $th -> getMessage();
    }

?>