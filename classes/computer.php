<?php
require_once("database.php");
class Compututer extends database {
    public $id,$name,$location,$ip;

    public static function addComputer($name,$location,$ip){
        $instance =  new self();
        // $instance->id =$id;
        $instance->name =$name;
        $instance->location =$location;
        $instance->ip =$ip;

        $conn =  $instance->connect();
        $SQL = "INSERT INTO COMPUTERS (computer_name,computer_location,computer_ip) VALUES(?,?,?)";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("sss",$instance->name,$instance->location,$instance->ip);
        $stmt->execute();

        $SQL = "SELECT computer_id FROM COMPUTERS ORDER BY computer_id DESC";
        $stmt = $conn->prepare($SQL);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result){

        }else{
            $row = $result->fetch_array();
            $instance->id = $row['computer_id'];
        }
        
        return $instance;

    }

    public static function getComputers(){
        $computers=array();
        $instance = new self();
        $SQL = "SELECT * FROM COMPUTERS";
        $conn = $instance->connect();
        $stmt = $conn->prepare($SQL);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows >0){
            while ($row=$result->fetch_array()){
                $computers[]=array(
                    "id" => $row['computer_id'],
                    "name" => $row['computer_name'],
                    "location" => $row['computer_location'],
                    "ip" => $row['computer_ip']
                );
            }
        }

        return $computers; 
    }

    public static function getFromID($id){
        $instance = new self();
        $conn = $instance->connect();
        $SQL = "SELECT * FROM COMPUTERS WHERE computer_id=?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array();
        $instance->id=$row['computer_id'];
        $instance->name=$row['computer_name'];
        $instance->location=$row['computer_location'];
        $instance->ip=$row['computer_ip'];
        return $instance;
    }

    public static function updateComputer($id,$name,$location,$ip){
        $SQL = "UPDATE COMPUTERS SET computer_name=?, computer_location=?,computer_ip=? WHERE computer_id=?";
        $instance = new self();
        $conn = $instance->connect();
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("ssss",$name,$location,$ip,$id);
        $stmt->execute();
        $instance->id = $id;
        $instance->name = $name;
        $instance->location = $location;
        $instance->ip = $ip;
        return $instance;
    }
}