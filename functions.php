<?php

include 'connection.php';
function validating ($phone)
{
    if(preg_match('/^[0-9]{11}+$/',$phone))
    {
        return true;
    } 
    else {
        return false;
    }
}




// function admin_wala_la2a($entered_email , $entered_password)
// {
//   $stmnt=$GLOBALS['conn']->prepare("SELECT * FROM `users` WHERE `email`='$entered_email' AND `password`='$entered_password'");
//   $stmnt->execute();

//   $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
//   $array=$stmnt->fetchall();
//   if($array[0]['admin_flag']==1){return true ;}
  
  
// }

function table_to_array($table_name) 
{
  $stmnt=$GLOBALS['conn']->prepare("SELECT * FROM $table_name");
  $stmnt->execute();
  $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
  $array=$stmnt->fetchall();
  return $array ;
}


function get_governorate_and_price_air ()
{
  $stmnt=$GLOBALS['conn']->prepare("SELECT `id`,`governorate`,`price_flight` FROM prices WHERE `price_flight` IS NOT NULL;");
  $stmnt->execute();
  $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
  $array=$stmnt->fetchall();
  return $array; 
}

function delete_record_from_table_kaza( string $table_name , int $id  )
{
  $stmnt=$GLOBALS['conn']->prepare("DELETE FROM `$table_name` WHERE `id`='$id'");
  $stmnt->execute();
  
}


function add_new_admin($full_name , $email , $mobile , $password )
{
  $passwordd=sha1($password);
  $stmnt=$GLOBALS['conn']->prepare("INSERT INTO `users`(`full_name`,`email`,`mobile`,`password`,`admin_flag`)
  VALUES ('$full_name','$email','$mobile','$passwordd','1');");
  $stmnt->execute();


}

function add_new_client($full_name , $email , $mobile ,$gender, $governorate )
{
  
  $stmnt=$GLOBALS['conn']->prepare("INSERT INTO `users`(`full_name`,`email`,`mobile`,`gender`,`governorate`,`admin_flag`)
  VALUES ('$full_name','$email','$mobile','$gender','$governorate','0');");
  $stmnt->execute();


}

function admins_to_array() 
{

$stmnt=$GLOBALS['conn']->prepare("SELECT * FROM `users` WHERE `admin_flag`='1'");
$stmnt->execute();
$array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
$array=$stmnt->fetchall();
return $array ;
}





function field_to_array (string $table_name, string $field_name) 
 {
    $stmnt=$GLOBALS['conn']->prepare("SELECT `id`,`$field_name` FROM `$table_name`");
    $stmnt->execute();

    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array;

  }



  function get_gov (int $id) {

    $stmnt=$GLOBALS['conn']->prepare("SELECT `governorate` FROM `prices` WHERE `id`='$id'");
    $stmnt->execute();
    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array[0]['governorate'];
    
  }

  function get_price (int $id)
   {

    $stmnt=$GLOBALS['conn']->prepare("SELECT `price` FROM `prices` WHERE `id`='$id'");
    $stmnt->execute();
    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array[0]['price'];
  }


  function get_price_express (int $id)
   {

    $stmnt=$GLOBALS['conn']->prepare("SELECT `price_express` FROM `prices` WHERE `id`='$id'");
    $stmnt->execute();
    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array[0]['price_express'];
  }

  function get_price_Air (int $id)
   {

    $stmnt=$GLOBALS['conn']->prepare("SELECT `price_flight` FROM `prices` WHERE `id`='$id' AND `price_flight` IS NOT NULL ");
    $stmnt->execute();
    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array[0]['price_flight'];
  }

  

  function hatly_shipments_ely_malhash_client()
  {
    $stmnt=$GLOBALS['conn']->prepare("SELECT shipments.id , shipments.destination_governorate , shipments.shipping_service_type ,shipments.destination_address , shipments.order_date, shipments.goods_weight , shipments.message , shipments.picking_address, shipments.price, shipments.shipment_status FROM shipments WHERE shipments.client_id IS NULL;
    ");
    $stmnt->execute();
    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array ; 
    
  }
  
  function hatly_shipments_ely_leeha_client()
  {
    $stmnt=$GLOBALS['conn']->prepare("SELECT users.full_name , users.email , users.mobile , shipments.id , shipments.destination_governorate , shipments.shipping_service_type ,shipments.destination_address , shipments.order_date, shipments.goods_weight , shipments.message , shipments.picking_address, shipments.price, shipments.shipment_status FROM users LEFT JOIN shipments ON users.id = shipments.client_id WHERE shipments.client_id IS NOT NULL;");
    $stmnt->execute();
    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array ; 
  }








  function we_3andak_wa7d_shipment_we_sala7o (string $dest_governorate , string $destination_address , string $shipping_service_type , $order_date , float $goods_weight, string $message , int $client_id , string $picking_address , float $price )
  {
    $stmnt=$GLOBALS['conn']->prepare("INSERT INTO `shipments` (`destination_governorate`, `destination_address`, `shipping_service_type`,`order_date`,`goods_weight`,`message`,`client_id`,`picking_address`,`price`,`shipment_status`)
    VALUES ('$dest_governorate', '$destination_address', '$shipping_service_type','$order_date','$goods_weight','$message','$client_id','$picking_address','$price','waiting')");
    $stmnt->execute();
  }


    function hatly_cliens()

    {

      $stmnt=$GLOBALS['conn']->prepare("SELECT * FROM `users` WHERE `admin_flag`='0'");
      $stmnt->execute();
      $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
      $array=$stmnt->fetchall();
      return $array ;

    }
    function hatly_shipment_mo3yana(int $id)
    {
      $stmnt=$GLOBALS['conn']->prepare(" SELECT * FROM `shipments` WHERE `id`='$id'");  
      $stmnt->execute();

      $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
      $array=$stmnt->fetchall();
      return $array; 
    }

    function hatly_client_of_shipment_mo3yana(int $shipment_id)
    {
      $stmnt1=$GLOBALS['conn']->prepare("SELECT `client_id` FROM `shipments` WHERE `id`='$shipment_id'");
      $stmnt1->execute();
      $array1=$stmnt1->setFetchMode(PDO::FETCH_ASSOC);
      $array1=$stmnt1->fetchall();
      $client_id=$array1[0]['client_id'];
      $stmnt2=$GLOBALS['conn']->prepare("SELECT * FROM `users` WHERE `id`='$client_id'");
      $stmnt2->execute();
      $array2=$stmnt2->setFetchMode(PDO::FETCH_ASSOC);
      $array2=$stmnt2->fetchall();
      return $array2 ; 
    }

    
  






// how to use field_to_array


  // $arrayy=field_to_array("prices","id");
  // echo $arrayy['0']['id'];
  // print_r($arrayy);


  

// how to use get_price

// $price=get_price(1);
// echo $price ;

// $STATMENT=$conn->prepare("SELECT `id`,`governorate`,`price_flight` FROM `prices` WHERE `price_flight` IS NOT NULL;");
// $STATMENT->execute();
// $Airports=$STATMENT->setFetchMode(PDO::FETCH_ASSOC);
// $Airports=$STATMENT->fetchAll();
// print_r($Airports);





?>