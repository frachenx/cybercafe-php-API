<?php
require_once('database.php');
class Admin extends Database{
    public $admin_id, $admin_name, $admin_user_name, $admin_password, $admin_contact_number, $admin_email, $admin_created_date;


    static function getProfile($id){
        $instance = new self();
        $conn = $instance->connect();
        $SQL = "SELECT * FROM admin WHERE admin_id=?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("s",$id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if(!$result){
                return false;
            }else{
                $row=$result->fetch_array();
                if(!$row){
                    return false;
                }else{
                    $instance->admin_id=$row['admin_id'];
                    $instance->admin_name=$row['admin_name'];
                    $instance->admin_user_name=$row['admin_user_name'];
                    $instance->admin_password=$row['admin_password'];
                    $instance->admin_contact_number=$row['admin_contact_number'];
                    $instance->admin_email=$row['admin_email'];
                    $instance->admin_created_date=$row['admin_created_date'];
                    return $instance;
                }
            }
        }else{
            return false;
        }
    }

    static function Login($username,$password){
        $instance = new self();
        $conn = $instance->connect();
        $SQL="SELECT * FROM ADMIN WHERE admin_user_name=?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("s",$username);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if(!$result){
                return false;
            }else{
                $row=$result->fetch_array();
                if(!$row){
                    return false;
                }else{
                    $hash = $row['admin_password'];
                    $hash = str_replace("$2a$","$2y$",$hash);
                    $hash = str_replace("$2b$","$2y$",$hash);
                    if (password_verify($password,$hash)){
                        return $row['admin_id'];
                    }else{
                        return false;
                    }
                }
            }
        }else{
            return false;
        }
    }

    function UpdateProfile(){
        $conn = $this->connect();
        $SQL="UPDATE ADMIN SET admin_name=?,admin_user_name=?,admin_password=?,admin_contact_number=?,admin_email=? WHERE admin_id=?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("ssssss",$this->admin_name,$this->admin_user_name,$this->admin_password,$this->admin_contact_number,$this->admin_email,$this->admin_id);
        return $stmt->execute();
    }

    function ChangePassword(){
        $conn = $this->connect();
        $SQL="UPDATE ADMIN SET admin_password=? WHERE admin_id=?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("ss",$this->admin_password,$this->admin_id);
        return $stmt->execute();
    }

    static function CheckPassword($id,$password){
        $instance = new self();
        $conn = $instance->connect();
        $SQL="SELECT * FROM ADMIN WHERE admin_id=?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("s",$id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if(!$result){
                return false;
            }else{
                $row=$result->fetch_array();
                if(!$row){
                    return false;
                }else{
                    $hash = $row['admin_password'];
                    $hash = str_replace("$2a$","$2y$",$hash);
                    $hash = str_replace("$2b$","$2y$",$hash);
                    if (password_verify($password,$hash)){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }else{
            return false;
        }
    }

}