<?php
require_once("../config.php");
require_once("../classes/user.php");
$user = User::fromID($_GET['id']);
$json = array();
$json[] = array(
    "id" => $user->id,
    "name" => $user->name,
    "address"=> $user->address,
    "mobile" => $user->number,
    "email"=> $user->email,
    "computer"=> $user->computer,
    "idProof"=>$user->idProof,
    "inTime" => $user->inTime,
    "outTime" => $user->outTime,
    "status"=> $user->status,
    "fee" => $user->fee,
    "remark" => $user->remark
);

echo json_encode($json);