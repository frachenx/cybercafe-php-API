<?php
require_once("../config.php");
require_once("../classes/computer.php");
$jsonInput = json_decode(file_get_contents("php://input"));

if (!$jsonInput){
    exit("No content");
}else{
    $computer = Compututer::addComputer($jsonInput->name,$jsonInput->location,$jsonInput->ip);
    echo json_encode(array(
        "id"        =>$computer->id,
        "name"      =>$computer->name,
        "location"  =>$computer->location,
        "ip"        =>$computer->ip
    ));
}