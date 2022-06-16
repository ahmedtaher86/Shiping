<!DOCTYPE html>
<?php 
include 'functions.php';
session_start();
if(isset($_SESSION['login-type']) && $_SESSION['login-type'] == 'admin')
{
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit a database record</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="" type="image/x-icon" href="images/shipping-icon-png-11.jpg">

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
    <h1 style="text-align: center;color:red;"> edit a shipment record</h1>
    <?php if (isset($_POST['submit'])) {
    $client_id= $_POST['client_id']; 
    $shipment_id=$_POST['shipment_id'];   
    $full_name= $_POST['full_name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];



    $destination_governorate=$_POST['destination_governorate'];
    $destination_address=$_POST['destination_address'];
    $shipping_service_type=$_POST['shipping_service_type'];
    $goods_weight=$_POST['goods_weight'];
    $picking_address=$_POST['picking_address'];
    $price=$_POST['price'];
    $shipment_status=$_POST['shipment_status'];


    $update1=$conn->prepare("UPDATE `users`
    SET `full_name` = '$full_name', `email` = '$email' , `mobile` = '$mobile'  
    WHERE `id`= '$client_id';");
    $update1->execute();


    $update2=$conn->prepare("UPDATE `shipments`
    SET `destination_governorate` = '$destination_governorate', `destination_address` = '$destination_address' , `shipping_service_type` = '$shipping_service_type', `goods_weight` = '$goods_weight'
    , `picking_address` = '$picking_address'  , `price` = '$price' , `shipment_status`='$shipment_status' 
    WHERE `id`= '$shipment_id';");
    $update2->execute();





    



    }?>  







    <?php if (isset($_GET['edit_shipment_leeha_client_id']))
    {
        
      $selected_shipment=hatly_shipment_mo3yana($_GET['edit_shipment_leeha_client_id'])  ;
      $client_array=hatly_client_of_shipment_mo3yana($_GET['edit_shipment_leeha_client_id']);  
    }

    print_r($selected_shipment);
    
    


    
    ?>
    
    





    <br><br><br>
    <form style="text-align: center;" method="POST" action="edit.php?<?php echo $_SERVER['QUERY_STRING']; ?>&updated_successfully=true">
    <label for="shipment_id">shipment id :</label>
    <input type="text" id="shipment_id" name="shipment_id" value="<?php echo $selected_shipment[0]['id'] ; ?>" readonly>
    <label for="client_id">client id :</label>
    <input type="text" id="client_id" name="client_id" value="<?php echo $client_array[0]['id'] ; ?>" readonly><br>
    <label for="full_name">client full name:</label>
    <input style="width:500px;" type="text" name ="full_name" id="full_name" value="<?php echo $client_array [0]['full_name'] ; ?>">
    <br>
    <label for="email">email:</label>
    <input style="width:500px;" type="email" name ="email" id="email" value="<?php echo $client_array [0]['email'] ; ?>">
    <br>
    <label for="mobile">mobile:</label>
    <input style="width:500px;" type="text"  name ="mobile" id="mobile" value="<?php echo $client_array [0]['mobile'] ; ?>">
    <br>
    <label for="destination_governorate">destination governorate:</label>
    <select name="destination_governorate" id="destination_governorate">
        <?php 
        $governorates=$conn->prepare("SELECT `governorate` FROM `prices`");
        $governorates->execute();
        $array_of_governorates=$governorates->setFetchMode(PDO::FETCH_ASSOC);
        $array_of_governorates=$governorates->fetchall();
        ?>
        <option selected value="<?php echo $selected_shipment[0]['destination_governorate']; ?>"><?php echo $selected_shipment[0]['destination_governorate']; ?></option>
        <?php 
        foreach($array_of_governorates as $key => $value)
        { ?>
      
        <option value="<?php echo $value['governorate'] ; ?>"><?php echo $value['governorate'] ; ?></option>
        
        <?php }
        ?>
        
    </select>
    <br>
    <label for="destination_address"> destination address:</label>
    <input style="width:500px;" type="text" name="destination_address" id="destination_address" value="<?php echo $selected_shipment[0]['destination_address']; ?>">
    <br>
    <label for="shipping_service_type">service type:</label>
    <select name="shipping_service_type" id="shipping_service_type">
        <?php 
        $servicetypes= array ("normal",
            "express",
            "air"); ?>
            
        <?php foreach ($servicetypes as $key => $value )
        
        {?>

            <?php if ($value==$selected_shipment[0]['shipping_service_type']) 

                { ?>
                
                <option value="<?php echo $value;?>" selected  >jimyshipping-<?php echo $value ; ?></option> 
            <?php }

                 else 

                 { ?>

            <option value="<?php echo $value ;?>"> jimyshipping-<?php echo $value ; ?>  </option>
            
           <?php }

        } ?>
    </select>
    <br>
    <label for="order_date">date of order:</label>
    <?php $date=date("Y-m-d",strtotime($selected_shipment[0]['order_date']));?>
    <input type="date"  id="order_date" name="order_date" value="<?php echo $date;  ?>" readonly>
    <br>
    <label for="goods_weight">goods weight:</label>
    <input type="text" id="goods_weight" name="goods_weight" value="<?php echo $selected_shipment[0]['goods_weight'] ?>">
    <br>
    <label for="picking_address"> picking address:</label>
    <input style="width:500px;" type="text" id="picking_address" name="picking_address" value="<?php echo $selected_shipment[0]['picking_address'] ;?>">
    <br>
    <label for="price"> EGP price:</label>
    <input style="width:500px;" type="text" id="price" name="price" value="<?php echo $selected_shipment[0]['price'] ;?>">
    <br>
    <?php 
    $status=array ("waiting","approved","picked from warehouse","on delivery","delivered");
    
    ?>
    <label for="shipment_status"> shipment status:</label>
    <select name="shipment_status" id="shipment_status">
    <?php if ($selected_shipment[0]['shipment_status'] == "waiting")
    {?> 

        <option value="canceled">canceled</option>

<?php }  ?>
    <?php  foreach ($status as $key => $value)
        {
        if($value == $selected_shipment[0]['shipment_status']){ ?>

        <option selected value="<?php echo $value; ?>"> <?php echo $value; ?> </option>
        <option value="<?php echo $status[$key+1]; ?>"> <?php echo $status[$key+1]; ?> </option>


        <?php } ?>
    <?php } ?>
    </select>
    <br>
    <input value="UPDATE" type="submit" name="submit">


    








    </form>
  <br>
  <?php if(isset($_GET['updated_successfully'])) {
      echo "<h3 style='text-align:center;color:red;'>the shipment information has been updated successfully <3 </h3>";
  }
  ?>



    
    
</body>
</html>

<?php } else { ?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit a database record</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

     <h1 style="text-align:center;color:red;"> this edit page is only for admins . . . </h1>
            <br><br><br>
     <div style="text-align: center;"> 
            <img style="width:700px;height:700px;"src="images/555 3ayz a.jpg" alt="55555?hthzar_m3aya?">
     </div>
    
</body>
</html>

<?php } ?>