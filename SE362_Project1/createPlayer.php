<?php
include 'header.php';
require __DIR__ . '/operations.php';

$player = [
    'id' => '',
    'name' => '',
    'surname' => '',
    'p_number' => '',
    'age' => 0,
];

$errors = [
    'name' => '',
    'surname' => '',
    'age' => "",
    'p_number' => "",
];

$isValid = true;

//checking method post or get after
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //we need to combine post data with our upper array file
    $player = array_merge($player, $_POST);
    //checking already defined into crudOp with validateOperations function  
    $isValid = validatePlayer($player, $errors);
    if ($isValid) {
        //add
        $player = addPlayer($_POST);
        // echo "<pre>";
        // var_dump($_FILES['picture']);
        // echo "</pre>";
        //upload file..
        uploadImage($_FILES['picture'], $player);
        header("Location:index.php");
    }
}
?>
<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <h3>
                Create New Player
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" class="form-control <?php echo $errors['name'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input name="surname" class="form-control  <?php echo $errors['surname'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['surname'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Player Number</label>
                    <input type="number" name="p_number" class="form-control  <?php echo $errors['p_number'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['p_number'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control <?php echo $errors['age'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['age'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input name="picture" type="file" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>