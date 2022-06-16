<?php 
 
 require_once 'table_manipulation.php' ; 


class shipment_manipulation extends table_manipulation 
{

   protected $table_name = "shipments";
   protected $fillable = ["destination_governorate", "destination_address", "shipping_service_type", "order_date", "goods_weight", "message", "client_id", "picking_address", "price", "courier_id", "shipment_status"];


   function we_3andak_wa7d_shipment_we_sala7o (string $dest_governorate , string $destination_address , string $shipping_service_type , $order_date , float $goods_weight, string $message , int $client_id , string $picking_address , float $price , string $shipment_status = "waiting")
   {
     $stmnt=$this->conn->prepare("INSERT INTO `$this->table_name` (`destination_governorate`, `destination_address`, `shipping_service_type`,`order_date`,`goods_weight`,`message`,`client_id`,`picking_address`,`price`,`shipment_status`)
     VALUES ('$dest_governorate', '$destination_address', '$shipping_service_type','$order_date','$goods_weight','$message','$client_id','$picking_address','$price','$shipment_status')");
     $stmnt->execute();
   }


   function hatly_shipment_mo3yana(int $id)
   {
     $stmnt=$this->conn->prepare(" SELECT * FROM `$this->table_name` WHERE `id`='$id'");  
     $stmnt->execute();
 
     $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC); 
     $array=$stmnt->fetchall();
     return $array; 
   }

   

   function hatly_shipments_ely_malhash_client()
   {
     $stmnt=$this->conn->prepare("SELECT shipments.id , shipments.destination_governorate , shipments.shipping_service_type ,shipments.destination_address , shipments.order_date, shipments.goods_weight , shipments.message , shipments.picking_address, shipments.price, shipments.shipment_status FROM shipments WHERE shipments.client_id IS NULL;
     ");
     $stmnt->execute();
     $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
     $array=$stmnt->fetchall();
     return $array ; 
     
   }

   function hatly_shipments_ely_leeha_client()
  {
    $stmnt=$this->conn->prepare("SELECT users.full_name , users.email , users.mobile , shipments.id , shipments.destination_governorate , shipments.shipping_service_type ,shipments.destination_address , shipments.order_date, shipments.goods_weight , shipments.message , shipments.picking_address, shipments.price, shipments.shipment_status FROM users LEFT JOIN shipments ON users.id = shipments.client_id WHERE shipments.client_id IS NOT NULL;");
    $stmnt->execute();
    $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
    $array=$stmnt->fetchall();
    return $array ; 
  }

  function hatly_client_of_shipment_mo3yana(int $shipment_id)
  {
    $stmnt1=$this->conn->prepare("SELECT `client_id` FROM `$this->table_name` WHERE `id`='$shipment_id'");
    $stmnt1->execute();
    $array1=$stmnt1->setFetchMode(PDO::FETCH_ASSOC);
    $array1=$stmnt1->fetchall();
    $client_id=$array1[0]['client_id'];
    $stmnt2=$this->conn->prepare("SELECT * FROM `users` WHERE `id`='$client_id'");
    $stmnt2->execute();
    $array2=$stmnt2->setFetchMode(PDO::FETCH_ASSOC);
    $array2=$stmnt2->fetchall();
    return $array2 ; 
  }

  
   

    
}






?>