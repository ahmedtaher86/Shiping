<?php


class table_manipulation  
{
    protected  $table_name;
    protected  $fillable ; 
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
        
    // public function __get()
    // {
    //     $connection=$this->conn;
    //     return $connection ; 
    // }

// 3ayz a3mel setter b7ees a2ool (if) enta d5ltly kaza 3adel fel connection md5ltleesh kaza mt3delsh feeh 


    private function  filterData($data){
        $newArray =[];
        // print_r($this->fillable);
        foreach($this->fillable   as  $fill)
        {

                if(array_key_exists($fill , $data))
                {
                    $newArray[$fill] = $data[$fill];
                }
        }
        return $newArray;

        // new array da 3obara 3an array feeh 

        // (key = coloumn mwgood mn dmn el coloumns btoo3 el data base

        //  => value = el value ely htt7at lel coloumn da  ) 
    }


    private function filterfields (array $FIELDS)
    {
        $newarray=[];
    for ($i=0; $i < count($FIELDS) ; $i++) 
    { 
       if (in_array($FIELDS[$i] , $this->fillable)) {
           array_push($newarray , $FIELDS[$i] );
       }
    }
        return $newarray;
    }

   
    


    public function select() 
    {
        $stmnt=$this->conn->prepare("SELECT * FROM `$this->table_name`");
        $stmnt->execute();
        $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
        $array=$stmnt->fetchall();
        return $array ;
    }

    public function field_to_array ( string $table_name ,string $field_name) 
    {
        $stmnt=$this->conn->prepare("SELECT `id`,`$field_name` FROM `$table_name`");
        $stmnt->execute();
        $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
        $array=$stmnt->fetchall();
        return $array;
    }

    public function field_to_object ( string $table_name ,string $field_name) 
    {
        $stmnt=$this->conn->prepare("SELECT `id`,`$field_name` FROM `$table_name`");
        $stmnt->execute();
        
        $object=$stmnt->fetchall();
        return $object;
    }
   


    public function fields_to_array ( array $fields  , string $condition="" ) 
    {
        $fields=$this->filterfields($fields); 
        $fields = implode("`,`",$fields); 
        $stmnt=$this->conn->prepare("SELECT `id`,`$fields` FROM `$this->table_name`".$condition);
        $stmnt->execute();
        $array= $stmnt->setFetchMode(PDO::FETCH_ASSOC);
        $array=$stmnt->fetchall();
        return $array;

    }





 
    public function select_by_id(int $id)
    {
      $stmnt=$GLOBALS['conn']->prepare(" SELECT * FROM `$this->table_name` WHERE `id`='$id'");  
      $stmnt->execute();

      $array=$stmnt->setFetchMode(PDO::FETCH_ASSOC);
      $array=$stmnt->fetchall();
      return $array; 
    }

    





    public function add(array $data)
    {

        $data = $this->filterData($data);
        // أنت بتمل فلتر للداتا بتشوف اسم الكولومنس صح ولا غلط و لو غلط هترجع ارراي فيه اسم الكولومنس الصح مش الكولمنس الغلط 
        // coloumns el sa7 msh el coloumns el 8alat 
        // echo 'INSERT INTO '.$this->table_name.'('.implode(",",array_keys($data)).') VALUES (\''.implode("','",$data).'\')' ; 
        $stmnt=$this->conn->prepare('INSERT INTO '.$this->table_name.'(`'.implode("`,`",array_keys($data)).'`) VALUES (:'.implode(",:",array_keys($data)).')');
        foreach ($data as $key => $value) 
        {   
        $stmnt->bindParam(":".$key , $data[$key]);  
        }

        return  $stmnt->execute();
       

    }    

    public function addWithLastInsertedId(array $data)
    {

        $data = $this->filterData($data);
        // أنت بتمل فلتر للداتا بتشوف اسم الكولومنس صح ولا غلط و لو غلط هترجع ارراي فيه اسم الكولومنس الصح مش الكولمنس الغلط 
        // coloumns el sa7 msh el coloumns el 8alat 
        // echo 'INSERT INTO '.$this->table_name.'('.implode(",",array_keys($data)).') VALUES (\''.implode("','",$data).'\')' ; 
        $stmnt=$this->conn->prepare('INSERT INTO '.$this->table_name.'(`'.implode("`,`",array_keys($data)).'`) VALUES (:'.implode(",:",array_keys($data)).')');
        foreach ($data as $key => $value) 
        {   
        $stmnt->bindParam(":".$key , $data[$key]);  
        }

     $stmnt->execute();
  
        return $this->conn->lastInsertId();

    }    
    

    public function update ( array $data , string $condition = ""  ) 
    {
        $data = $this->filterData($data);
        $str = '';

        foreach($data as $key=>$value)
        {
    
            $str = $str.$key.'='."'".$value."'".',';
    
        }
        
        $stmnt=$this->conn->prepare('UPDATE ' .$this->table_name. ' SET '.rtrim($str, ',').$condition);
        $stmnt->execute() ;

    } 



    function delete( int $id  )
    {
        $stmnt=$this->conn->prepare("DELETE FROM `$this->table_name` WHERE `id`='$id'");
        $stmnt->execute();
    }

 

}



class User  extends table_manipulation

{

    protected $table_name = "users";
    protected $fillable = ["full_name", "email", "password", "mobile", "gender", "governorate", "admin_flag"];

}

class shipment  extends table_manipulation

{

    protected $table_name = "shipments";
    protected $fillable = ["destination_governorate", "destination_address", "shipping_service_type", "order_date", "goods_weight", "message", "client_id", "picking_address", "price", "courier_id", "shipment_status"];

}


class price  extends table_manipulation

{

    protected $table_name = "prices";
    protected $fillable = ["governorate", "price", "price_flight", "price_express"];

}


class courier  extends table_manipulation

{

    protected $table_name = "users";
    protected $fillable = ["name", "phone", "client_id", "shipment_id", "working_flag"];

}









// $obj = new User();
// $obj -> add($data = array('full_name' => "ahmedtaher" ,'password' => "1234567" , 'email' => "ahmedsha5a@yahoo.com" , 'gender' => "mo5anas" , 'governorate' => "3asher"  , 'admin_flag' => '0', 'mobile' => '01000682552' )) ;
//    $obj2 = new User(); 
//    $obj2 -> update(['full_name' => "ahmedtaherrrr" ,'password' => "1234567777" , 'email' => "ahmedsha5aaaaa@yahoo.com" , 'gender' => "mo5anassss" , 'governorate' => "3asherrrr"  , 'admin_flag' => '0', 'mobile' => '01000682552' ]) ;



?>