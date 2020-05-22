<?php
$school = "Izmir University Of Economics";
require "operations.php";

$players = getPlayers();
?>
<?php include "header.php" ?>
<div class="container-fluid">
    <div class="row">
        <div class="col text-center mt-5">
            <h1>Welcome to Beşiktaş Hentball Team</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-3">
            <ul class="list-group">
                <li class="list-group-item">
                    <a style="text-decoration: none" href="createPlayer.php">
                        Add New Player
                    </a>
                </li>
                <li class="list-group-item active">
                    List All Player
                </li>
            </ul>
        </div>
        <div class="col-9">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Player Number</th>
                        <th>Age</th>
                        <th>Image</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($players as $player) : ?>
                        <tr>
                            <td><?php echo $player['name'] ?></td>
                            <td><?php echo $player['surname'] ?></td>
                            <td>#<?php echo $player['p_number'] ?></td>
                            <td><?php echo $player['age'] ?></td>
                            <td>
                                <?php if (isset($player['extension'])) : ?>
                                    <img style="width: 100px;height:100px;" src="<?php echo "Images/${player['id']}.${player['extension']}" ?>">
                                <?php else : ?>
                                    <p>NULL</p>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="dropdown show">
                                    <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Operations
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="viewPlayer.php?id=<?php echo $player['id'] ?>">View</a>
                                        <a class="dropdown-item" href="updatePlayer.php?id=<?php echo $player['id'] ?>">Update</a>
                                        <form style="display: inline-block" method="POST" action="deletePlayer.php">
                                            <input type="hidden" name="id" value="<?php echo $player['id'] ?>">
                                            <button class="dropdown-item">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>