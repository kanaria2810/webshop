<!-- - Nur eingeloggte User dürfen auf die Seite kommen
    - Es gibt eine extra Seite in der die Bestellungen des Benutzers zu sehen sind.
    - Hier gibt es bei jeder Bestellung einen Button („gleiche Bestellung nochmal“) 
        mit der die Bestellung erneut bestellt werden kann
        (Soll komplett automatisch funktionieren - 1 Click buy again)
    - Der Benutzer bekommt dann auch wieder eine Rechnungsemail mit den Daten:
        Artikelmenge + Artikelname + Artikelanzahl + Versand + Gesamtsumme-->
<?php 

    session_start();
            
    if ($_SESSION['active'] != 1) {

        //Sofort logout
        header("Location: startsite.php");
    
    }
    
    $sid = $_SESSION['id']; 


    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meine Bestellungen </title>
    <link rel="shortcut icon" type="image/png" href="../image/png-clipart-clock-clock-cartoon-thumbnail.ico"/>


    <!--Jquery-->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>

    <!--Bootstrap-->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--Font awesome-->
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css">

    <!-- Sweetalert -->
    <script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>


    <!--Extra-->
    <link rel="stylesheet" href="../css/startsite.css">
    <link rel="stylesheet" href="../css/orderhistory.css">
    <script>
        function showContent(idcontent) {
            var linkTo = document.getElementById("inhalt" + idcontent);
            var show = document.getElementById("show" + idcontent);
            if (linkTo.style.display === "none") {
                linkTo.style.display = "block";
                show.innerText = "Bestellungsinhalt ausblenden"
            } else {
                linkTo.style.display = "none";
                show.innerText = "Bestellungsinhalt anzeigen"
            }
        }

        function rebuy(idorder) {
            var ido = idorder;
            //Bestellung nochmals kaufen
            console.log('rebuy');
            //Confirm --> aufruf eine php nochmalskaufen
            //Dann eine Bestätigungszeigen
            swal({
                    title: "Nochmals kaufen?",
                    text: "Ihnen wird eine Bestellungsbestätigung per E-mail gesendet",
                    icon: "info",
                    buttons: ["Abbrechen", "Nochmals kaufen!"],
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        //new Warenkorb und submitt cart
                        $.ajax({
                            type: 'POST',
                            url: 'autosubmitcart.php',
                            data: {
                                user_id: <?php echo $_SESSION['id'] ?>,
                                order_id: ido
                            },
                            success: function(response){
                                var id_numbers = JSON.parse(response);
                                console.log(id_numbers[0]);
                                if(id_numbers[0] == 0){

                                    $.ajax({
                                        type: 'POST',
                                        url: 'phpmailer/sendmail.php',
                                        data: {
                                            email_address : id_numbers[1],
                                            name_address : id_numbers[2],
                                            subject : "Armbanduhr.de - Ihre Zahlung an Armbanduhr.de" ,
                                            body : id_numbers[3] ,
                                            alt_body :  id_numbers[4]
                                        },
                                        success: function(response){
                                            console.log('Mail sent');    
                                            }
                                    });
                                    swal({
                                        title: "Bestellung nochmals aufgegeben",
                                        text: "Bestätigungsemail wird Ihnen gesendet",
                                        icon: "success",
                                        button: "OK!",
                                    }).then(() => {location.reload();});
                                } else {
                                    swal({
                                        title: "Fehlende Produkte!",
                                        text: "Produkt nicht verfügbar!",
                                        icon: "error",
                                        button: "OK!",
                                    });
                                }
                                

                            }
                            });

                    }
                    });
            }
            function deleteorder(idorder) {
                swal('Funktion ist der Zeit in der Entwicklungsphase')
            }

    </script>
