<?php

include 'navbar.php';
require_once 'models/table_manipulation.php' ; 
require 'models/prices_model.php';
require 'models/shipment_model.php';
require 'models/user_model.php';

$TABLE = new table_manipulation(); 

$PRICE =new price_manipulation() ; 
$SHIPMENT = new shipment_manipulation(); 
$USER = new user_manipulation() ;


if(isset($_SESSION['logged-in']) && ($_SESSION['login-type'])==='admin')
{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>admin panel</title>
    <link rel="icon" type="image/x-icon" href="images/shipping-icon-png-11.jpg">

<!-- bootstrap include  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="css/styles.css">


<!-- google fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat|Ubuntu" rel="stylesheet">


<!-- bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<body>

<div>
      <?php if(!empty($_SESSION['logged-in']) && $_SESSION['login-type']='admin')
      { ?>
       <br><br>
        <p style="text-align:center;">hi<b> <?php echo $_SESSION['user-fullname'];?> </b> you can use jimy-Shipping Admin Panel</p>
     <?php
     }
        ?>
</div>

    <br><br>

    <?php if(isset($_GET['crud']) && $_GET['crud']=='ADMINS') { ?> 
        <p style="text-align:center;color:red;font-size:50px;">Admins of Jimy shipping</p>
        <div style="position:absolute;left:25%;text-align: center;">
        <table style="border: 1px solid;" id="url_table" border="1" cellpadding="0" cellspacing="1">
         <th>admin full name</th>
         <th>email</th>
         <th>mobile</th>
         <?php 
         if (isset($_GET['addnewadmin'])) {?>
         <th>password</th> 
        <?php } ?>
         <th>Action</th>
         <?php
        if(isset($_POST['confirm_new_admin']))
        { 

        echo "<p style='text-align:center;color:red;font-size:35px;'><b> a new admin has been add </b></p>";
        $USER->add_new_admin($_POST['full-name'],$_POST['email'],$_POST['mobile'],$_POST['password']);

        }
        elseif (isset($_GET['deleteadmin'])) 
        {
            $id=$_GET['deleteadmin'];
            $USER->delete($id);

        }



        $admins_array=$USER->admins_to_array();
        $number_of_admins=count($admins_array);



        for ($i=0 ; $i<$number_of_admins ; $i++) { ?>
           <tr>
               <td><?php echo $admins_array[$i]['full_name']; ?></td>
               <td><?php echo $admins_array[$i]['email']; ?></td>
               <td><?php echo $admins_array[$i]['mobile']; ?></td>
               <?php if (isset($_GET['addnewadmin'])) {?>
                <td></td> 
        <?php } ?>
                <td> <a class="btn btn-primary" href="admin_panel.php?crud=ADMINS&deleteadmin=<?php echo $admins_array[$i]['id']; ?>">delete admin</a></td>
           </tr>
        
        
        <?php }
        
        if(isset($_GET['addnewadmin']))
        {?>
        <form action="admin_panel.php?crud=ADMINS&addnewadmin=true" method="post">
        <tr>
        <td><input type="text" name="full-name"></td>
        <td><input type="text" name="email"></td>
        <td><input type="text" name="mobile"></td>
        <td><input type="password" name="password"></td>
        <td><input type="submit" value="add admin" name="confirm_new_admin"></td>
        </tr>
        </form>
         <?php } ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <?php if (isset($_GET['addnewadmin'])) {?>
                <td></td> 
        <?php } ?>
            <td><a class="btn btn-primary" href="admin_panel.php?crud=ADMINS&addnewadmin=true">add new admin</a></td>
        </tr>


        </table>
        <?php 
        
        // if(isset($_POST['confirm_new_admin']))
        // { 

        // echo "<p style='text-align:center;color:red;font-size:35px;'><b> a new admin has been add </b></p>";
        // add_new_admin($_POST['full-name'],$_POST['email'],$_POST['mobile'],$_POST['password']);

        // }
        // elseif (isset($_GET['deleteadmin'])) 
        // {
        //     $id=$_GET['deleteadmin'];
        //     delete_record_from_table_kaza("users",$id);

        // }
        ?>
        </div>  
    <?php } ?>

    <?php if(isset($_GET['crud']) && $_GET['crud']=='COURIERS') { ?> 

        <div style="text-align: center;">
          
        
          </div>  


    <?php } ?>

    <?php if(isset($_GET['crud']) && $_GET['crud']=='CLIENTS') { ?> 
        <p style="text-align:center;color:red;font-size:50px;">Clients of Jimy shipping</p>
        <div style="text-align: center;">
        <table style="position:absolute;left:200px;border: 1px solid;" id="url_table" border="1" cellpadding="0" cellspacing="1">
         <th style='border: 1px solid black;'>&nbsp;&nbsp;Client full name</th>
         <th style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;email</th>
         <th style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;mobile</th>
         <th style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;gender</th> 
         <th style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;governorate</th>
         <th style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action</th>
        <?php

        if(isset($_POST['confirm_new_client']))
        { 

        
        $USER->add_new_client($_POST['full_name'],$_POST['email'],$_POST['mobile'],$_POST['gender'],$_POST['governorate']);
        

        }
        elseif (isset($_GET['deleteclient'])) 
        {
            $id=$_GET['deleteclient'];
            $USER->delete($id);

        }





        $clients_array=$USER->hatly_clients();
        $number_of_clients=count($clients_array); 

        for ($i=0 ; $i<$number_of_clients ; $i++) { ?>
           <tr>
               <td style='border: 1px solid black;'>&nbsp;&nbsp;<?php echo $clients_array[$i]['full_name']; ?></td>
               <td style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_array[$i]['email']; ?></td>
               <td style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;<?php echo $clients_array[$i]['mobile']; ?></td>
               <td style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;<?php echo $clients_array[$i]['gender']; ?></td>
               <td style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_array[$i]['governorate']; ?></td>  
               <td style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-primary" href="admin_panel.php?crud=CLIENTS&deleteclient=<?php echo $clients_array[$i]['id'];?>">delete this Client</a></td>
           </tr>
        
        
        <?php }
        
        if(isset($_GET['addnewclient']))
        {?>
        <form action="admin_panel.php?crud=CLIENTS&addnewclient=true" method="post">
        <tr>
        <td style='border: 1px solid black;'><input type="text" name="full_name"></td>
        <td style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email"></td>
        <td style='border: 1px solid black;'><input type="text" name="mobile"></td>
        <td style='border: 1px solid black;'><select name="gender"><option value="male">male</option><option value="female">female</option></select></td>
        <td style='border: 1px solid black;'>
            <select name="governorate">
            <option value="Cairo">Cairo</option>
            <?php 
                    $stmnt=$conn->prepare("SELECT `governorate` FROM `prices`");
                    $stmnt->execute();
                    $objecT=$stmnt->fetchall();
                    foreach ($objecT as $value) {
                    echo "<option value=";echo$value['governorate'];echo">";echo $value['governorate'];echo"</option>";
             }?>
        
            </select>
        </td>

        <td style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="submit" name="confirm_new_client"></td>
        </tr>
        </form>
         <?php } ?>
        <tr>
            <td style='border: 1px solid black;'></td>
            <td style='border: 1px solid black;'></td>
            <td style='border: 1px solid black;'></td>
            <td style='border: 1px solid black;'></td>
            <td style='border: 1px solid black;'></td>
            <td style='border: 1px solid black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-primary" href="admin_panel.php?crud=CLIENTS&addnewclient=true">add new client</a></td>
        </tr>


        </table>
        </div> 
    
      
        




        
    <?php } ?>

    <?php if(isset($_GET['filter']) && $_GET['filter']=='SHIPMENTS') 
    { if(isset($_POST['Confirm_shipment'])) { ?>
        <?php
        

        $client_full_name=$_POST['client_full_name'];
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $client_message=$_POST['client_message'];
        $service_type=$_POST['service_type'];
        $destination_address=$_POST['destination_address'];
        $shipment_destination= $_POST['shipment_destination'] ;
        $goods_weight=$_POST['goods_weight'];
        $picking_address=$_POST['picking_address'];



        if($service_type=="normal")
        {
                $price=$PRICE->get_price_by_gov($_POST['shipment_destination']);

                $price=$price+($_POST['goods_weight']*5);
        }



        elseif($service_type=="express")
        {
        $price=$PRICE->get_price_express_by_gov($_POST['shipment_destination']);

        $price=$price+($_POST['shipment_weight']*5);
        }



        elseif($service_type=="air")
        {
        $price=$PRICE->get_price_Air_by_gov($_POST['shipment_destination']);
        }


        $last_id=$USER->addWithLastInsertedId(["full_name" =>$client_full_name,"email" => $email ,"mobile" => $mobile ,"admin_flag" =>"2"]);

        $SHIPMENT->we_3andak_wa7d_shipment_we_sala7o($shipment_destination,
        $destination_address,
        $service_type,
        date('Y-m-d H:i:s'),
        $goods_weight,$client_message,
        $last_id,
        $picking_address,
        $price,
        "approved"
        );


        ?>












    <?php } ?>

        <button style="position:absolute;left:45%;" type="button" class="btn btn-danger" onclick="location.href='admin_panel.php?filter=SHIPMENTS&addnewshipment=true'">Add Shipment</button>
<br><br><br>
    <?php if(isset($_GET['addnewshipment'])){  ?>
    <form style="position: relative; left:100px;" action="admin_panel.php?<?php echo $_SERVER['QUERY_STRING'];?>&shipmentadded=true"  method="POST" >
        <label style="position: relative;left: 500px;" for="service_type">service type :</label>
        <select style="position: relative;left: 500px;" name="service_type" id="service_type" onchange="navigate('admin_panel.php?filter=SHIPMENTS&addnewshipment=true&service_type=')">
            <option <?php if(isset($_POST['service_type']) && ($_POST['service_type'] == "normal") || (isset($_GET['service_type']) && ($_GET['service_type'] == "normal")) ) {?> selected <?php }?>  value="normal">jimyshipping-normal</option>
            <option <?php if(isset($_POST['service_type']) && ($_POST['service_type'] == "express") || (isset($_GET['service_type']) && ($_GET['service_type'] == "express")) ) {?> selected <?php }?> value="express">jimyshippng-express</option>
            <option <?php if(isset($_POST['service_type']) && ($_POST['service_type'] == "air") ||  (isset($_GET['service_type']) && ($_GET['service_type'] == "air")) ) {?>   selected <?php } ?>   value="air">jimyshippng-air</option>
        </select>
    <br><br>
        <label for="client_full_name">client full name : </label><input  required  type="text" name="client_full_name" id="client_full_name" <?php if (isset($_POST['Confirm_shipment'])){ ?> value="<?php echo $_POST['client_full_name']; ?>" <?php } ?>>
        <label for="email">email : </label><input  required  type="email" name="email" id="email" <?php if (isset($_POST['Confirm_shipment'])){ ?> value="<?php echo $_POST['email']; ?>" <?php } ?>>
        <label for="mobile">mobile : </label><input required  type="text" name="mobile" id="mobile" <?php if (isset($_POST['Confirm_shipment'])){ ?> value="<?php echo $_POST['mobile']; ?>" <?php } ?>>
        <label for="client_message">client message :</label>
        <textarea   id="client_message" name="client_message" ></textarea>
    
    <br><br>
        <label for="destination_address">destination address :</label>
        <input required  type="text" name="destination_address" id="destination_address" <?php if (isset($_POST['Confirm_shipment'])){ ?> value="<?php echo $_POST['destination_address']; ?>" <?php } ?>>
    
        <label for="shipment_destination">shipment destination : </label>
        <select   name="shipment_destination" id="shipment_destination">

        <?php $governorates=$PRICE->field_to_array("prices","governorate");
        if ( (!isset($_GET['service_type'])) ||  (isset($_GET['service_type']) && $_GET['service_type'] != "air") ) {
        foreach ($governorates as $key => $value)
        { ?>

            <option <?php if(isset($_POST['shipment_destination']) && ($_POST['shipment_destination'] == $value['governorate'])) {?> selected <?php }?> value="<?php echo $value['governorate']; ?>"><?php echo $value['governorate']; ?></option>    

       <?php  } } if ( isset($_GET['service_type']) && $_GET['service_type'] == "air" ) { $GOVS = $PRICE->get_governorate_and_price_air (); 
        foreach ($GOVS as $key => $value ) { ?>

            <option <?php if(isset($_POST['shipment_destination']) && ($_POST['shipment_destination'] == $value['governorate'])) {?> selected <?php }?> value="<?php echo $value['governorate']; ?>"><?php echo $value['governorate']; ?></option>
       
        <?php }} ?>

        </select>
        <label for="goods_weight">goods weight</label>
        <input required  type="text" name="goods_weight" id="goods_weight" <?php if (isset($_POST['Confirm_shipment'])){ ?> value="<?php echo $_POST['goods_weight']; ?>" <?php } ?> >
        <label for="picking_address">picking address :</label>
        <input required  type="text" name="picking_address" id="picking_address" <?php if (isset($_POST['Confirm_shipment'])){ ?> value="<?php echo $_POST['picking_address']; ?>" <?php } ?>>
        <br><br><br>
        <input type="submit" value="Confirm Shipment" class="btn btn-warning" style="position:absolute;left:38%;" name="Confirm_shipment">
    </form>
        <br><br><br>
<?php if(isset($_POST['Confirm_shipment'])) {  echo "<p style='text-align:center;color:red;font-size:30px;'> shipment is successfully added  </p>" ;    }?>
<br><br>

    <?php } ?>
        



        <p style="text-align:center;color:red;font-size:50px;">Orders of Jimy shipping</p>
        


        <div style="text-align: center;">
          <table style="position:absolute;left:20px;border: 1px solid;">
            <thead>
                <th>&nbsp;&nbsp;&nbsp;client full name</th>
                <th>&nbsp;&nbsp;&nbsp;email</th>
                <th>&nbsp;&nbsp;&nbsp;mobile</th>
                <th>&nbsp;&nbsp;&nbsp;shipment destination</th>
                <th>&nbsp;&nbsp;&nbsp;service type</th>
                <th>&nbsp;&nbsp;&nbsp;destination address</th>
                <th>&nbsp;&nbsp;&nbsp;order date</th>
                <th>&nbsp;&nbsp;&nbsp;goods weight</th>
                <th>&nbsp;&nbsp;&nbsp;client message</th>
                <th>&nbsp;&nbsp;&nbsp;picking address</th>
                <th>&nbsp;&nbsp;price&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;shipment status</th>
                <th>&nbsp;&nbsp;&nbsp;Action</th>
                
            </thead>
       
            <tbody>
                <?php if (isset($_GET['deleteshipment'])) 
                         {
                         $ID=$_GET['deleteshipment'];
                         $SHIPMENT->delete($ID);
                         }?>

                     <?php 

                       $orders=$SHIPMENT->hatly_shipments_ely_leeha_client();  ?>

                     <?php $orders_of_admin=$SHIPMENT->hatly_shipments_ely_malhash_client(); ?>


                <?php foreach ($orders as $key => $value) { ?>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['full_name'];?> </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['email'];?> </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['mobile'];?> </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['destination_governorate'];?> </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['shipping_service_type'];?> </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['destination_address'];?> </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['order_date'];?> </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['goods_weight'];  ?> KG</td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['message'];  ?>  </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['picking_address'];  ?>  </td>
                    <td>&nbsp;<?php echo $value['price'];?> LE &nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['shipment_status'];?>  </td>
                    <td>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-primary" href="admin_panel.php?filter=SHIPMENTS&deleteshipment=<?php echo $value['id'];?>">delete</a>
                        <a class="btn btn-primary" href="edit.php?edit_shipment_leeha_client_id=<?php echo $value['id'] ;?>">edit</a>
                    </td>
                </tr>
                <?php } ?>
                <?php foreach ($orders_of_admin as $key => $value) { ?>
                <tr>
                    <td>
                    </td>

                    <td>
                    </td>
                    
                    <td>
                   
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['destination_governorate'];  ?> 
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['shipping_service_type'];?>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['destination_address'];  ?>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['order_date']; ?>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['goods_weight'];  ?> KG 
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['message'];  ?>  </td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['picking_address'];  ?>
                    </td>

                    <td>&nbsp;<?php echo $value['price'];  ?> LE 
                     &nbsp;&nbsp;&nbsp;
                    </td>
                    
                    <td>&nbsp;&nbsp;&nbsp;<?php echo $value['shipment_status'];  ?>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-primary" href="admin_panel.php?filter=SHIPMENTS&deleteshipment=<?php echo $value['id'];?>">delete</a>
                        <a class="btn btn-primary" href="edit.php?filter=SHIPMENTS&edit_shipment_mlhash_client_number=<?php echo $value['id'];?>">edit</a>
                    </td>
                </tr>
                <?php } ?>
                    
        






            </tbody>


          </table>
        </div>
        
        

        

    <?php } ?>





    


 







</body>
<script>
    
    function navigate(url){
        service_type = document.getElementById("service_type").value
        location.href = url+service_type;

    }
</script>
</html>

<?php }

 

else

{ ?>
<html>

<body>

<?php echo "<p style='text-align:center;color:red;font-size:70px;'><b>This page is for admins only . . . . . . . </b></p>" ; ?>


</body>
</html>
<?php
}

?>






