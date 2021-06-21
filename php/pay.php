<?php

session_start();

if ($_SESSION['active'] != 1) {

  //Sofort logout
  header("Location: startsite.php");

}

$cid = $_SESSION['idcart'];


?>
<!--8. pay.html
    - Es gibt eine Checkbox, die den Datenschutz akzeptiert.
        Diese muss bestätigt sein, damit die Bestellung abgeschickt werden kann.
    - Nach dem Bezahlvorgang erhält der Benutzer eine Rechnungsemail mit den Daten: 
        Artikelmenge + Artikelname + Artikelanzahl + Versand + Gesamtsumme-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC.de Einkauf bestätigen</title>
    <link rel="shortcut icon" type="image/png" href="/image/png-clipart-clock-clock-cartoon-thumbnail.ico"/>

    <!--Jquery-->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>

    <!--Bootstrap-->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--Font awesome-->
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!--Extra-->
    <link rel="stylesheet" href="../css/startsite.css">
    <link rel="stylesheet" href="../css/pay.css">
    
    <script type="text/javascript">

    </script>
</head>
<body>
    <header>
        <div class="row" id="navbar">
            <div class="col-lg-2 col-md-3 col-sm-12 justify-content-center" onclick="window.location.href = '../startsite.html'" style="cursor: pointer;">
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
                    <p> <button class="btn" onclick="window.location.href='shoppingcart.php'"><b>Warenkorb</b></button>
                        <button class="btn" onclick="window.location.href='orderhistory.php'"><b>Bestellungen</b></button> </p>
                </div>
            </div>
        </div>
    </header>

<?php
  try {
    //Gesambetrag
    $total = 0;
    $totalrabatt = 0;
    $rabattrate = 0.15;
    $totalvalue = 0;
    $deliveryfee = 0;
    //User info
    $shippingname = '';
    $shippingemail = '';
    $shippingaddress = '';
    $city = '';
    $zip = '';


    //Datenbank settings
    $datenbankname = "webshop";
    $benutzername = "root";
    $benutzerpassword = "";
    $servername = "localhost";

    //Verbindung zur Datenbank
    $conn = new PDO("mysql:host=$servername;dbname=$datenbankname", $benutzername, $benutzerpassword);

    //Set the PDO error node to exception
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlcartitemwithproductamount = "SELECT * FROM webshop.wscartitem INNER JOIN webshop.wsproduct ON wscartitem.productid = wsproduct.productid WHERE cartid = $cid";
    foreach($conn -> query($sqlcartitemwithproductamount) as $row){
        $total += $row['amount']*$row['price'];
            if ($row['amount'] >= 10) {
                $totalrabatt += $row['amount']*$row['price']*$rabattrate;
            }
        }



    $sql = "SELECT * FROM webshop.wsorder WHERE idcart = '$cid'";
    foreach ($conn -> query($sql) as $row){
      $deliveryoption = $row['shippingmethod'];
      $shippingaddress = $row['shippingaddress'];
      $shippingemail = $row['shippingemail'];
      $shippingname = $row['shippingname'];
      $city = $row['city'];
      $zip = $row['zip'];
      switch ($deliveryoption) {
        case 'dpd':
          $deliveryfee = 3.99;
          break;
        case 'dhl':
            $deliveryfee = 5.99;
            break;
        case 'dhl-express':
              $deliveryfee = 14.99;
              break;        
      }
      $totalvalue = $row['totalvalue'];

    }


    $conn = NULL;   
  } catch (PDOException $th) {
      echo $th -> getMessage();
  }

