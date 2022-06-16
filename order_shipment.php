<?php 

include 'functions.php';
require_once 'models/table_manipulation.php' ; 
require 'models/prices_model.php';
require 'models/shipment_model.php';


$TABLE = new table_manipulation(); 

$PRICE =new price_manipulation() ; 

$SHIPMENT = new shipment_manipulation(); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>order a shipment</title>
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

<?php 
include 'navbar.php' ;

?>
    <?php if(isset($_SESSION['logged-in']) && ($_SESSION['logged-in'])==true) {
    ?> 

    <h1 style="text-align: center;"> order a shipment </h1>
    <br>
    <form action="order.php" method="POST" style="text-align: center;">
        <label for="service_type">Select Shipment Service Type :</label>
        <select name="service_type" id="service_type" >
            <option <?php if(isset($_GET['service_type']) && ($_GET['service_type']=="normal")){?> selected <?php }?> value="normal" >jimyshipping-normal</option>
            <option  <?php if(isset($_GET['service_type']) && ($_GET['service_type']=="express")){?> selected <?php }?> value="express" >jimyshipping-express</option>
            <option  <?php if(isset($_GET['service_type']) && ($_GET['service_type']=="air")){?> selected <?php }?> value="air" >jimyshipping-air</option>
        </select>
        
        <button type="button" onclick="navigate('order_shipment.php?service_type=')">select</button>
        
        
        <?php if((isset($_GET['service_type']) && $_GET['service_type']=='normal') || (isset($_GET['service_type']) && $_GET['service_type']=='express'))


        { ?>
        <br><br>
        <label for="destination_address">destination address:</label>
        <input type="text" id="destination_address" name="destination_address" style="width: 500px;" placeholder="TYPE THE DETAILED TARGETED LOCATION OF THE SHIPMENT">
        <br><br>
        <label for="destination_governorate">Select destination governorate :</label>
        <select name="destination_governorate" >
            <?php $governorates=$PRICE->field_to_array("prices","governorate"); 
            foreach($governorates as $key => $value){?>

            
                <option value="<?php echo $value['id']; ?>"> <?php echo $value['governorate']; ?> </option>
        
            <?php } ?>
        </select>
        <br><br>
        
        <label for="shipment_weight">Shipment Weight:</label>
        <input type="text" name="shipment_weight" style="width: 300px;" id="shipment_weight" placeholder="ENTER SHIPMENT WEIGHT IN Kg">
        <br><br>
        <label for="picking_address">picking address:</label>
        <input type="text" style="width:500px;" id='picking_address' name="picking_address" placeholder="TYPE THE DETAILED PICKING LOCATION OF THE SHIPMENT" >
        <br><br>
        <label for="message">message about your shipment :</label>
        
        <input type="text" name="message" style="height: 100px;width: 200px;"  id="message">
        <br><br>
        <input type="submit" name="submitt" value="Submit Order" >



        <?php } 
         else if ((isset($_GET['service_type']) && $_GET['service_type']=='air')) {?>

        <br><br>
        <label for="destination_address">destination address:</label>
        <input type="text" id="destination_address" name="destination_address" style="width: 500px;" placeholder="TYPE THE DETAILED TARGETED LOCATION OF THE SHIPMENT">
        <br><br>
        <label for="destination_governorate">Select destination governorate :</label>
        <select name="destination_governorate" >
            <?php $governorates=$PRICE->get_governorate_and_price_air(); 
            foreach($governorates as $key => $value){?>

            
                <option value="<?php echo $value['id']; ?>"> <?php echo $value['governorate']; ?> </option>
        
            <?php } ?>
        </select>
        <br><br>
        
        <label for="shipment_weight">Shipment Weight:</label>
        <input type="text" name="shipment_weight" style="width: 300px;" id="shipment_weight" placeholder="ENTER SHIPMENT WEIGHT IN Kg">
        <br><br>
        <label for="picking_address">picking address:</label>
        <input type="text" style="width:500px;" id='picking_address' name="picking_address" placeholder="TYPE THE DETAILED PICKING LOCATION OF THE SHIPMENT" >
        <br><br>
        <label for="message">message about your shipment :</label>
        
        <input type="text" name="message" style="height: 100px;width: 200px;"  id="message">
        <br><br>
        <input type="submit" name="submitt" value="Submit Order" >

        <?php }?>

    </form>
    <?php }
    else
    { ?>
            <h1 style="text-align:center;color:red;" >please login to order a shipment</h1>
            <br><br>
            <p style="text-align:center;">dont have an account ?? </p>
            <div style="text-align:center;"><a href="register.php" style="text-align:center;">Create new jimy shipping account</a></div>
   <?php } ?>
</body>
<script>
    
    function navigate(url){
        service_type = document.getElementById("service_type").value
        location.href = url+service_type;

    }
</script>
</html>