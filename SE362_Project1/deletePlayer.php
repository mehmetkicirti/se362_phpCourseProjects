<?php
//need to require bootstrap file so added header.
include 'header.php';
require __DIR__ . '/operations.php';
//post after return back index php

//return not found page
if (!isset($_POST['id'])) {
    include "notFound.php";
    exit;
}
$playerId = $_POST['id'];
removePlayer($playerId); //no error to post operations therefore deleted player
header("Location: index.php");