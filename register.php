<?php 
require_once 'models/table_manipulation.php' ; 
require 'models/user_model.php' ;  


$TABLE= new table_manipulation() ; 

$USER=new user_manipulation() ; 





?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<title>register</title>


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

</head>
<body>

<?php

include 'navbar.php';

?>


<br><br><br>
        <div style="text-align: center;">
        <h1>Create a New User</h1>
        <form action="addnewuser.php" method="POST">
    <label for="fname">
        <span>
            <input type="text" name="fname" aria-required="true" placeholder="Full Name" >
         </span>
    </label>
    <br><br>
    <label for="mobile">
        <span>
            <input type="text" name="mobile" aria-required="true" placeholder="Phone Number" >
         </span>
    </label>
    
<!-- ................................................... -->
<?php if(isset($_GET['phone8alat'])){
    echo "<p>"."Please enter a valid mopile number of 11 digits"."</p>";
    }
    ?>
    
<!-- ......................................................... -->
    <br><br>
    <label for="gender">Gender:</label>
         <select name="gender">
    <option value="male">Male</option><option value="female">Female</option>
         </select>
    <br><br>
    
    <label for="governorate">Residence Governorate:</label>
         <select name="governorate">
    <option value="Cairo">Cairo</option>
    <?php 


    $objecT=$TABLE->field_to_object("prices","governorate") ; 
    

    foreach ($objecT as $value) {
        echo "<option value=";echo$value['governorate'];echo">";echo $value['governorate'];echo"</option>";
    }?>
         </select>
<!-- ................................................................ -->
    <?php if(isset($_GET['governorateerror'])){
    echo "<p>"."Please enter an egyptian governorate"."</p>";
    }
    ?>

<!-- .................................................................. -->
         <br><br>

         
    <label for="mail">
        <span>
            <input type="text" name="mail" aria-required="true" placeholder="email-address" >
         </span>
    </label>

<!-- ................................................................ -->
    <?php if(isset($_GET['email8alat'])){
    echo "<p>"."Please enter a valid email formula"."</p>";
    }
    ?>

<!-- .................................................................. -->

    <br><br>
    <label for="psww">
        <span>
            <input type="password" name="psww" aria-required="true" placeholder="Password" >
         </span>
    </label>
    <br><br>
    <label for="psww_repeat">
        <span>
            <input type="password" name="psww_repeat" aria-required="true" placeholder="Retype your Password" >
         </span>
    </label>
    <br><br>
    <input type="submit" value="Confirm" name="submit-register">
    </form>
    <?php
        if(isset($_GET['d5alna_user'])==true) {
        echo "<p style='color:red;'>registered successully :D </p>";
        }
        elseif(isset($_GET['passworderror'])==true)
        {
        echo "<br>"."<br>";
        echo "<p style='color:red;'>password doesn't match the re-typed password</p>";
        }
        elseif(isset($_GET['emailerror'])==true)
        {
        echo "<br>"."<br>";
        echo "<p style='color:red;'>this email has been used before please use another emial address</p>";
        }
        elseif (isset($_GET['all_fields_error'])==true) 
        {
            echo "<br>"."<br>";
            echo "<p style='color:red;'>please make sure that you have filled all fields </p>";
            echo "<br>"."<br>";
            echo "<p style='color:red;'>don't leave a blanked entry</p>";
        }
?>
</div>

</body>
</html>
