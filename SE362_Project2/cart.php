<?php

session_start();

require_once('php/CreateDb.php');
require_once('php/component.php');

$db = new CreateDb("Productdb", "Producttb");
// echo "<pre>";
// var_dump($_SESSION['cart']);
// echo "</pre>";
if (isset($_POST['remove'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value["product_id"] == $_GET['id']) {
            unset($_SESSION['cart'][$key]);
            echo "<script>alert('Product has been Removed...!')</script>";
            echo "<script>window.location = 'cart.php'</script>";
        }
    }
}
if (isset($_POST['increment'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['product_id'] == $_GET['id']) {
            $increment = $value['product_quantity'] + 1;
            $item_array = array(
                'product_id' => $value['product_id'],
                'product_quantity' => $increment,
                'product_name' => $value['product_name'],
                'product_price' => $value['product_price'],
                'product_totalPrice' => $value['product_price'] * $increment
            );
            $_SESSION['cart'][$key] = $item_array;
            // echo "<pre>";
            // var_dump($_SESSION['cart']);
            // echo "</pre>";
        }
    }
}
if (isset($_POST['decrement'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['product_id'] == $_GET['id']) {
            if ($value['product_quantity'] > 1) {
                $decrement = $value['product_quantity'] - 1;
                $item_array = array(
                    'product_id' => $value['product_id'],
                    'product_quantity' => $decrement,
                    'product_name' => $value['product_name'],
                    'product_price' => $value['product_price'],
                    'product_totalPrice' => $value['product_price'] * $decrement
                );
                $_SESSION['cart'][$key] = $item_array;
            }
        }
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEKNOSA</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

    <?php
    require_once('php/header.php');
    ?>

    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6>My Cart</h6>
                    <hr>

                    <?php
                    $total = 0;
                    if (isset($_SESSION['cart'])) {
                        $product_id = array_column($_SESSION['cart'], 'product_id');
                        $product_quantity = array_column($_SESSION['cart'], 'product_quantity', 'product_id');
                        // echo "<pre>";
                        // var_dump($_SESSION["cart"]);
                        // echo "</pre>";
                        $result = $db->getData();
                        while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($product_id as $id) {
                                if ($row['id'] == $id) {
                                    cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id'], $product_quantity[$id]);
                                    $total = $total + (int) $row['product_price'] * $product_quantity[$id];
                                }
                            }
                        }
                    } else {
                        echo "<h5>Cart is Empty</h5>";
                    }

                    ?>

                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

                <div class="pt-4">
                    <h6>PRICE DETAILS</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            } else {
                                echo "<h6>Price (0 items)</h6>";
                            }
                            ?>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Amount Payable</h6>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <h6>$<?php echo $total; ?></h6>
                            <h6 class="text-success">FREE</h6>
                            <hr>
                            <h6>$<?php
                                    echo $total;
                                    ?></h6>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="save.php" method="POST">
                                <button name="save_db" class="btn btn-lg btn-success m-4 text-center" type="submit">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>