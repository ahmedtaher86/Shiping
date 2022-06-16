<?php 
include 'connection.php'; 

class table_manipulation  
{
    protected $table_name;
    protected $conn;

    // awl ma el class yt3raf aw yt3ml mno class mwrooth aw object
    // a ely by7sal ??  ely by7sal el 2aty by3rf constructor bn7ot feeh el database parameters el user name el password el db name el server name 
    // awl ma t3araf el class 7otly fel connection da el object da 
    // fa b3d keda lama teegy tnadeeh hytnada 3ady 
    // this->connection   .............................     hyrga3 lel connection ely et3raf fe awal ma el class et3amal 



    
    public function __construct ($servername = "localhost" , $username = "root" , $password = "" ,  $dbname="shipping"  )
    {
        $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
        
    public function __get($connection)
    {
        $connection=$this->conn;
        return $connection ; 
    }





    public function table_to_array() 
    {
        $stmnt=$this->conn->prepare("SELECT * FROM `$this->table_name`");
        $stmnt->execute();
        $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
        $array=$stmnt->fetchall();
        return $array ;
    }


    function delete_record_from_table_kaza( int $id  )
    {
        $stmnt=$this->conn->prepare("DELETE FROM `$this->table_name` WHERE `id`='$id'");
        $stmnt->execute();
    }


    function field_to_array ( string $field_name) 
    {
        $stmnt=$this->conn->prepare("SELECT `id`,`$field_name` FROM `$this->table_name`");
        $stmnt->execute();
        $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
        $array=$stmnt->fetchall();
        return $array;
    }


  








}









class user_manipulation extends table_manipulation 
{

   protected $table_name = "users";


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



    function hatly_cliens()

    {
        $stmnt=$this->conn->prepare("SELECT * FROM `$this->table_name` WHERE `admin_flag`='0'");
        $stmnt->execute();
        $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
        $array=$stmnt->fetchall();
        return $array ;
    }


}
















class shipment_manipulation extends table_manipulation 
{

   protected $table_name = "shipments";



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










class price_manipulation extends table_manipulation 
{

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


  function get_price_express (int $id)
   {

    $stmnt=$this->conn->prepare("SELECT `price_express` FROM `$this->table_name` WHERE `id`='$id'");
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









}







?>