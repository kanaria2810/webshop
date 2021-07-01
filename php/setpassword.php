<?php

$token = '';
$emailaddress = '';

session_start();

if (isset($_GET['token']) && isset($_GET['emailaddress'])) {

    $token = $_GET['token'];
    $_SESSION['token'] = $token;
    $emailaddress = $_GET['emailaddress'];
    $_SESSION['emailaddress'] = $emailaddress;

} else {

    if ($_SESSION['active'] != 1) {

    //Sofort logout
    header("Location: ../login.html");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password wiederherstellen</title>
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

    <!--generatehash-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsSHA/2.0.2/sha.js"></script>



    <!--Extra-->
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/startsite.css">
    <style>
        span {
            height: 50px;
            width: 50px;
        }
    </style>
    <script>
        function generatehash() {
            var pwdObj = document.getElementById('password');
            var hashObj = new jsSHA("SHA-512", "TEXT", {numRounds: 1});
            hashObj.update(pwdObj.value);
            var hash = hashObj.getHash("HEX");
            pwdObj.value = hash;
        }
        function check () {
            var p = document.forms["setpw"]["password"].value
            var cP = document.forms["setpw"]["confirm_password"].value
            var pLength = p.length;

            if (p == null || p == "")
            {
                alert("You left the password field empty");
                return false;
            }
            else if (pLength < 6 || pLength > 20)
            {
                alert("Your password must be between 6 and 20 characters in length");
                
                return false;
            }
            else if (p != cP)
            {
                alert("The passwords do not match!");

                return false;
            }
            else
            {
                generatehash();
                return true;
            }
            $('#setpw').submit(check);
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
                      <input class="search_input" type="text" name="" placeholder="Suche nach Uhren, Marken und mehr...">
                      <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
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
    <div class="container h-100" style="background-color: transparent;">
        <div class="d-flex justify-content-center" >
            <div class="card mt-5 col-md-4 animated myForm">
                <div class="card-header">
                    <h4>Password zurücksetzen:</h4>
                </div>
                <div class="card-body">
                    <form method="POST" class="needs-validation" name = "setpw" id = "setpw" action = "phpfunction/savepassword.php">
                        <div id="dynamic_container">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text br-50"> <i class="fas fa-key"></i></span>
                                </div>
                                <input name="password" id="password" type="password" placeholder="Neues Password" class="form-control" required/>
                                  <div class="invalid-feedback">
                                    Bitte Passwort eingeben.
                                  </div>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text br-50"><i class="fas fa-key"></i></span>
                                </div>
                                <input name="confirm_password" id="confirm_password" type="password" placeholder="Neues Password wiedergeben" class="form-control" required/>
                                <div class="invalid-feedback">
                                    Bitte Passwort wiederholen.
                                  </div>
                            </div>
                            <div>
                            <span id='message' class="mt-5"></span>

                            </div>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-reset d-grid" type="submit" style="margin-top: 30px;" id="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
            (function () {
              'use strict'

              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.querySelectorAll('.needs-validation');
              

              // Loop over them and prevent submission
              Array.prototype.slice.call(forms)
                .forEach(function (form) {
                  form.addEventListener('submit', function (event) {
                    if (!check()) {
                      event.preventDefault()
                      event.stopPropagation()
                    } 
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