<?php

session_start();

$index = $_GET['index'];
$action = $_GET['action'];


if(isset($_SESSION['cart'][$index])){


    if($action == "increase"){

        $_SESSION['cart'][$index]['quantity']++;

    }


    if($action == "decrease"){

        if($_SESSION['cart'][$index]['quantity'] > 1){

            $_SESSION['cart'][$index]['quantity']--;

        }

    }

}


header("Location: cart.php");

exit();

?>