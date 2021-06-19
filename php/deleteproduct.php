<?php

    $productid = 0;
    $cartid = 0;

    if (isset($_GET['pid'])) {
        $productid = $_GET['pid'];
    }
    if (isset($_GET['cid'])) {
        $cartid = $_GET['cid'];
    }

    try {
        //Datenbank settings
        $datenbankname = "webshop";
        $benutzername = "root";
        $benutzerpassword = "";
        $servername = "localhost";

      //Verbindung zur Datenbank
        $conn = new PDO("mysql:host=$servername;dbname = $datenbankname", $benutzername, $benutzerpassword);

        //Set the PDO error node to exception
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlDeleteItem = "DELETE FROM webshop.wscartitem WHERE cartid = '$cartid' AND productid = '$productid'";
        $conn->exec($sqlDeleteItem);
        
        //Else create new cartitem
        echo '1';
        //Close connection
        $conn = NULL;
    } catch (PDOException $th) {
        $handle = fopen ("error_login.txt", "w");
        fwrite ($handle, $th -> getMessage());
        fclose ($handle);
    }
    header("Location: shoppingcart.php");
    
?>