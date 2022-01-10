<?php
require_once('../config.php');
require_once('../classes/admin.php');

$jsonInput = json_decode(file_get_contents('php://input'));

$admin = Admin::getProfile($jsonInput->admin_id);
$admin->admin_password = password_hash($jsonInput->admin_password,PASSWORD_BCRYPT);

$json=array();
if($admin->ChangePassword()){
    $json[]=array(
        "response"=>"true"
    );
}else{
    $json[]=array(
        "response"=>"false"
    );
}

echo json_encode($json[0]);