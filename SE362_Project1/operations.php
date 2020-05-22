<?php

function getPlayers(){
    return json_decode(file_get_contents(__DIR__."/players.json"),true);
   /*
    echo "<pre>";
    var_dump($players);
    echo "</pre>";
   */
}

function getPlayerById($id){
    $players = getPlayers();
    foreach ($players as $player) {
        if($player['id'] == $id){
            return $player;
        }
    }
    //there is no player
    return null;
}

function addPlayer($player){
    $players = getPlayers();
    $player['id'] = rand(1,10000);

    $players[] = $player;
    
    convertToJson($players);

    return $player;
}

function convertToJson($players){
    return file_put_contents(__DIR__ . '/players.json', json_encode($players, JSON_PRETTY_PRINT));
}

function removePlayer($id){
    $players = getPlayers();

    foreach ($players as $index => $player) {
        if ($player['id'] == $id) {
            array_splice($players, $index, 1);
        }
    }

    convertToJson($players);
}

function updatePlayer($player,$id){
    $updatePlayer = [];
    $players = getPlayers();
    foreach ($players as $index => $pl) {
        if ($pl['id'] == $id) {
            $players[$index] = $updatePlayer = array_merge($pl, $player);
        }
    }

    convertToJson($players);

    return $updatePlayer;
}

function uploadImage($file, $player)
{
    //to look image file content name,format with $_FİLES
        if (!is_dir(__DIR__ . "/Images")) {
            mkdir(__DIR__ . "/Images");
        }
        $fileName = $file['name'];
        $dotPosition = strpos($fileName, '.');
        $extension = substr($fileName, $dotPosition + 1);

        move_uploaded_file($file['tmp_name'],__DIR__."/Images/${player['id']}.$extension");

        $player['extension'] = $extension;
        
        updatePlayer($player, $player['id']);
}

function validatePlayer($player, &$errors)
{
    $isValid = true;
    if (!$player['name'] || strlen($player['name']) < 4 || strlen($player['name']) > 16) {
        $isValid = false;
        $errors['name'] = 'Name is required and it must be more than 4 and less then 16 character';
    }
    if (!$player['surname'] || strlen($player['surname']) < 4 || strlen($player['surname']) > 16) {
        $isValid = false;
        $errors['surname'] = 'Surname is required and it must be more than 4 and less then 16 character';
    }
    if (!$player['p_number']) {
        $isValid = false;
        $errors['p_number'] = 'Player Number is required';
    }
    if (!$player['age']) {
        $isValid = false;
        $errors['age'] = 'Age is required';
    }
    return $isValid;
}
?>