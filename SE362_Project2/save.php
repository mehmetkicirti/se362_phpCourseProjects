<?php
    session_start();
    require_once("php/CartDb.php");
    $cartDB = new CartDb("Productdb","Carttb");
    if (isset($_POST['save_db'])) {
        
        foreach ($_SESSION['cart'] as $key => $value) {
            $cartDB->saveToDB(intval($value['product_id']),intval($value['product_quantity']),$value['product_name'],floatval($value['product_totalPrice']));
        }
        header("Location:listSavedItems.php");
    }
?>