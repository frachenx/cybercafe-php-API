<?php
require_once("../config.php");
require_once("../classes/user.php");
User::search($_GET['search']);