<?php

session_start();

if ($_SESSION['active'] != 1) {

  //Sofort logout
  header("Location: ../startsite.html");

}

// echo $_SESSION['idcart'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC.de  Ihre Webshopbeschreibungen</title>
    <link rel="shortcut icon" type="image/png" href="/image/png-clipart-clock-clock-cartoon-thumbnail.ico"/>


    <!--Jquery-->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>

    <!--Bootstrap-->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--Font awesome-->
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">

    <script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>

    <!--Extra-->
    <link rel="stylesheet" href="../css/overview.css">
    <link rel="stylesheet" href="../css/startsite.css">
    <script type="text/javascript">
        function addproduct(productid) {
            var pid = productid;
            var id = 'amountitem' + productid;
            var amount = document.getElementById(id).value;
            $.ajax({
            type: 'POST',
            url: 'addproduct.php',
            data: {
                amount_product: amount,
                product_id: pid,
                cart_id: <?php echo $_SESSION['idcart']; ?>,
            },
            success: function(response){
                if(response){
                    swal({
                        title: "Eingefügt",
                        text: amount + " Produkt(e) wird in den Warenkorb erfolgreich eingefügt!",
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

        $(document).ready( () => {
            setInterval(() => {
                $.get("checkcustomeronline.php",{}, function(data) {
                    var elem = document.getElementById("customernumber");
                        elem.textContent = data;
                    });
            }, 60000);
        });

    </script>
</head>
<body>
    <header>
        <div class="row" id="navbar">
            <div class="row" id="help" style="align-self: flex-end;">
                <p style="text-align: end;">
                    <span style="margin-right: 20px;">Hallo <?php echo $_SESSION['firstname'].' '.$_SESSION['lastname'] ?>, Sie kaufen gerade mit <b id="customernumber">21</b> andere Kunden ein :)</span> 
                    <a href="logout.php" style="margin: 10px;">Ausloggen</a> 
                    <a href="help.html" style="margin: 10px;">Need help?</a>
                </p>

            </div>
            <div class="col-lg-2 col-md-3 col-sm-12 justify-content-center" onclick="window.location.href = '../startsite.html'" style="cursor: pointer;">
                <h2 style="margin-bottom: 10px">Armbanduhr.de</h2>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12" style="margin-bottom: 10px;">
                <div class="d-flex justify-content-center">
                    <div class="searchbar">
                      <input class="search_input" type="text" name="" placeholder="Suche nach Uhren, Marken und mehr...">
                      <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-1 col-sm-12">
                <div class = "row"  style="justify-content: flex-end; display: flex;">
                    <button style="background-color: #e7cd3c; color: #000; height: 60px; width:60px; margin-right: 20px;" class="btn" onclick="window.location.href='shoppingcart.php'"><i class="fas fa-shopping-cart"></i></button>            
                    <button style="background-color: #e7cd3c; color: #000; height: 60px; width:60px; margin-right: 50px" id="log" class="btn" onclick="window.location.href='../orderhistory.html'"><i class="fas fa-history"></i></button>
                </div>
            </div>
            <div>
                <p class="message" style="margin-top: 10px;">Herzlich Willkommen auf ihrer persönlichen Startseite!</p>
            </div>
        </div>
    </header>
    
    <section class="row" id="carousel">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 col-md-12 banner-sec">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../image/Uhr2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../image/Uhr2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../image/Uhr1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>Some representative placeholder content for the third slide.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
        <div class="col-lg-1"></div>
    </section>
    <section class="row" id="container">
        <div class="col-lg-2 col-sm-12">
            <nav class="navbar bg-light justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../startsite.html">Startseite</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Warenkorb</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bestellungen</a>
                    </li>                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Unsere Produkte
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <li><a class="dropdown-item" href="#">Damenuhren</a></li>
                          <li><a class="dropdown-item" href="#">Herrenuhren</a></li>
                        </ul>
                      </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Ihr Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <li><a class="dropdown-item" href="setpassword.php">Passwort zurücksetzen</a></li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Über uns</a>
                    </li>
                </ul>
              
              </nav>
        </div>
        <div class="col-lg-8 col-sm-12">
            <div class="row">
                <?php
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
          
                        $sql = "SELECT * FROM webshop.wsproduct";
                        foreach ($conn -> query($sql) as $row) {
                          echo '
                            <div class="col-lg-3 col-sm-4 col-6 product-card">
                                <img src="../'.$row['image'].' " alt="female_watch1" class="img-thumbnail">
                                <hr>
                                <span class="product-card-title">'.$row['title'].'</span> <br>
                                <span class="product-card-description">'.$row['description'].'</span> <br>
                                <span class="product-card-description"> Noch '.$row['productamount'].' Stück</span> <br>
                                <span class="product-card-price"><b>'.$row['price'].' &euro;</b></span> 
                                <div class="row" style="margin-top: 5px; text-align:center; padding: 0px 50px 0px 50px" >
                                    <input type="number" id="amountitem'.$row['productid'].'" placeholder="1" style="margin-top: 10px;display: block; margin-right: auto; margin-left: auto;">
                                </div>
                                <div>
                                    <button class="btn btn-block in-den-warenkorb" style = "display: block; margin-right: auto; margin-left: auto;" onclick="addproduct('.$row['productid'].');">In den Einkaufswagen</button>
                                </div>
                            </div>
                        ';
                        
                        }
                        //Close connection
                        $conn = NULL;   
                    } catch (PDOException $th) {
                        $handle = fopen ("error_login.txt", "w");
                        fwrite ($handle, $th -> getMessage());
                        fclose ($handle);
                    }

                ?>



            </div>
            <div class="d-grid" id="more">
                <button class="btn  btn-primary btn-block">More</button>
            </div>
        </div>
    </section>

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
<?php
    if ($_SESSION['ispwreseted'] == 0){
        echo '
            <script> swal({
                title: "Erstes Login!",
                text: "Sie müssen Ihr Passwort neu vergeben!",
                icon: "info",
                button: "OK!",
            }).then(function() {
                window.location = "setpassword.php";
                });
            </script>';
    } else {
        echo '
        <script> swal({
            title: "Hallo Herr/Frau '.$_SESSION['firstname']." ".$_SESSION['lastname'].'!",
            text: "Sie waren zuletzt am '.substr($_SESSION['lastlogin'],0,10).' online!",
            icon: "info",
            button: "OK!",
        });
        </script>            
        ';
    }
?>