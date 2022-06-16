<?php 
 
 require_once 'table_manipulation.php' ; 

class user_manipulation extends table_manipulation 

{

   protected $table_name = "users";
   protected $fillable = ["full_name", "email", "password", "mobile", "gender", "governorate", "admin_flag"];


    public function user_exists_wala_la2a(string $email)
    {

        $check_entered_email=$this->conn->prepare("SELECT `email` FROM `$this->table_name` WHERE `email`='$email'");
        $check_entered_email->execute();
        $is_found=$check_entered_email->setFetchMode(PDO::FETCH_ASSOC);
        $is_found=$check_entered_email->fetchAll();


        return  $is_found;

    }

    public function shoof_email_shoof_password (string $email , string $password)
    {
        $user_exists=$this->conn->prepare("SELECT `id`,`full_name`,`email`,`password`,`admin_flag`,`governorate` FROM `$this->table_name` WHERE `email`='$email' AND `password`='$password'");
        $user_exists->execute();
        $user_array=$user_exists->setFetchMode(PDO::FETCH_ASSOC);
        $user_array=$user_exists->fetchAll();
        return $user_array;

    }







    public function add_new_admin($full_name , $email , $mobile , $password )
    {
        $passwordd=sha1($password);
        $stmnt=$this->conn->prepare("INSERT INTO `$this->table_name`(`full_name`,`email`,`mobile`,`password`,`admin_flag`)
        VALUES ('$full_name','$email','$mobile','$passwordd','1');");
        $stmnt->execute();

    }

    public function add_new_client($full_name , $email , $mobile ,$gender, $governorate )
    {
    
        $stmnt=$this->conn->prepare("INSERT INTO `$this->table_name`(`full_name`,`email`,`mobile`,`gender`,`governorate`,`admin_flag`)
        VALUES ('$full_name','$email','$mobile','$gender','$governorate','0');");
        $stmnt->execute();


    }
    

    public function admins_to_array() 
    {

        $stmnt=$this->conn->prepare("SELECT * FROM `$this->table_name` WHERE `admin_flag`='1'");
        $stmnt->execute();
        $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
        $array=$stmnt->fetchall();
        return $array ;
    }



    public function hatly_clients()

    {
        $stmnt=$this->conn->prepare("SELECT * FROM `$this->table_name` WHERE `admin_flag`='0'");
        $stmnt->execute();
        $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
        $array=$stmnt->fetchall();
        return $array ;
    }


}

























?>