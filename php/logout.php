<?php

  session_start();

  $_SESSION = array();

  
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time()-42000, $params["path"],
        $params["domain"], $params["secure"], $params["httponly"]);
  }

  //Löschen der Session zum Schluss
  session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Logout</title>
    <link rel="shortcut icon" type="image/png" href="/image/png-clipart-clock-clock-cartoon-thumbnail.ico"/>

    <!--Jquery-->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>

    <!--Bootstrap-->
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--Font awesome-->
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!--Extra-->
    <link rel="stylesheet" href="css/reset.css">
</head>
<body>
    <div class="page-header">
        <a href="help.html" class="nav justify-content-end" style="margin: 10px 30px 0px 30px;">Need help?</a>
        <div class="row col col-sm-10" style="padding-left: 50px; cursor: pointer;" onclick="window.location.href = 'startsite.html'">
            <h4>Armbanduhr.de</h4>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row text-center" style="margin-top: 10%;">
            <h1>Vielen Dank!</h1>
            <br>
            <h2>Sie werden zur Startseite weitergeleitet.</h2>
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