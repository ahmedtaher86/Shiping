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


?>




<html>
<head>
<title>Pricing</title>
<!-- fav icon -->
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



<style>
    
/* hr{
border-style:dotted none none ;
border-color: black;
border-width: 15px;
width: 10%;


} */

/* a:link {
  background-color: #ceb98c;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
} */

/* visited link */
/* a:visited {
    background-color: #ceb98c;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
} */

/* mouse over link */
/* a:hover
{
  color: blue;
  background-color: #ceb98c;
} */

/* selected link */
/* a:active 
{
  color: blue;
  background-color: #ceb98c;
}
body{
    background-color:#ceb98c;



} */



</style>

    


</head>


<body>
<br><br><br>
        <div style="text-align: center;">
            <div class="row">
                <div class="col-lg-6">
                     <h1>Select your pricing pack</h1>
                     <p>
                     We offer only customer-oriented logistic solutions. Logistic Business is a global supplier of transport solutions 
                     </p>
                     <button onclick="location.href='pricing.php?show=calc_price'" type="button" class="btn btn-outline-light btn-lg"> Calculate my shipping price </button>
                     
                </div>
                <div class="col-lg-6">
                    <img src="images/meya-meya.jpg" alt="meya-meya">
                </div>
            </div>
        </div>
       
        <?php if ((isset($_GET['show']) && $_GET['show']=="calc_price") || isset($_GET['service-type']) ) { ?>
        
            
        <div >
            
               <p style="color:red; margin:2% ;"><b>hint : shipment start point is Cairo-Egypt<b></p>
               <br>
               <form action="pricing.php?show=calc_price"  method="get">
                 <label for="service-type">Select jimy shipping service type</label>
                <select class="custom-select col-lg-4" name="service-type">
                  <option <?php if(isset($_GET['service-type']) && $_GET['service-type']=="normal" ) {?> selected <?php } ?> value="normal">jimyshipping normal</option>
                  <option <?php if(isset($_GET['service-type']) && $_GET['service-type']=="express" ) {?> selected <?php } ?> value="express">jimyshipping express</option>
                  <option <?php if(isset($_GET['service-type']) && $_GET['service-type']=="air" ) {?> selected <?php } ?> value="air">jimyshipping Air-Freight</option>
                </select>
                <input type="submit" class="btn btn-primary" style="background-color:red;" Value='Confirm'>
               </form>
              

                <?php if (isset($_GET['service-type']) && $_GET['service-type']=="normal") {?>    
                <br>

                <form action="pricing.php?<?php echo $_SERVER['QUERY_STRING'];?>" method="post">
                <label for="destination">Select your Shipment destination</label>
                <select class="custom-select col-lg-1" name="destination">
                    <?php

                    $governorates=$TABLE->field_to_array("prices","governorate");
                    foreach ($governorates as $key => $value){?> 
                    
                    <option value="<?php echo $value['id'];?>"><?php echo $value['governorate']; ?></option>
                    

                    <?php }

                    ?>
                </select>
                <label for="weight">Enter Shipment Wight in Kilograms</label>
                <input class="col-lg-2" type="text" name="weight">
                
                <input type="submit" class="btn btn-primary" style="background-color:red;" name="submit" value="Calculate">
               </form>
               <br>

               <?php if (isset($_POST['destination']) && filter_var($_POST['weight'],FILTER_VALIDATE_FLOAT) == true )
               {
                   $weight=$_POST['weight']; 
                   $governorate=$PRICE->get_gov($_POST['destination']);
                   $price=$PRICE->get_price($_POST['destination']);
                   $price_neha2y=($price+($weight*5)); 
                   echo "Shipment Price From Cairo to "."<p style='color:red;display:inline;'>".$governorate."</p>"." is "."<p style='color:red;display:inline;'>".$price_neha2y." LE </p>";
               }
               else if (isset($_POST['submit']) && filter_var($_POST['weight'],FILTER_VALIDATE_FLOAT) == FALSE  ) {
                echo "please fill the required fields correctly";
               }
               
               ?>
            
                <?php }

                elseif (isset($_GET['service-type']) && $_GET['service-type']=="express") 
                {
                ?>
                <br>

                <form action="pricing.php?<?php echo $_SERVER['QUERY_STRING'];?>"  method="post">
                <label for="destination">Select your Shipment destination</label>
                <select class="custom-select col-lg-1" name="destination">
                    <?php
                    $governorates=$TABLE->field_to_array("prices","governorate");
                    foreach ($governorates as $key => $value){?> 
                    
                    <option <?php if(isset($_POST['destination']) && $_POST['destination']==$value['id'] ) {?> selected <?php } ?>  value="<?php echo $value['id'];?>" ><?php echo $value['governorate']; ?></option>
                    

                    <?php }
                    ?>
                </select>
                <label for="weight">Enter Shipment Wight in Kilograms</label>
                <input class="col-lg-2" type="text" name="weight">
                
                <input type="submit" class="btn btn-primary" style="background-color:red;" name="submit" value="Calculate">
               </form>
               <br>

               <?php if (isset($_POST['destination']) && filter_var($_POST['weight'],FILTER_VALIDATE_FLOAT) == true )
               {
                   $weight=$_POST['weight']; 
                   $governorate=$PRICE->get_gov($_POST['destination']);
                   $price_express=$PRICE->get_price_express($_POST['destination']);
                   $price_neha2y_express=($price_express+($weight*5)); 
                   echo "express shipment Price From Cairo to "."<p style='color:red;display:inline;'>".$governorate."</p>"." is "."<p style='color:red;display:inline;'>".$price_neha2y_express." LE </p>";
               }
               else if (isset($_POST['submit']) && filter_var($_POST['weight'],FILTER_VALIDATE_FLOAT) == FALSE  ) {
                echo "please fill the required fields correctly";
               }
                  
                }
                
                elseif (isset($_GET['service-type']) && $_GET['service-type']=="air") 
                {
                
                  $Airports=$PRICE->fields_to_array( array("governorate","price_flight") , "WHERE `price_flight` IS NOT NULL;" );
                 
                 
                 
                 
                 
                 
                 
                  // $STATMENT=$conn->prepare("SELECT `id`,`governorate`,`price_flight` FROM `prices` WHERE `price_flight` IS NOT NULL;");
                  // $STATMENT->execute();
                  // $Airports=$STATMENT->setFetchMode(PDO::FETCH_ASSOC);
                  // $Airports=$STATMENT->fetchall();
                  ?>
                  
                <form action="pricing.php?<?php echo $_SERVER['QUERY_STRING'];?>" method="post">

                <label for="airport">Select your Target Shipping Destination Air Port</label>

                <select class="custom-select col-lg-1" name="airport">
                  
                <?php foreach($Airports as $key=>$value)
                {?>

                   <option <?php if(isset($_POST['airport']) && $_POST['airport']==$value['id'] ){?> selected  <?php } ?>  value="<?php echo $value['id'] ?>"><?php echo $value['governorate'] ?> </option> 

                <?php } ?>
                  
                </select>
                <input type="submit" class="btn btn-primary" style="background-color:red;" name="Submit-Airport" value="Calculate">

                </form>
                <br>
                <?php if(isset($_POST['Submit-Airport']) && !empty($_POST['airport']))
                {
                echo "Air shipment Price From Cairo to "."<p style='color:red;display:inline;'>"; foreach($Airports as $key=>$vallu){if($_POST['airport']==$vallu['id']) echo $vallu['governorate'];} echo "</p>"." is "."<p style='color:red;display:inline;'>";
                foreach($Airports as $key=>$vallu){if($_POST['airport']==$vallu['id']) echo $vallu['price_flight'];} echo " LE </p>";

                }
                ?>

                  

                  










                  
                <?php
                }
                
                
                
                ?>


                
        </div>

            <?php
        }
        ?>
        <hr style="border-color:#57f54d;">
        <h1 style="text-align:center;color:black">Pricing Plans</h1>
        <br>
