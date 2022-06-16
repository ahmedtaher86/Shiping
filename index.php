



<html>
<head>
<?php

include 'connection.php';



?>

<title>jimyshipping</title>
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


include 'navbar.php';


?>


<div >
<div>
      <?php if(!empty($_SESSION['logged-in']))
      { ?>
       <br><br>
      
        <p style="text-align:center;">hi <b> <?php echo $_SESSION['user-fullname'];?> </b> you can enjoy jimy Shipping Services</p>
     <?php
      }
        ?>
    </div>
    <br><br>
    <div style="text-align: center;">
    <h1 id="heading">Welcome to Jimy Shipping</h1>
    <p>we privide the best shippig and logistics services locally inside Egypt</p>
    </div>
    <br><br>
    <hr>
    <div style="text-align: center;">
    <h1>Why jimy Shipping ?</h1>
    <p style=" left: 250px;right: 250px; position: absolute ;">If you have goods that you want to transport to any of the governorates of Egypt, we are the first option available to you because we have more than 25 years of experience in the field of shipping and customs clearance and we cooperate with the best insurance companies to confirm insurance on your shipment by a shipping professionals, united by a passion for logistics, work in a unique environment Supply Chain Management</p>
    </div>
    <br><br><br><br><br>
    <hr>
    <div style="text-align: center;">
    <h2 >our process in serving</h2>
    <table style="text-align: center;">
        <thead style=" left:550px; position:relative;">
            <tr>
                <th>Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </th><th>Distribution</th><th>Transportation</th><th>Brokrage</th>
            </tr>
        </thead>
        <tbody style="left: 550px; position: relative;">
            <tr>
                <td><img width="83" height="83" src="https://elementor.deverust.com/kavaleri/wp-content/uploads/sites/13/2022/02/process01-MJ3T5FE.png"></td><td><img width="83" height="83" src="https://elementor.deverust.com/kavaleri/wp-content/uploads/sites/13/2022/02/process02-MJ3T5FE.png"></td><td><img width="83" height="83" src="https://elementor.deverust.com/kavaleri/wp-content/uploads/sites/13/2022/02/process04-MJ3T5FE.png"></td><td><img width="83" height="83" src="https://elementor.deverust.com/kavaleri/wp-content/uploads/sites/13/2022/02/process03-MJ3T5FE.png"></td>
            </tr>
        </tbody>
    </table>
    </div>
  <?php  

?>

</div>

</body>




</html>