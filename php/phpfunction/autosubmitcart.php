

<?php 
    session_start();

    if ($_SESSION['active'] != 1) {
    
        //Sofort logout
        header("Location: ../startsite.php");
    
    }
    $sid = $_SESSION['id'];
    $idorder = 0;

    $amountmissingproduct = 0;
    
    if (isset($_POST['order_id'])) {
        $idorder = $_POST['order_id'];
    }

    $idcart = "";
    $totalvalue = 0;
    $shippingmethod = "";
    $shippingname="";
    $shippingemail="";
    $shippingaddress="";
    $zip="";
    $city="";
    $paymentmethod="";
    $paymentname="";
    $paymentnumber="";

    $shippingfee = 0;
    $amount = 0;

    $htmlconfirmmail = "";
    $alternativeconfirmmail = "";

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

        $sqltakeinformation = "SELECT * FROM webshop.wsorder WHERE idorder = '$idorder'";
        foreach ($conn -> query($sqltakeinformation) as $row) {
            $idcart = $row['idcart'];
            $totalvalue = $row['totalvalue'];
            $shippingmethod = $row['shippingmethod'];
            $shippingname=$row['shippingname'];
            $shippingemail=$row['shippingemail'];
            $shippingaddress=$row['shippingaddress'];
            $zip=$row['zip'];
            $city=$row['city'];
            $paymentmethod=$row['paymentmethod'];
            $paymentname=$row['paymentname'];
            $paymentnumber=$row['paymentnumber'];
        }

        $htmlconfirmmail = ' <h2>Best&auml;tigung Ihres Einkaufs</h2> <b>Sehr geehrte Herr/Frau '.$shippingname.',</b>'.
        '<p>hiermit bestätigen wir Ihr Einkauf mit folgenden Informationen:</p><ul>'.
        '<li>Versandadresse: '.$shippingaddress.', '.$zip.' '.$city;

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


        //Check if all products are available
        $sql = "SELECT * FROM webshop.wscartitem WHERE cartid= '$idcart' ORDER BY productid";
        $csql = $conn -> query($sql);

        foreach($csql as $row){
            $pamount = $row['amount'];
            $productid = $row['productid'];
            $amount += $pamount;

            
            //count missing product
            $sql2 = "SELECT * FROM webshop.wsproduct WHERE productid= '$productid' ";
            $csql2 = $conn -> query($sql2);
            foreach ($csql2 as $row2) {
                $newamount = $row2['productamount'] - $pamount; 
                if ($newamount <0) {
                    $amountmissingproduct++;
                } 
            }
        }

        //if there is no missing product
        if ($amountmissingproduct == 0) {
            $sqlorder = "INSERT INTO webshop.wsorder (idorder,iduser,idcart,totalvalue,shippingmethod,shippingname,shippingemail,shippingaddress,zip,city,paymentmethod,paymentname,paymentnumber,placedtime,isclosed) VALUES ('', $sid, $idcart, $totalvalue, '$shippingmethod', '$shippingname', '$shippingemail', '$shippingaddress', '$zip', '$city', '$paymentmethod', '$paymentname', '$paymentnumber', CURRENT_TIMESTAMP(), 1)";
            $conn -> exec($sqlorder);

            //set new amount for product
            $sql = "SELECT * FROM webshop.wscartitem WHERE cartid= '$idcart' ORDER BY productid";
            $csql = $conn -> query($sql);
            foreach($csql as $row){
                $pamount = $row['amount'];
                $productid = $row['productid'];
                $sql2 = "SELECT * FROM webshop.wsproduct WHERE productid= '$productid' ";
                $csql2 = $conn -> query($sql2);
                foreach ($csql2 as $row2) {
                    $newamount = $row2['productamount'] - $pamount; 
                    //set new amount for product
                    $sql3 = "UPDATE webshop.wsproduct SET productamount = '$newamount' WHERE productid = '$productid'";
                    $conn -> query($sql3);
                    $htmlconfirmmail .= ' <tr> <td> '.$row2["title"].'</td> <th>'.$row['amount'].'</th> </tr>';

                }
            }
            $htmlconfirmmail .= "</table><p><b>Artikelmenge: ".$amount."</b></p> <p><b>Gesamtsumme: ".$totalvalue."&euro;</b></p> Mit freundlichen Grüßen <br> Ihr Armbanduhr.de" ;

            echo json_encode([$amountmissingproduct, $_SESSION['username'], $_SESSION['firstname'].' '.$_SESSION['lastname'], $htmlconfirmmail, $alternativeconfirmmail ]);
        }

        //Close connection
        $conn = NULL;
    } catch (PDOException $th) {
        $handle = fopen ("error_login.txt", "w");
        fwrite ($handle, $th -> getMessage());
        fclose ($handle);  
    }
?>




