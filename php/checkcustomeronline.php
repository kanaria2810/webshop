<?php
    $count="";
    try {
        //Datenbank settings
          $datenbankname = "webshop";
          $benutzername = "root";
          $benutzerpassword = "";
          $servername = "localhost";
    
        //Verbindung zur Datenbank
          $conn = new PDO("mysql:host=$servername;dbname=$datenbankname", $benutzername, $benutzerpassword);
    
        //Set the PDO error node to exception
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT COUNT(*) FROM webshop.wsuser WHERE active=1";
        $res = $conn -> query($sql);
        $count = $res -> fetchColumn();
    
    
        //Close connection
        $conn = NULL;   
    } catch (PDOException $th) {
        echo $th -> getMessage();
    }
    echo $count;
?>