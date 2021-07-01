<?php
    $sFirstname = "";
    $sLastname = "";
    $sUsername = "";
    $sPassword = "";
    $sAddress = "";
    $sCity = "";
    $sZip = "";
    $sActive = 0;
    $sLogin = "";


    if (isset($_POST['username'])) {
        $sUsername = $_POST["username"];
    }
    if (isset($_POST['firstname'])) {
        $sFirstname = $_POST["firstname"];
    }
    if (isset($_POST['lastname'])) {
        $sLastname = $_POST["lastname"];
    }
    if (isset($_POST['address'])) {
        $sAddress = $_POST["address"];
    }
    if (isset($_POST['city'])) {
        $sCity = $_POST["city"];
    }
    if (isset($_POST['zip'])) {
        $sZip = $_POST["zip"];
    }
    $sPassword = $sLastname.'!'.substr($sUsername, 0, strpos($sUsername, '@'));
    $sPassword = hash("sha512", $sPassword);


    try {
        //Datenbank settings
          $datenbankname = "webshop";
          $benutzername = "root";
          $benutzerpassword = "";
          $servername = "localhost";

        //Verbindung zur Datenbank
          $conn = new PDO("mysql:host=$servername; dbname=$datenbankname", $benutzername, $benutzerpassword);

        //Set the PDO error node to exception
          $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //SQL

            $sqlInsertUser = "INSERT INTO webshop.wsuser (id,username,firstname,lastname,password,address,city,zip,active,lastlogin,ispwreseted,token) VALUES (?,?,?,?,?,?,?,?,?,?,?,?) ";
            $stmt = $conn->prepare($sqlInsertUser);
            $stmt->execute(['',$sUsername,$sFirstname,$sLastname,$sPassword,$sAddress,$sCity,$sZip,$sActive,'',0,'']);

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30;url=startsite.php" />
    <title>Registrierungsbestätigung</title>
    <link rel="shortcut icon" type="image/png" href="../image/png-clipart-clock-clock-cartoon-thumbnail.ico"/>

    <!--Jquery-->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>

    <!--Bootstrap-->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--Font awesome-->
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!--Sweet alert-->
    <script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>

    <!--Extra-->
    <link rel="stylesheet" href="../css/login.css">

    <script type="text/javascript">
    function countdown() {
        var i = document.getElementById('counter');
        if (parseInt(i.innerHTML)<=0) {
            location.href = '../login.html';
        }
        if (parseInt(i.innerHTML)!=0) {
            i.innerHTML = parseInt(i.innerHTML)-1;
        }
    }
    setInterval(function(){ countdown(); },1000);

    
    <?php
    $htmlconfirmmail = "<h2> Herzlich wilkommen zu Armbanduhr.de! </h2> <h4>Sehr geehrte Herr/Frau ".$sFirstname." ".$sLastname."</h4>".
                        "<p>Sie haben sich für unser Armbanduhr.de registriert. Ihr Standardpassword ist ".$sLastname."!".substr($sUsername, 0, strpos($sUsername, '@'))."</p>".
                        "<p>Mit freundlichen Gr&uuml;ßen, <br>".
                        "Ihr Armbanduhr Team </p>";
    ?>

    function sendconfirmmail() {
        $.ajax({
        type: 'POST',
        url: 'phpmailer/sendmail.php',
        data: {
            // $emailaddress = "";
            // $nameaddress = "";

            // $subject = "";
            // $body = "";
            // $altbody = "";
            email_address : '<?php echo $sUsername; ?>',
            name_address : "<?php echo $sFirstname.' '.$sLastname ?>",
            subject : "Armbanduhr.de - Registrierungsconfirmation" ,
            body : "<?php echo $htmlconfirmmail ?>" ,
            alt_body :  '<?php echo "Sehr geehrte Herr/Frau ".$sFirstname." ".$sLastname.
                                    ", Sie haben sich f&uuml;r unser Armbanduhr.de registriert. Ihr Standardpassword ist ".$sLastname."!".substr($sUsername, 0, strpos($sUsername, '@')).
                                    "Mit freundlichen Gr&uuml;ßen, Ihr Armbanduhr Team " ?>'
        },
        success: function(response){
            console.log('Mail sent');    
            }
        });
    }
    </script>

</head>
<body>
    <div class="page-header">
        <a href="help.html" class="nav justify-content-end" style="margin: 10px 30px 0px 30px;">Need help?</a>
        <div class="row col col-sm-10" style="padding-left: 50px; cursor: pointer;" onclick="window.location.href = 'startsite.php'">
            <h4>Armbanduhr.de</h4>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row text-center" style="margin-top: 10%;">
            <h1>Vielen Dank!</h1>
            <br>
            <h2>Jetzt wird eine Bestätigungsemail an Ihrer registrierten E-mail-Adresse gesendet.</h2>
            <h4>Weitergeleitet zur Startseite in <span id="counter">30</span> second(s).</h4>
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
    <script>
        sendconfirmmail();
        swal({
            title: "Erfolgreich!",
            text: "Sie haben erfolgreich registriert!",
            icon: "success",
            button: "Alles klar!",
            });
    </script>
    
</body>
</html>

