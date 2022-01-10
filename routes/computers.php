<?php
require_once("../classes/computer.php");
require_once("../config.php");

$computers =Compututer::getComputers();
echo json_encode($computers);