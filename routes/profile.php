<?php
require_once('../config.php');
require_once('../classes/admin.php');
$result = Admin::getProfile($_GET['id']);

$json = array();
if($result==false){
    $json[]=array(
        "response"=>"false"
    );
}else{
    $json[] =$result;
}

echo json_encode($json[0]);