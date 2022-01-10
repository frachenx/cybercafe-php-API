<?php
require_once("../config.php");
require_once("../classes/computer.php");

$jsonInput = json_decode(file_get_contents("php://input"));
if(!$jsonInput){
    
}else{
    $computer = Compututer::updateComputer($jsonInput->id,$jsonInput->name,$jsonInput->location,$jsonInput->ip);
    $respuesta = array();
    $respuesta[]=array(
        "id"=>$jsonInput->id,
        "name"=>$jsonInput->name,
        "location"=>$jsonInput->location,
        "ip"=>$jsonInput->ip,
    );
    echo json_encode($respuesta);
}