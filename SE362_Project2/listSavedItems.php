<?php
session_start();
require_once('php/component.php');
require_once("php/CartDb.php");
$cartDB = new CartDb("Productdb", "Carttb");
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['exit'])) {
    backToIndex();
}
function backToIndex()
{
    echo "<script>alert('Session exiting..!')</script>";
    session_destroy();
    header("Location:index.php");
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

<body>
    <?php require_once("php/header.php"); ?>
    <form action="listSavedItems.php" method="POST">
        <div class="container">
            <div class="row text-center py-5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-center mt-5">
                            <h1>List All Session Saved Cart Data</h1>
                            <p class="lead">
                                These data's getting from Chart Database
                            </p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                        <th>Product TotalPrice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $cartDB->getData();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        listComponent($row['product_id'], $row['product_name'], $row['product_quantity'], $row['product_totalPrice']);
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <input type="submit" class="btn btn-success" name="exit" value="Back To Index" />
                        </div>
                        <div class="col-9">
                            <p class="lead">
                                ------> It will go back directly Index page and also session_destroy() is executing
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>