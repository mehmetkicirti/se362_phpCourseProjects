<?php
include 'header.php';
require __DIR__ . '/operations.php';

if (!isset($_GET['id'])) {
    include "not_found.php";
    exit;
}
$player = getPlayerById($_GET['id']);
if (!$player) {
    include "not_found.php";
    exit;
}

?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Player Name => <b><?php echo $player['name'] ?></b></h3>
            <hr>
            <?php if (isset($player['extension'])) : ?>
                <img class="mx-auto d-block img-fluid" style="width: 250px;height:250px;" src="<?php echo "Images/${player['id']}.${player['extension']}" ?>">
            <?php endif; ?>
        </div>
        <div class="card-body">
            <a class="btn btn-info" href="updatePlayer.php?id=<?php echo $player['id'] ?>">Update Player</a>
            <form style="display: inline-block" method="POST" action="deletePlayer.php">
                <input type="hidden" name="id" value="<?php echo $player['id'] ?>">
                <button class="btn btn-danger">Delete Player</button>
            </form>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <th>Name:</th>
                    <td><?php echo $player['name'] ?></td>
                </tr>
                <tr>
                    <th>Surname:</th>
                    <td><?php echo $player['surname'] ?></td>
                </tr>
                <tr>
                    <th>Player Number:</th>
                    <td>#<?php echo $player['p_number'] ?></td>
                </tr>
                <tr>
                    <th>Age:</th>
                    <td><?php echo $player['age'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<?php include 'footer.php' ?>