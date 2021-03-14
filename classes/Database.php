<?php
include "Helper.php";
include "Session.php";
class Database{

    public $conn;
    public $helper;
    public $session;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=login_system","root","");
        if(!$this->conn){
            echo"Connection error";
        }
        $this->helper = new Helper();
        $this->session= new Session();
    }

    public function insert($table,$post){
       // $email = $_POST['email'];
       // $pass  =  $_POST['password'];
       // $this->validation->valid($email,$pass);
        $email = $post['email'];
        $pass  = $post['password'];
        $emailCheck = $this->emailCheck($email,"register");
        $emailexists = new EmailTrue();
        $emailexists->login($emailCheck);
        $this->helper->postValid($post);
        $sql = "INSERT INTO $table (email,pass) VALUES(:email,:pass)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':pass',$pass);
        if($stmt->execute()){
            echo "<script>confirm('Register success')</script>";
        }
        
    }

    public function selectAll($table){
       $sql = "SELECT * FROM $table";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute();
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $result;
      
    }
    public function selectByid($table,$id){
        $sql = "SELECT * FROM $table WHERE id= '$id' ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;  
     }

     public function updateByid($table,$id){
         $email = $_POST['email'];
         $pass  = $_POST['password'];
         $this->helper->valid($email,$pass);
         $sql = "UPDATE $table SET email=?, pass=? WHERE id ='$id'";
         $stmt = $this->conn->prepare($sql);
         $stmt->bindParam(1,$email);
         $stmt->bindParam(2,$pass);
         $result = $stmt->execute();
         return $result;
     }

     public function emailCheck($email,$table){

        $sql = "SELECT email from $table WHERE email = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1,$email);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }else{
            return false;
        }

     }
/*
     public function login($email,$pass){
         
        $this->helper->valid($email,$pass);
        $sql = "SELECT * FROM register WHERE email = ? AND pass = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1,$email);
        $stmt->bindParam(2,$pass);
        $result=$stmt->execute();
        if($stmt->rowCount()>0){
        $result =  $stmt->fetch(PDO::FETCH_ASSOC);
        if($result==true){
                //Session::int();
                Session::sessionSet("login",true);
                Session::sessionSet("email",$result['pass']);
                Session::sessionSet("login_email",$email);
                header("Location:login.php");

            } 

   

     }


}
*/

public function login($post){
    $email = $post['email'];
    $pass  = $post['password'];
    $emailCheck = $this->emailCheck($email,"register");
    $this->helper->postValid($post);
    $emailexists = new EmailFalse();
    $emailexists->login($emailCheck);
    $sql = "SELECT * FROM register WHERE email = ? AND pass = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(1,$email);
    $stmt->bindParam(2,$pass);
    $result=$stmt->execute();
    if($stmt->rowCount()>0){
    $result =  $stmt->fetch(PDO::FETCH_ASSOC);
    if($result==true){
            //Session::int();
            Session::sessionSet("login",true);
            Session::sessionSet("email",$result['pass']);
            Session::sessionSet("login_email",$email);
            header("Location:login.php");

        } 



 }


}






















}