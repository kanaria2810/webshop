<?php
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

    try 
    {
        /*** mysql servername ***/
        $servername = 'localhost';

        /*** mysql username ***/
        $username = 'root';

        /*** mysql password ***/
        $password = '';

        /*** mysql databse ***/
        $dbname = "webshop";
        //Verbindung zur Datenbank
        $dbh = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        /*** echo a message saying we have connected ***/
        //echo 'Connected to database';
        $stmt = $dbh->prepare("SELECT * FROM webshop.wsuser where username = ?");
        $stmt->execute(array($sUsername));
        echo $stmt->rowCount();

    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }   


?>