<?php
require_once('../config.php');
require_once('../classes/admin.php');

$jsonInput = json_decode(file_get_contents('php://input'));

$json=array();
if(Admin::CheckPassword($jsonInput->admin_id,$jsonInput->admin_password)){
    $json[]=array(
        "response"=>"true"
    );
}else{
    $json[]=array(
        "response"=>"false"
    );
}

echo json_encode($json[0]);