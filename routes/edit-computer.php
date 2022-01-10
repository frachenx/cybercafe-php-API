<?php
require_once("../config.php");
require_once("../classes/computer.php");
if ($_SERVER['REQUEST_METHOD']=="GET"){
    if(isset($_GET['id'])){
        $computer = Compututer::getFromID($_GET['id']);
        $jsonComputer = array();
        $jsonComputer[] = array(
            "id" => $computer->id,
            "name" => $computer->name,
            "location"  => $computer->location,
            "ip" => $computer->ip
        );
        echo json_encode($jsonComputer);
    }
}