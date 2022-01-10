<?php
require_once("database.php");
class User extends database
{
    public $id, $name, $address, $number, $email, $computer, $idProof, $inTime, $outTime, $status, $fee, $remark;

    public function __construct()
    {
    }

    public static function fromID($id)
    {
        $instance =  new self();
        $conn = $instance->connect();
        $SQL = "SELECT * FROM USERS WHERE user_id=?";
        $stmt = $conn->prepare($SQL);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("s", $id);
        if (!$stmt->execute()) {
            return false;
        }

        $result = $stmt->get_result();

        if (!$result) {
            return false;
        }

        while ($row = $result->fetch_array()) {
            $instance->id = $row['user_id'];
            $instance->name = $row['user_name'];
            $instance->address = $row['user_address'];
            $instance->number = $row['user_number'];
            $instance->email = $row['user_email'];
            $instance->computer = $row['computer_id'];
            $instance->idProof = $row['user_id_proof'];
            $instance->inTime = $row['user_in_time'];
            $instance->outTime = $row['user_out_time'];
            $instance->status = $row['user_status'];
            $instance->fee = $row['user_fee'];
            $instance->remark = $row['user_remark'];
        }

        return $instance;
    }

    public static function search(string $search ){
        $instance = new self();
        $conn = $instance->connect();
        $SQL = "SELECT * FROM USERS WHERE user_name LIKE ? ";
        $search = $search."%";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("s",$search);
        $stmt->execute();
        $result = $stmt->get_result();
        $json=array();
        while($row = $result->fetch_array()){
            $json[] = array(
                "id"=>$row['user_id'],
                "idProof" => $row['user_id_proof'],
                "name" => $row['user_name']
            );
            $instance->id=$row['user_id'];
        }
        echo json_encode($json);
    }

    public static function report($start,$end){
        $instance = new self();
        $conn = $instance->connect();
        $SQL = "SELECT * FROM USERS WHERE user_in_time BETWEEN ? AND ? ";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("ss",$start,$end);
        $stmt->execute();
        $result = $stmt->get_result();
        $json=array();
        while($row = $result->fetch_array()){
            $json[] = array(
                "id"=>$row['user_id'],
                "idProof" => $row['user_id_proof'],
                "name" => $row['user_name']
            );
            $instance->id=$row['user_id'];
        }
        echo json_encode($json);
    }

    public function addUser(){
        $SQL = "INSERT INTO USERS (user_name,user_address,user_number,user_email,computer_id,user_id_proof,user_in_time,user_out_time,user_status,user_fee,user_remark) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $conn = $this->connect();
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("sssssssssss",$this->name,$this->address,$this->number,$this->email,$this->computer,$this->idProof,$this->inTime,$this->outTime,$this->status,$this->fee,$this->remark);
        // return($stmt->execute());
        if($stmt->execute()){
            return true;
        }else{
            echo mysqli_error($conn);
            return false;
        }
    }

    public static function getUsers(){
        $instance = new self();
        $conn = $instance->connect();
        $SQL = "SELECT * FROM USERS WHERE user_status <> 'CHECKED OUT' ";
        $stmt = $conn->prepare($SQL);
        $stmt->execute();
        $result = $stmt->get_result();
        $json=array();
        while($row = $result->fetch_array()){
            $json[] = array(
                "id"=>$row['user_id'],
                "idProof" => $row['user_id_proof'],
                "name" => $row['user_name']
            );
            $instance->id=$row['user_id'];
        }
        echo json_encode($json);
    }

    public static function getUsersArchive(){
        $instance = new self();
        $conn = $instance->connect();
        $SQL = "SELECT * FROM USERS WHERE user_status = 'CHECKED OUT' ";
        $stmt = $conn->prepare($SQL);
        $stmt->execute();
        $result = $stmt->get_result();
        $json=array();
        while($row = $result->fetch_array()){
            $json[] = array(
                "id"=>$row['user_id'],
                "idProof" => $row['user_id_proof'],
                "name" => $row['user_name']
            );
            $instance->id=$row['user_id'];
        }
        echo json_encode($json);
    }

    public function updateUser(){
        $conn = $this->connect();
        $SQL = "UPDATE USERS SET user_remark=?,user_fee=?,user_status=? WHERE user_id=?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("ssss",$this->remark,$this->fee,$this->status,$this->id);
        return ( $stmt->execute());
    }
}
