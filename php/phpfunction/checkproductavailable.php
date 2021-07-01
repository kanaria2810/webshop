<?php
    //cartid
    session_start();

    if ($_SESSION['active'] != 1) {
    
      //Sofort logout
      header("Location: ../startsite.php");
    
    }
    $cartid = 0;

    if (isset($_POST['cart_id'])) {
        $cartid = $_POST['cart_id'];
    }

    try {
        //Anzahlprodukte
        $numberitem = 0;

        //Datenbank settings
        $datenbankname = "webshop";
        $benutzername = "root";
        $benutzerpassword = "";
        $servername = "localhost";

        //Verbindung zur Datenbank
        $conn = new PDO("mysql:host=$servername;dbname=$datenbankname", $benutzername, $benutzerpassword);

        //Set the PDO error node to exception
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        //für alle Produkte im Warenkorb --> check all warenkorb cartitem if their amounts are smaller than the amount in warehouse
        $sqlcartitemwithproductamount = "SELECT * FROM webshop.wscartitem INNER JOIN webshop.wsproduct ON wscartitem.productid = wsproduct.productid WHERE cartid = $cartid";
        foreach($conn -> query($sqlcartitemwithproductamount) as $row){
            if ($row['amount'] > $row['productamount']) {
                $numberitem += 1;
            }
        }

        echo $numberitem;

        //Close connection
        $conn = NULL;   
        } catch (PDOException $th) {
            echo $th -> getMessage();
        }

?>