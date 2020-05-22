<?php
include 'header.php';
require __DIR__ . '/operations.php';

if (!isset($_GET['id'])) {
    include "notFound.php";
    exit;
}
$playerId = $_GET['id'];
$player = getPlayerById($playerId);
if (!$player) {
    include "notFound.php";
    exit;
}

$errors = [
    'name' => "",
    'surname' => "",
    'age' => "",
    'p_number' => "",
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $player = array_merge($player, $_POST);

    $isValid = validatePlayer($player, $errors);
    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";
    // exit;
    if ($isValid) {
        $player = updatePlayer($_POST, $playerId);
        uploadImage($_FILES['picture'], $player);
        header("Location: index.php");
    }
}
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>
                Update User
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" value="<?php echo $player['name'] ?>" class="form-control <?php echo $errors['name'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input name="surname" value="<?php echo $player['surname'] ?>" class="form-control  <?php echo $errors['surname'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['surname'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Player Number</label>
                    <input type="number" name="p_number" value="<?php echo $player['p_number'] ?>" class="form-control  <?php echo $errors['p_number'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['p_number'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" value="<?php echo $player['age'] ?>" name="age" class="form-control  <?php echo $errors['age'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['age'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <?php if (isset($player['extension'])) : ?>
                        <img style="width: 60px" src="<?php echo "Images/${player['id']}.${player['extension']}" ?>" alt="">
                    <?php endif; ?>
                    <input name="picture" type="file" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>