</head>
<body>
    <header>
        <div class="row" id="navbar">
            <div class="col-lg-2 col-md-3 col-sm-12 justify-content-center" onclick="window.location.href = 'startsite.html'" style="cursor: pointer;">
                <h2>Armbanduhr.de</h2>
            </div>
            <div class="col-lg-7 col-md-8 col-sm-12">
                <div class="d-flex justify-content-center">
                    <div class="searchbar">
                      <input class="search_input" type="text" name="" placeholder="Suche nach Uhren, Marken und mehr...">
                      <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12" style="align-self: flex-end;">
                <div class="row" id="help"><a href="help.html">Need help?</a></div>
                <div class="row" id="log">
                    <p> <button class="btn" onclick="window.location.href='shoppingcart.html'"><b>Warenkorb</b></button>
                        <button class="btn" onclick="window.location.href='#'"><b>Bestellungen</b></button> </p>
                </div>
            </div>
        </div>
    </header>
    <div class="container" style="margin-top: 20px;">
        <h2>Meine Bestellungen</h2>
        <hr>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row">   
<?php 
    try {


        //Datenbank settings
        $datenbankname = "webshop";
        $benutzername = "root";
        $benutzerpassword = "";
        $servername = "localhost";

        //Verbindung zur Datenbank
        $conn = new PDO("mysql:host=$servername; dbname = $datenbankname", $benutzername, $benutzerpassword);

        //Set the PDO error node to exception
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



        //Iduser -> Produktid -> Warenkorb
        $sqlfindorder = "SELECT * FROM webshop.wsorder WHERE iduser =  $sid AND isclosed = 1";
        foreach ($conn -> query($sqlfindorder) as $row) {
            $cartid = $row['idcart'];
            $orderid = $row['idorder'];
            $sqlcartitem = "SELECT * FROM webshop.wscartitem INNER JOIN webshop.wsproduct ON wscartitem.productid = wsproduct.productid WHERE cartid = $cartid ";
            $artikel = "";
            $totalamount = 0;

            
            foreach($conn -> query($sqlcartitem) as $row2){
                $totalamount += $row2['amount'];
                $artikel .= '<div> 
                                <img class="img-thumbnail" src="../'.$row2['image'].'" alt="Armbanduhr">
                                <div>
                                    <strong>'.$row2['title'].'</strong>
                                    <p>Anzahl: '.$row2['amount'].'</p>
                                </div>
                            </div>';
            }
            echo '                        
                <div class="col-md-12">
                    <div class="pull-right"><label class="badge bg-success">Aufgegeben</label></div>
                    <br>
                    <span><strong>Bestellungerstellt am '.substr($row['placedtime'],0,10).'</strong></span> <br>
                    Artikelanzahl : '.$totalamount.' <br>
                    Gesamtsumme: '.$row['totalvalue'].' € <br>
                    Versandsadresse: '.$row['shippingname'].' - '.$row['shippingaddress'].', '.$row['zip'].' '.$row['city'].' <br>
                    <a href="javascript:showContent('.$orderid.')" id="show'.$orderid.'">Bestellungsinhalt zeigen</a>
                    <div class="row" style="display: none; margin-top: 30px; margin-left: 30px;" id="inhalt'.$orderid.'">'.$artikel.'
                    </div>
                <br> <br>
                <a data-placement="top" class="btn btn-danger fas fa-trash-alt" href="javascript: deleteorder('.$row['idorder'].');" title="Danger" id="bestellung"></a>
                <button onclick="rebuy('.$row['idorder'].');" class="btn btn-success">Nochmals kaufen</button>
                <br><hr>
            </div>';
        }
    } catch (PDOException $th) {
        echo $th -> getMessage();
    }
        
        ?>

                    </div>
                </div>
            </div>
            <hr>

            <hr>
        </div>
        <div class="panel-footer"></div>
    </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Unsere AGB</a></li>
            <li class="list-inline-item"><a href="#">Hinweis zur Cookies</a></li>
            <li class="list-inline-item"><a href="#">Copyright</a></li>
          </ul>
        <div class="row justify-content-center">
            Mustergesellschaft GmbH MusterStraße 4, 123456 Musterstadt
        </div>
    </footer>
</body>
</html>