<div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow" style="border: 1px solid;">
          <div class="card-header" style="background-color: red;">
            <h4 class="my-0 font-weight-normal" style="background-color: red;">jimy shipping normal</h4>
          </div>
          <div class="card-body" style="background-color: #ceb98c;">
            <h1 class="card-title pricing-card-title">3 LE  <small class="text-muted">/ mile</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>1-6 Business Days</li>
              <li>Up to 80 kg</li>
              <li>Packaging Services</li>
              <li>Day-Specific Pickup</li>
              <li>Declared Value</li>
              <br><br><br>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary" onclick="location.href='pricing.php?service-type=normal'">Get started</button>
          </div>
        </div>
        <div class="card mb-4 box-shadow" style="border: 1px solid;">
          <div class="card-header" style="background-color: red;">
            <h4 class="my-0 font-weight-normal" style="background-color: red;">jimy shipping express</h4>
          </div>
          <div class="card-body" style="background-color: #ceb98c;">
            <h1 class="card-title pricing-card-title">3.5 LE <small class="text-muted">/ mile</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>1-2 Business Days</li>
              <li>up to  100kg</li>
              <li>Packaging Services</li>
              <li>Priority email support</li>
              <li>Day-Specific Pickup</li>  
              <li>Delivery Confirmation</li>
              <li>Declared Value</li>
              <br>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary" onclick="location.href='pricing.php?service-type=express'">Get started</button>
          </div>
          
        </div>
        <div class="card mb-4 box-shadow" style="border: 1px solid;">
          <div class="card-header" style="background-color: red;">
            <h4 class="my-0 font-weight-normal" style="background-color: red;">jimy shipping Air</h4>
          </div>
          <div class="card-body" style="background-color: #ceb98c;">
            <h1 class="card-title pricing-card-title">7.5 LE <small class="text-muted">/ mile</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>1-2 Business Days</li>
              <li>up to  200kg</li>
              <li>Packaging Services</li>
              <li>Priority email support</li>
              <li>Daily On-Route Pickup</li>
              <li>Day-Specific Pickup</li>  
              <li>Delivery Confirmation</li>
              <li>Declared Value</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary" onclick="location.href='pricing.php?service-type=air '">Get started</button>
          </div>
          
        </div>


</body>

</html>
