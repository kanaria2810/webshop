<!--  Nach dem Bezahlvorgang erhält der Benutzer eine Rechnungsemail mit den Daten: Artikelmenge + Artikelname + Artikelanzahl + Versand + Gesamtsumme -->
<?php
        session_start();

        if ($_SESSION['active'] != 1) {
        
          //Sofort logout
          header("Location: ../startsite.php");
        
        }
        $sUsername = $_SESSION['username'];
        $sFirstname = $_SESSION['firstname'];
        $sLastname = $_SESSION['lastname'];

        //Find order


        $cid = $_SESSION['idcart']; 
        $shippingname="";
        $shippingemail="";
        $shippingaddress="";
        $zip="";
        $city="";
        $paymentmethod="";
        $paymentname="";
        $paymentnumber="";

        $idorder = 0;
        $shippingmethod = "";
        $totalvalue = 0;
        $shippingfee = 0;
        $amount = 0;

        $articles = "";
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
        $htmlconfirmmail = ' <h2>Best&auml;tigung Ihres Einkaufs</h2> <b>Sehr geehrte Herr/Frau '.$shippingname.',</b>'.
                        '<p>hiermit bestätigen wir Ihr Einkauf mit folgenden Informationen:</p><ul>'.
                        '<li>Versandadresse: '.$shippingaddress.', '.$zip.' '.$city;
        $alternativeconfirmmail = "";   

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
        $sqltakeorderinfo = "SELECT idorder,shippingmethod,totalvalue FROM webshop.wsorder WHERE idcart = $cid";
        foreach ($conn -> query($sqltakeorderinfo) as $row) {
            $idorder = $row['idorder'];
            $shippingmethod = $row['shippingmethod'];
            $totalvalue = $row['totalvalue'];
        }
        switch ($shippingmethod) {
            case 'dpd':
                $shippingfee = 3.99;
                break;
            case 'dpd':
                $shippingfee = 5.99;
                break;
            case 'dhl-express':
                $shippingfee = 14.99;
                break;    

            default:
                $shippingfee = 3.99;
                break;
        }
        $htmlconfirmmail .= '<li>Versandsart: '.strtoupper($shippingmethod).'</li> <li>Versandskosten: '.$shippingfee."</li> </ul> <table border='1'> <thead> <th>Artikelname</th><th>Anzahl</th></thead>";
        // echo 'ok';
        //update product amount
        $sql = "SELECT * FROM webshop.wscartitem WHERE cartid= '$cid' ORDER BY productid";
        $csql = $conn -> query($sql);

        foreach($csql as $row){
            $pamount = $row['amount'];
            $productid = $row['productid'];
            $amount += $pamount;
            
            $sql2 = "SELECT * FROM webshop.wsproduct WHERE productid= '$productid' ";
            $csql2 = $conn -> query($sql2);
            foreach ($csql2 as $row2) {
                $newamount = $row2['productamount'] - $pamount; 
                $sql3 = "UPDATE webshop.wsproduct SET productamount = '$newamount' WHERE productid = '$productid'";
                $conn -> query($sql3);
                $htmlconfirmmail .= ' <tr> <td> '.$row2["title"].'</td> <th>'.$row['amount'].'</th> </tr>';
            }
        }

        $htmlconfirmmail .= "</table><p><b>Artikelmenge: ".$amount."</b></p> <p><b>Gesamtsumme: ".$totalvalue."&euro;</b></p> Mit freundlichen Grüßen <br> Ihr Armbanduhr.de" ;
        //Gui mail


        //Close connection
        $conn = NULL;   
        } catch (PDOException $th) {
        echo $th -> getMessage();
        }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content=" initial-scale=1.0">
    <title>Bestätigen...</title>
    <link rel="shortcut icon" type="image/png" href="../../image/png-clipart-clock-clock-cartoon-thumbnail.ico"/>

    <!--Jquery-->
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>

    <!--Bootstrap-->
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--Font awesome-->
    <link rel="stylesheet" href="../../node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!--Extra-->
    <link rel="stylesheet" href="../../css/startsite.css">

    <script src="../../node_modules/sweetalert/dist/sweetalert.min.js"></script>


    <script>


    </script>

</head>
<body>


    <script> 
        swal({
            title: "Bestellung abgegeben",
            text: "Ihnen wird eine Bestellungsbestätigung per E-mail gesendet",
            icon: "success",
            button: "OK!",
        }).then(function() {
            window.location = "newcart.php";
            });

        $.ajax({
            type: 'POST',
            url: '../phpmailer/sendmail.php',
            data: {
                email_address : '<?php echo $sUsername; ?>',
                name_address : "<?php echo $sFirstname.' '.$sLastname ?>",
                subject : "Armbanduhr.de - Ihre Zahlung an Armbanduhr.de" ,
                body : "<?php echo $htmlconfirmmail ?>" ,
                alt_body :  '<?php echo $alternativeconfirmmail ?>'
            },
            success: function(response){
                console.log('Mail sent');    
                }
        });

      </script>


</body>
</html>
