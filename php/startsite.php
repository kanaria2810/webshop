<?php
session_start();

if (isset($_SESSION['active'])) {
    if ($_SESSION['active'] == 1) {
        header("Location: overview.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armbanduhr.de  Ihre Armbanduhren</title>
    <link rel="shortcut icon" type="image/png" href="../image/png-clipart-clock-clock-cartoon-thumbnail.ico"/>


    <!--Jquery-->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>

    <!--Bootstrap-->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--Font awesome-->
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!--Extra-->
    <link rel="stylesheet" href="../css/startsite.css">

    <!-- Sweetalert -->
    <script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            function login() {
                swal({
                    title: "Noch nicht zu kaufen",
                    text: "Loggen Sie ein, um zahlreiche Produkte kaufen zu können",
                    icon: "info",
                    buttons: ["Abbrechen", "Zum Loginseite"],
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = "../login.html"

                    }
                    });
            }

            function search() {
                var searchvalue = document.getElementById('searchinput').value;
                window.location.href = "search.php?keyword=" + searchvalue.trim();
            }

            function more() {
                swal('Funktion is der Zeit in der Entwicklungsphase');
            }

        </script>

</head>
<body>
    <header>
        <div class="row" id="navbar">
            <div class="col-lg-2 col-md-3 col-sm-12 justify-content-center" onclick="window.location.href = 'startsite.php'" style="cursor: pointer;">
                <h2>Armbanduhr.de</h2>
            </div>
            <div class="col-lg-7 col-md-8 col-sm-12">
                <div class="d-flex justify-content-center">
                    <div class="searchbar">
                      <input class="search_input" id="searchinput" type="text" name="" placeholder="Suche nach Uhren, Marken und mehr...">
                      <a href="javascript: search();" class="search_icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12" style="align-self: flex-end;">
                <div class="row" id="help"><a href="#">Need help?</a></div>
                <div class="row" id="log">
                    <p> <button class="btn" onclick="window.location.href='../login.html'"><b>Anmelden</b></button>
                        <button class="btn" onclick="window.location.href='../signup.html'"><b>Registrieren</b></button> </p>
                </div>
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
                            <h5></h5>
                            <p></p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../image/Uhr2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5></h5>
                            <p></p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../image/Uhr1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5></h5>
                            <p></p>
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
                        <a class="nav-link" href="#">Startseite</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login.html">Einloggen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../signup.html">Registrieren</a>
                    </li>                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Uhren
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <li><a class="dropdown-item" href="search.php?keyword=Damenuhr">Damenuhren</a></li>
                          <li><a class="dropdown-item" href="search.php?keyword=Herreuhr">Herrenuhren</a></li>
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
                            <div class="row" style="margin: 5px" >
                                <button class="btn btn-block in-den-warenkorb" onclick="login();">In den Einkaufswagen</button>
                            </div>
                        </div>';
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
                <button class="btn  btn-primary btn-block" onclick="more();">More</button>
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