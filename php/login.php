<?php

    //echo ("TEST");

   session_start();

    $sUsername = "";
    $sPassword = "";
    $sid = "";
    $shippingname ="";
    $shippingadress ="";
    $shippingemail="";
    $city = "";
    $zip = "";
    $bLoginSuccess = false;
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        header("Location: ../login.html");
    }

    if (isset($_POST['username'])) {
        $sUsername = $_POST['username'];
    }

    if (isset($_POST['password'])) {
        $sPassword = $_POST['password'];
    }

    $resolution = 'ahihi';
    if (isset($_POST['resolution'])) {
        $resolution = $_POST['resolution'];
    }


    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login...</title>
    </head>
    <body>
    </body>
    </html>';
    

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


        $sql = "SELECT * FROM webshop.wsuser WHERE username = '$sUsername' AND password = '$sPassword'";

        foreach ($conn -> query($sql) as $row) {
            $bLoginSuccess = true;
            $sid =  $row['id'];
            $shippingname = $row['firstname'].' '.$row['lastname'];
            $shippingemail = $row['username'];
            $shippingadress = $row['address'];
            $zip = $row['zip'];
            $city = $row['city'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['active'] = 1;
            $_SESSION['lastlogin'] = $row['lastlogin'];
            $_SESSION['ispwreseted'] = $row['ispwreseted'];

        }

         if ($bLoginSuccess) {
             
            //set active = 1 for user
            $sql2 = "UPDATE webshop.wsuser SET active = '1' WHERE id = $sid";
            $conn->query($sql2);

            //set lastlogin = now()
            $sql3 = "UPDATE webshop.wsuser SET lastlogin = CURRENT_TIMESTAMP() WHERE id = $sid";
            $conn->exec($sql3);

            // // Hier wird der Warenkorbdaten erstellen/aufrufen
            // // Check if es einen Order gibt, die isClosed == false
            // $sql4 = "SELECT COUNT(*) FROM webshop.wsorder WHERE iduser = '$sid' AND isclosed = '0'";
            // $object = $conn -> query($sql4);
            // $countorder = $object -> fetchColumn();
            
            // if ($countorder == 0) { // Heißt es gibt keine offene Order
            //     // // Wenn keine, erstell neuen Shopping cart
            //     $sqlcart = "INSERT INTO webshop.wscart (idcart, iduser, createdat) VALUES ('',$sid,CURRENT_TIMESTAMP())";
            //     $conn->exec($sqlcart);
            //     //Take cartid
            //     $sqlcartid = "SELECT idcart FROM webshop.wscart WHERE iduser= '$sid' ORDER BY createdat DESC LIMIT 1";
            //     $res = $conn -> query($sqlcartid);
            //     $idcart = $res -> fetchColumn();
            //     //erstell neuen order not closed
            //     $sqlorder = "INSERT INTO webshop.wsorder (idorder,iduser,idcart,totalvalue,shippingmethod,shippingname,shippingemail,shippingaddress,zip,city,paymentmethod,paymentname,paymentnumber,isclosed) VALUES ('', $sid, $idcart, 0, '', '$shippingname', '$shippingemail', '$shippingadress', '$zip', '$city', NULL, NULL, NULL, 0)";
            //     $conn -> query($sqlorder);
            //         $_SESSION['idcart'] = $idcart;

            // } else {
            //     //Es gibt zumindest eine offene Order
            //     $sqlqueryfororder = "SELECT * FROM webshop.wsorder WHERE iduser = '$sid' AND isclosed = '0' ORDER BY idcart DESC LIMIT 1";
            //     foreach ($conn -> query($sqlqueryfororder) as $row) {
            //         $_SESSION['idcart'] = $row['idcart'];
            //     }
            // }
            // echo $_SESSION['idcart'];


            //Beim login werden Daten des Users gespeichert: Wann Datum und Uhrzeit, Bildschirmauflösung und Betriebssystem
            //Get Operating System
            function getOS() { 

                $user_agent = $_SERVER['HTTP_USER_AGENT'];
            
                $os_platform =   "Bilinmeyen İşletim Sistemi";
                $os_array =   array(
                    '/windows nt 10/i'      =>  'Windows 10',
                    '/windows nt 6.3/i'     =>  'Windows 8.1',
                    '/windows nt 6.2/i'     =>  'Windows 8',
                    '/windows nt 6.1/i'     =>  'Windows 7',
                    '/windows nt 6.0/i'     =>  'Windows Vista',
                    '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                    '/windows nt 5.1/i'     =>  'Windows XP',
                    '/windows xp/i'         =>  'Windows XP',
                    '/windows nt 5.0/i'     =>  'Windows 2000',
                    '/windows me/i'         =>  'Windows ME',
                    '/win98/i'              =>  'Windows 98',
                    '/win95/i'              =>  'Windows 95',
                    '/win16/i'              =>  'Windows 3.11',
                    '/macintosh|mac os x/i' =>  'Mac OS X',
                    '/mac_powerpc/i'        =>  'Mac OS 9',
                    '/linux/i'              =>  'Linux',
                    '/ubuntu/i'             =>  'Ubuntu',
                    '/iphone/i'             =>  'iPhone',
                    '/ipod/i'               =>  'iPod',
                    '/ipad/i'               =>  'iPad',
                    '/android/i'            =>  'Android',
                    '/blackberry/i'         =>  'BlackBerry',
                    '/webos/i'              =>  'Mobile'
                );
            
                foreach ( $os_array as $regex => $value ) { 
                    if ( preg_match($regex, $user_agent ) ) {
                        $os_platform = $value;
                    }
                }   
                return $os_platform;
            }

            $operatingsystem = getOS();

            echo $operatingsystem;


            $sqlgetloginTime = "SELECT lastlogin FROM webshop.wsuser WHERE id = $sid";
            $lastloginobj = $conn -> query($sqlgetloginTime);
            $lastlogin = $lastloginobj -> fetchColumn();

            $sqlinsertlogininfo = "INSERT INTO webshop.logindata (iduser,logintime,screenresolution,operatingsystem) VALUES ($sid,'$lastlogin','$resolution','$operatingsystem')";
            $conn -> query($sqlinsertlogininfo);

        }

        //Close connection
        $conn = NULL;
    } catch (PDOException $th) {
        echo $th -> getMessage();
    }


    // Login Erfolgreich
     if ($bLoginSuccess) {

        //Weiterleiten  
        header("Location: phpfunction/newcart.php");
        

    } else{
        echo (
            '<script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
            <script> swal({
                title: "Oops",
                text: "Ungültige Email oder Password!",
                icon: "error",
                button: "OK!",
              }).then(function() {
                window.location = "../login.html";
                });
              </script>'
        );

    }


?>

