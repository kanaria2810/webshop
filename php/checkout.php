<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=	, initial-scale=1.0">
    <title>Bestätigen...</title>
    <link rel="shortcut icon" type="image/png" href="/image/png-clipart-clock-clock-cartoon-thumbnail.ico"/>

    <script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>
    
</body>
</html>
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
    if (isset($_POST['shippingname'])) {
        $shippingname = $_POST['shippingname'];
    }
    if (isset($_POST['shippingemail'])) {
        $shippingemail = $_POST['shippingemail'];
    }
    if (isset($_POST['shippingaddress'])) {
        $shippingaddress = $_POST['shippingaddress'];
    }
    if (isset($_POST['zip'])) {
        $zip = $_POST['zip'];
    }
    if (isset($_POST['city'])) {
        $city = $_POST['city'];
    }
    if (isset($_POST['paymentmethod'])) {
        $paymentmethod = $_POST['paymentmethod'];
    }
    if (isset($_POST['paymentname'])) {
        $paymentname = $_POST['paymentname'];
    }
    if (isset($_POST['paymentnumber'])) {
        $paymentnumber = $_POST['paymentnumber'];
    }
    // echo $paymentmethod;
    // echo $paymentname;

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

        $sqlcheckout = "UPDATE webshop.wsorder SET shippingname = '$shippingname', shippingemail = '$shippingemail', shippingaddress = '$shippingaddress', zip = '$zip', city = '$city', paymentmethod = '$paymentmethod', paymentname = '$paymentname', paymentnumber = '$paymentnumber', placedtime = CURRENT_TIMESTAMP(), isclosed = 1 WHERE idcart = $cid";
        $conn -> exec($sqlcheckout);
        // echo 'ok';
        //update product amount
        $sql = "SELECT * FROM webshop.wscartitem WHERE cartid= '$cid' ORDER BY productid";
        $csql = $conn -> query($sql);

        foreach($csql as $row){
            $pamount = $row['amount'];
            $productid = $row['productid'];
            
            $sql2 = "SELECT * FROM webshop.wsproduct WHERE productid= '$productid' ";
            $csql2 = $conn -> query($sql2);
            foreach ($csql2 as $row2) {
                $newamount = $row2['productamount'] - $pamount; 
                $sql3 = "UPDATE webshop.wsproduct SET productamount = '$newamount' WHERE productid = '$productid'";
                $conn -> query($sql3);
            }
        }
        //Gui mail
        
        //Sucessfull info bei pay.php and return to startsite 
        
        //Close connection
        $conn = NULL;   
    } catch (PDOException $th) {
        echo $th -> getMessage();
    }
    echo (
        '<script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
        <script> swal({
            title: "Bestellung abgegeben",
            text: "Ihnen wird eine Bestellungsbestätigung per E-mail gesendet",
            icon: "success",
            button: "OK!",
          }).then(function() {
            window.location = "newcart.php";
            });
          </script>'
    );

?>