<?php

class Helper{

    public function valid($email,$pass){
        if(empty($email)|| empty($pass)){
            echo "Fill up the all field";
            exit();
        }
        elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo "Email not valid";
            exit();
        }
        elseif(strlen($pass)<4){
            echo "Minimum 4 charecter needed";
            exit();
        }


    }

    public function postValid($post){
        $email = $post['email'];
        $password = $post['password'];

        if(empty($email)){
            echo "Fill up the email field";
            exit();
        }
        elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo "Email not valid";
            exit();
        }
    
        elseif(empty($password)){
            echo "Fill up the password field";
            exit();
        }
        elseif(strlen($password)<4){
            echo "Minimum 4 charecter needed";
            exit();
        }


    }
}

 abstract class Emailcheck{

    public abstract function login($email);

 }
 class EmailTrue extends Emailcheck{
     public function login($email){
         if ($email==true){
             echo "email is exists";
             exit();
         }

     }

 }
 class EmailFalse extends Emailcheck{
    public function login($email){
        if ($email==false){
            echo "email does not exist. register now!";
            exit();
        }

    }

}