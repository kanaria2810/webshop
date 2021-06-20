<?php

session_start();

if ($_SESSION['active'] != 1) {

  //Sofort logout
  header("Location: startsite.php");

}

$cid = $_SESSION['idcart'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC.de Warenkorbübersicht</title>
    <link rel="shortcut icon" type="image/png" href="../image/png-clipart-clock-clock-cartoon-thumbnail.ico"/>

    <!--Jquery-->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>

    <!--Bootstrap-->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--Font awesome-->
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!--Sweet Alert-->
    <script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>


    <!--Extra-->
    <link rel="stylesheet" href="../css/shoppingcart.css">
    <link rel="stylesheet" href="../css/startsite.css">

    <script>
        function addproduct(isadding,productid) {
            var pid = productid;
            var isa = isadding;
            var id = 'amount' + productid;
            var amount = parseInt(document.getElementById(id).textContent);
            if (amount == 0 & isa == 0) {
                return  swal({ title: "Fehler",
                        text: "Kann nicht weniger sein",
                        icon: "error",
                        button: "OK!",
                    });
            }
            $.ajax({
            type: 'POST',
            url: 'addproduct.php',
            data: {
                product_id: pid,
                cart_id: <?php echo $_SESSION['idcart']; ?>,
                is_adding: isa
            },
            success: function(response){
                if(response){
                    document.getElementById(id).textContent = (isadding) ? amount+1 : amount-1;
                    swal({
                        title: "Eingefügt",
                        text: "Produktanzahl erfolgreich geändert",
                        icon: "success",
                        button: "OK!",
                    });

                } else {
                    swal({
                        title: "Fehler",
                        text: "Produkt nicht verfügbar!",
                        icon: "error",
                        button: "OK!",
                    });
                }}
              });

        }  
    </script>

</head>
<body>
    <header>
        <div class="row" id="navbar">
            <div class="col-lg-2 col-md-3 col-sm-12 justify-content-center" onclick="window.location.href = 'overview.php'" style="cursor: pointer;">
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
                <div class="row">
                    <div class="col"></div>
                    <div class="col" id="help"><a href="help.html" style="font-size: medium;">Need help?</a></div>
                    <div class="col"><a href="logout.html" style="font-size: medium;">Ausloggen</a></div>
                </div>
                <div class="row" id="log">
                    <p> <button class="btn" onclick="window.location.href='#'"><b>Warenkorb</b></button>
                        <button class="btn" onclick="window.location.href='orderhistory.php'"><b>Bestellungen</b></button> </p>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <div class="col-lg-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>Ihr Warenkorb</b></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                            <div class="col-2"></div>
                            <div class="col">
                                <div class="row"><b>Produkte</b></div>
                            </div>
                            <div class="col-2"><b>Anzahl</b></div>
                            <div class="col">
                                <div class="row">
                                    <div class="col"><b>Preis/Stück</b> </div>
                                    <div class="col"> <b>Beitrag</b> </div>
                                    <div class="col"></div>
                                </div>
                            </div>

                    </div>
                    <?php
                        try {
                            //Anzahlprodukte
                            $numberitem = 0;
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

                            //Chọn các cart item mà có có cartid trùng
                            $sql = "SELECT * FROM webshop.wscartitem WHERE cartid= '$cid' ORDER BY productid";
                            $csql = $conn -> query($sql);

                            foreach($csql as $row){
                                $pamount = $row['amount'];
                                $productid = $row['productid'];
                                
                                $sql2 = "SELECT * FROM webshop.wsproduct WHERE productid= '$productid' ";
                                $csql2 = $conn -> query($sql2);
                                foreach ($csql2 as $row2) {
                                    $producttitle = $row2['title'];
                                    $productprice = $row2['price'];
                                    $total += $pamount * $productprice;
                                    $numberitem += $pamount;
                                    if ($pamount>=10) {
                                        $totalrabatt += $rabattrate * $pamount * $productprice;
                                    }
                                    $productimage = $row2['image'];
                                    $productcategoryid = $row2['categoryid'];
                                    $sql3 = "SELECT * FROM webshop.wscategory WHERE categoryid= '$productcategoryid'";
                                    $csql3 = $conn -> query($sql3);
                                    foreach ($csql3 as $row3) {
                                        $categorytitle = $row3['title'];
                                        echo '
                                        <div class="row main align-items-center">
                                        <div class="col-2"><img class="img-fluid" src="../'.$row2['image'].'"></div>
                                        <div class="col">
                                            <div class="row text-muted">'.$categorytitle.'</div>
                                            <div class="row"><b>'.$producttitle.'</b></div>
                                        </div>
                                        <div class="col-2"><a href="javascript:addproduct(0,'.$productid.');">&minus;</a>
                                                <button type="text" class="btn" id="amount'.$productid.'" style = "padding: none; margin:none; width: 60px; height: 40px">'.$pamount.'</button>
                                                <a href="javascript:addproduct(1,'.$productid.');">+</a></div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col" id="price">'.$productprice.' &euro;/Stück</div>
                                                <div class="col">'.$productprice*$pamount.' &euro;</div>
                                                <div class="col"><a href="deleteproduct.php?pid='.$productid.'&cid='.$_SESSION['idcart'].'" class="close"><i class="fas fa-trash"></i></a></div>
                                            </div>
            
                                        </div>
            
                                    </div>';
                                    }
                                }
                            }


                            //Set the PDO error node to exception
                            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            //Close connection
                            $conn = NULL;   
                        } catch (PDOException $th) {
                            echo $th -> getMessage();
                        } 
                    ?>
                        

                </div>

                    <div class="back-to-shop"><a href="overview.php">&leftarrow; Back to shop</a></div>
                </div>
                <div class="col-lg-4 summary">
                    <div>
                        <h5 style="margin-top: 4vh"><b>Summary</b></h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="row">
                            <div class="col"><strong>Anzahl Produkte:</strong></div>
                            <div class="col" style="text-align:right" ><?php echo $numberitem ?></div>
                        </div>
                        <div class="row">
                            <div class="col"><strong>Summe Artikeln:</strong></div>
                            <div class="col" style="text-align:right" > <?php echo $total ?> &euro;</div>
                        </div>
                        <div class="row">
                            <div class="col"><strong>Rabattaktion:</strong></div>
                            <div class="col" style="text-align:right"  > - <?php echo $totalrabatt ?> &euro;</div>
                        </div>
                    </div>
                    <hr>
                    <form class="needs-validation" method="POST" action="gotopay.php">
                        <div>
                            <h5 style="margin-top: 4vh"><b>Lieferoption</b></h5>
                            <select id="deliveryoption" name="delivery" onchange="show(<?php echo $total-$totalrabatt?>);">
                                <option value="3.99" selected>DPD - &euro; 3,99</option>
                                <option value="5.99">DHL - &euro; 5,99</option>
                                <option value="14.99">DHL-Express - &euro; 14,99</option>
                            </select>                            
                        </div>
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col"><h5><b>Gesamtsumme</b> </h5></div>
                            <div class="col" style="text-align:right"><span name="totalorder" id = "totalorder"></span>  &euro; </div>
                        </div>                        
                        <div class="row" style="margin: 0px 10px 0px 10px;"> <button class="btn btn-warning btn-block" type="submit"><strong>Zur Kasse</strong></button> </div>

                        <script>
                            (function () {
                                'use strict'
                                $.ajax({
                                    type: 'POST',
                                    url: 'checkproductavailable.php',
                                    data: {
                                        cart_id: <?php echo $_SESSION['idcart']; ?>
                                    },
                                    success: function(response){
                                        if(response!=0){

                                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                            var forms = document.querySelectorAll('.needs-validation');
                                            

                                            // Loop over them and prevent submission
                                            Array.prototype.slice.call(forms)
                                                .forEach(function (form) {
                                                form.addEventListener('submit', function (event) {
                                                    event.preventDefault()
                                                    event.stopPropagation()
                                                }, false)
                                                })
                                             swal({
                                                title: "Fehler",
                                                text: "Ein/Mehrere Produkte is nicht verfügbar",
                                                icon: "error",
                                                button: "OK!",
                                                });                                                
                                        }
                                    }
                                    });

                                // // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                // var forms = document.querySelectorAll('.needs-validation');
                                

                                // // Loop over them and prevent submission
                                // Array.prototype.slice.call(forms)
                                //     .forEach(function (form) {
                                //     form.addEventListener('submit', function (event) {
                                //         if (!checkallproductavailable()) {
                                //         event.preventDefault()
                                //         event.stopPropagation()
                                //         } 
                                //     }, false)
                                //     })
                                })();
                        </script>


                    </form>


                </div>
            </div>
        </div>
    </div>
    <script>
        var e = document.getElementById("deliveryoption");
        function show() {
            var delivery = e.value;
            var totalorder = document.getElementById("totalorder");
            var x = <?php echo $total-$totalrabatt?>;
            totalorder.textContent = (x + parseFloat(delivery)).toFixed(2);
        }
        e.onchange=show;
        show();
    </script>
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