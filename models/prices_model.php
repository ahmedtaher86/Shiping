<?php 

require_once 'table_manipulation.php' ; 


class price_manipulation extends table_manipulation 
{


   protected $fillable = ["governorate", "price", "price_flight", "price_express"];
   protected $table_name = "prices";
    


function get_governorate_and_price_air ()
{
  $stmnt=$this->conn->prepare("SELECT `id`,`governorate`,`price_flight` FROM `$this->table_name` WHERE `price_flight` IS NOT NULL;");
  $stmnt->execute();
  $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
  $array=$stmnt->fetchall();
  return $array; 
}


function get_gov (int $id) {

    $stmnt=$this->conn->prepare("SELECT `governorate` FROM `$this->table_name` WHERE `id`='$id'");
    $stmnt->execute();
    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array[0]['governorate'];
    
  }


function get_price (int $id)
   {

    $stmnt=$this->conn->prepare("SELECT `price` FROM `$this->table_name` WHERE `id`='$id'");
    $stmnt->execute();
    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array[0]['price'];
  }

  function get_price_by_gov (string $gov)
  {

   $stmnt=$this->conn->prepare("SELECT `price` FROM `$this->table_name` WHERE `governorate`='$gov'");
   $stmnt->execute();
   $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
   $array=$stmnt->fetchall();
   return $array[0]['price'];
 }




  function get_price_express (int $id)
   {

    $stmnt=$this->conn->prepare("SELECT `price_express` FROM `$this->table_name` WHERE `id`='$id'");
    $stmnt->execute();
    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array[0]['price_express'];

  }

  
  function get_price_express_by_gov (string $gov)
   {

    $stmnt=$this->conn->prepare("SELECT `price_express` FROM `$this->table_name` WHERE `governorate`='$gov'");
    $stmnt->execute();
    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array[0]['price_express'];

  }


  function get_price_Air (int $id)
  {

   $stmnt=$this->conn->prepare("SELECT `price_flight` FROM `$this->table_name` WHERE `id`='$id' AND `price_flight` IS NOT NULL ");
   $stmnt->execute();
   $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
   $array=$stmnt->fetchall();
   return $array[0]['price_flight'];
 }


 function get_price_Air_by_gov (string $gov)
 {

  $stmnt=$this->conn->prepare("SELECT `price_flight` FROM `$this->table_name` WHERE `governorate`='$gov' AND `price_flight` IS NOT NULL ");
  $stmnt->execute();
  $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
  $array=$stmnt->fetchall();
  return $array[0]['price_flight'];
}







}







?>