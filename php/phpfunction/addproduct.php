
<!--
    Einfügen in den Warenkorb
    nếu có item cùng product id -> +1
    nếu không
    Created a cart item (`idcartitem`, `cartid`, `productid`, `amount`) VALUES (auto increment, session, có rồi, '1')
-->
<?php

    $productid = 0;
    $cartid = 0;
    $amountproduct = 1;
    $isadding = 0;

    if (isset($_POST['product_id'])) {
        $productid = $_POST['product_id'];
    }
    if (isset($_POST['cart_id'])) {
        $cartid = $_POST['cart_id'];
    }
    if (isset($_POST['amount_product'])) {
        $amountproduct = $_POST['amount_product'];
    }
    if (isset($_POST['is_adding'])) {
        $isadding = $_POST['is_adding'];
    }
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

        $sqlprd = "SELECT COUNT(*) FROM webshop.wscartitem WHERE cartid = '$cartid' AND productid = '$productid'";
        $object = $conn -> query($sqlprd);
        $countcartitem = $object -> fetchColumn();
        if ($countcartitem == 0) {
            // If there isnt any cartitem with productid & cartid -> insert into
            $sqlinsertcartitem = "INSERT INTO webshop.wscartitem (idcartitem, cartid, productid, amount) VALUES ('', '$cartid', '$productid', '$amountproduct')";
            $conn -> exec($sqlinsertcartitem);
        } else {
            //If there is a cartitem with productid -> set +1
            $amount = 0;
            $sqlcartitem = "SELECT * FROM webshop.wscartitem WHERE cartid = '$cartid' AND productid = '$productid'";
            foreach ($conn -> query($sqlcartitem) as $key) {
                if ($isadding == 0) {
                    $amount = $key['amount'] - $amountproduct;
                    if ($amount<0) {
                        //delete item
                        $sqlDeleteItem = "DELETE FROM webshop.wscartitem WHERE cartid = '$cartid' AND productid = '$productid'";
                        $conn->exec($sqlDeleteItem);
                    }
                    
                } else {
                    $amount = $key['amount'] + $amountproduct;
                }
                
            }
            // echo $amount;
            $sqlsetamount = "UPDATE webshop.wscartitem SET amount = '$amount' WHERE cartid = '$cartid' AND productid = '$productid'";
            $conn -> exec($sqlsetamount);

        }
        
        //Else create new cartitem
        echo '1';
        //Close connection
        $conn = NULL;
    } catch (PDOException $th) {
        $handle = fopen ("error_login.txt", "w");
        fwrite ($handle, $th -> getMessage());
        fclose ($handle);
    }
?>