?>

    <main class="container">
        <div class="py-5">
          <h2>Bestellung bestätigen</h2>
        </div>
    
        <div class="row g-5">
          <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-primary">Ihr Warenkorb</span>
            </h4>
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0">Artikelbetrag</h6>
                </div>
                <span class="text-muted">€ <?php echo $total ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0">Versandskosten</h6>
                  <small class="text-muted">Versandarten: <?php echo strtoupper($deliveryoption) ?></small>
                </div>
                <span class="text-muted">€ <?php echo $deliveryfee ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                  <h6 class="my-0">Mengenrabatt</h6>
                  <small class="text-muted">Bei Rechnung ab 10 Artikeln</small>
                </div>
                <span class="text-success">−€ <?php echo $totalrabatt ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span>Total (EUR)</span>
                <strong>€ <?php echo $totalvalue ?></strong>
              </li>
            </ul>
          </div>
          <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Rechnungsadresse</h4>
            <form class="needs-validation" method="POST" action="checkout.php">
              <div class="row g-3">
                <div class="col-sm-12">
                  <label for="firstName" class="form-label">Name</label>
                  <input type="text" name="shippingname" class="form-control" id="firstName" placeholder="" value="<?php echo $shippingname ?>" required>
                  <div class="invalid-feedback">
                    Bitte gültigen Namen eingeben.
                  </div>
                </div>
    
                <div class="col-12">
                  <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                  <input type="email" name="shippingemail" class="form-control" id="email" value="<?php echo $shippingemail ?>">
                  <div class="invalid-feedback">
                    Bitte gültige E-mailadresse eingeben für weitere Versand-Update.
                  </div>
                </div>
    
                <div class="col-12">
                  <label for="address" class="form-label">Adresse</label>
                  <input type="text" name="shippingaddress" class="form-control" id="address" value="<?php echo $shippingaddress ?>" required>
                  <div class="invalid-feedback">
                    Bitte gültige Versandsadresse eingeben.
                  </div>
                </div>
    

                <div class="col-md-3">
                  <label for="zip" class="form-label">PLZ</label>
                  <input type="text" name="zip" class="form-control" id="zip" value="<?php echo $zip ?>" required>
                  <div class="invalid-feedback">
                    PLZ erforderlich
                  </div>
                </div>    
                <div class="col-md-9">
                  <label for="address" class="form-label">Stadt</label>
                  <input type="text" name="address" class="form-control" id="address" city="<?php echo $city ?>" required>
                  <div class="invalid-feedback">
                    Bitte Ihre Stadt eingeben.
                  </div>
                </div>

              </div>
    
              <hr class="my-4">
    
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="same-address" required>
                <label class="form-check-label" for="same-address">Ich bestätige, die Datenschutzerklärung samt der dort enthaltenen Einwilligungserklärung gelesen zu haben und willige hiermit entsprechend ein. </label>
                <div class="invalid-feedback">
                  *
                </div>
              </div>
    
              <hr class="my-4">
    
              <h4 class="mb-3">Zahlungsarten</h4>
    
              <div class="my-3">
                  <div class="form-check">
                    <input name="paymentmethod" type="radio" class="form-check-input" value="sepa" checked required>
                    <label class="form-check-label" for="credit">Lastschrift (SEPA)</label>
                  </div>
                  <div class="form-check">
                    <input name="paymentmethod" type="radio" class="form-check-input" value="credit" required>
                    <label class="form-check-label" for="debit">Kreditkarte</label>
                  </div>
              </div>
              <div class="row gy-3" >
                <div class="col-md-6">
                  <label for="cc-name" class="form-label">Namen</label>
                  <input type="text" class="form-control" id="cc-name" name="paymentname" placeholder="" required>
                  <small class="text-muted">Vorständiger Name wie auf der Karte</small>
                  <div class="invalid-feedback">
                    Name erforderlich
                  </div>
                </div>
    
                <div class="col-md-6">
                  <label for="cc-number" class="form-label">IBAN/Kreditkartenummer</label>
                  <input type="text" class="form-control" id="cc-number" name="paymentnumber" placeholder="" required>
                  <div class="invalid-feedback">
                    IBAN erforderlich.
                  </div>
                </div>
    
              </div>
    
              <hr class="my-4">
    
              <button class="w-100 btn btn-primary btn-lg" type="submit">Bestellung bestätigen</button>
            </form>
          </div>
        </div>
    </main>
    <script>                    
      //Để check xem các field có validate không
      (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');
        

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
          .forEach(function (form) {
            form.addEventListener('submit', function (event) {
              if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
              }

              form.classList.add('was-validated')
            }, false)
          })
      })();
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