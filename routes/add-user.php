<?php
require_once("../classes/user.php");
require_once("../config.php");
$jsonInput =  json_decode(file_get_contents("php://input"));
$user = new User();
$user->name = $jsonInput->name;
$user->address = $jsonInput->address;
$user->number = $jsonInput->mobile;
$user->email = $jsonInput->email;
$user->computer = $jsonInput->computer;
$user->idProof = $jsonInput->idProof;
$user->inTime = date("Y-m-d h:i:s");
$user->outTime = "2021-01-01 00:00:00";
$user->status = "";
$user->fee = "";
$user->remark = "";
if($user->addUser()){
    $json[]=array(
        "response"=> "true"
    );
    echo json_encode($json[0]);
}else{
    $json[]=array(
        "response"=> "false"
    );
    echo json_encode($json[0]);
}

