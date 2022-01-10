<?php
require_once('../config.php');
require_once('../classes/admin.php');

$jsonInput = json_decode(file_get_contents('php://input'));

$admin = Admin::getProfile($jsonInput->admin_id);

$admin->admin_name=$jsonInput->admin_name;
$admin->admin_user_name=$jsonInput->admin_name;
$admin->admin_email=$jsonInput->admin_name;
$admin->admin_contact_number=$jsonInput->admin_name;

$json=array();
if($admin->UpdateProfile()){
    $json[]=array(
        "response"=>"true"
    );
}else{
    $json[]=array(
        "response"=>"false"
    );
}

echo json_encode($json[0]);