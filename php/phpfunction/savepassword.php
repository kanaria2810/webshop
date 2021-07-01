<?php

//If not logged in --> startsite
session_start();

$token = '';
$emailaddress = '';
$changeSuccess = false;

//nicht login
if (!isset($_SESSION['active'])) {

  if (isset($_SESSION['token']) && isset($_SESSION['emailaddress'])) {

    $token = $_SESSION['token'];
    $emailaddress = $_SESSION['emailaddress'];

    $newpw = "";
    if (isset($_POST['password'])) {
      $newpw = $_POST['password'];
    }
    echo $emailaddress;
    echo $token;
    
    //Verbindung zur Datenbank 
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
  
        //sql
        $sql = "UPDATE webshop.wsuser SET password = '$newpw' WHERE username = '$emailaddress' AND token = '$token'";
        $conn->exec($sql);
        $changeSuccess = true;
        //Close connection
        $conn = NULL;   
      } catch (PDOException $th) {
          $handle = fopen ("error_login.txt", "w");
          fwrite ($handle, $th -> getMessage());
          fclose ($handle);
      }
  } else header("Location: ../startsite.php"); //Sofort logout
} else {
  
  $sid = $_SESSION['id'];
  $sIspwreseted = $_SESSION['ispwreseted']+1;
  $newpw = "";
  if (isset($_POST['password'])) {
    $newpw = $_POST['password'];
  }
  //Verbindung zur Datenbank 
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

      //sql
      $sql = "UPDATE webshop.wsuser SET password = '$newpw' WHERE id = $sid";
      $conn->exec($sql);
      $sql2 = "UPDATE webshop.wsuser SET ispwreseted = '$sIspwreseted' WHERE id = $sid";
      $conn->exec($sql2);
      $changeSuccess = true;
      $_SESSION['ispwreseted'] += 1;
      //Close connection
      $conn = NULL;   
    } catch (PDOException $th) {
        $handle = fopen ("error_login.txt", "w");
        fwrite ($handle, $th -> getMessage());
        fclose ($handle);
    }

  }




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <script src="../../node_modules/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    
  <?php
    echo $changeSuccess;
      if ($changeSuccess) {
        echo '
          <script> swal({
              title: "OK!",
              text: "Passwort erfolgreich ändern",
              icon: "success",
              button: "OK!",
            }).then(function() {
              window.location.href = "../overview.php";
              });
            </script>';
      }
  ?>
</body>
</html>

