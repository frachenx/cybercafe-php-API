<?php

class database{
    private $server="localhost",$user ="root",$pwd = "",$db="cyberCafe";

    public function connect(){
        $connect = mysqli_connect($this->server,$this->user,$this->pwd,$this->db);
        return $connect;
    }
}