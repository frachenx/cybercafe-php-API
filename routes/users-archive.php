<?php
require_once("../config.php");
require_once("../classes/user.php");

$jsonInput = json_decode(file_get_contents("php://input"));

if (!$jsonInput){

}else{
    $user = User::fromID($jsonInput->id);
    $json = array();
    $json[] = array(
        'id' => $user->id,
        'name' => $user->name,
        'address' => $user->address
    );

    $jsonString = json_encode($json);
    echo $jsonString;
}

