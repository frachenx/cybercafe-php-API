<?php
require_once("../config.php");
require_once("../classes/user.php");
User::report($_GET['start'],$_GET['end']);
// echo $_GET['start'] . "   " .$_GET['end'];
