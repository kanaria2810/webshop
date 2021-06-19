<?php
//Was machen die hier?
//1. Check session
session_start();

if ($_SESSION['active'] != 1) {
    
    //Sofort logout
    header("Location: startsite.php");
  
  }

  $cid = $_SESSION['idcart']; 
  $total = 0;
//2. add delivery option to order
if (isset($_POST['delivery'])) {
    $deliveryfee = $_POST['delivery'];
}
$deliveryoption = "";
switch ($deliveryfee) {
    case '5.99':
        $deliveryoption = "dhl";
        break;
    case '14.99':
        $deliveryoption = "dhl-express";
        break;
    case '3.99': 
        $deliveryoption = 'dpd';
        break;
    default:
        $deliveryoption = "dpd";
        break;
}
echo $deliveryoption;

try {
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

    //define totalorder
    $sqlcartitemwithproductamount = "SELECT * FROM webshop.wscartitem INNER JOIN webshop.wsproduct ON wscartitem.productid = wsproduct.productid WHERE cartid = $cid";
    foreach($conn -> query($sqlcartitemwithproductamount) as $row){
        $total += $row['amount']*$row['price'];
            if ($row['amount'] >= 10) {
                $totalrabatt += $row['amount']*$row['price']*$rabattrate;
            }
        }
        echo $total;
        echo $totalrabatt;
        $totalvalue = $total - $totalrabatt + $deliveryfee;



    //Add deliveryoption & gesamtkosten to order = insert to wsorder set deliveryoption
    $sqladddeliveryandvalue = "UPDATE webshop.wsorder SET shippingmethod = '$deliveryoption', totalvalue = '$total' WHERE idcart = $cid";
    $conn -> query($sqladddeliveryandvalue);

    //Close connection
    $conn = NULL;   
} catch (PDOException $th) {
    echo $th -> getMessage();
}

header('Location: pay.php');


?>