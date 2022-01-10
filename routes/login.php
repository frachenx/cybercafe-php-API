<?php
require_once('../config.php');
require_once('../classes/admin.php');

$jsonInput = json_decode(file_get_contents('php://input'));

$result = Admin::Login($jsonInput->username,$jsonInput->password);
$json = array();
if($result){
    $json[]=array(
        "response"=>$result
    );
}else{
    $json[]=array(
        "response"=>"false"
    );
}
echo json_encode($json[0]);