
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<title>Login</title>

    
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
include 'connection.php';
?>



<br><br><br><br><br>
    <div style="text-align: center;">
    <h1>Please Type Your Registered Email and Password</h1>
    <form action="login.php" method="POST">
    <label for="log">
        <span>
            <input type="email" name="log" aria-required="true" placeholder="Email" >
         </span>
    </label>
    <br><br>
    <label for="psw">
        <span>
            <input type="password" name="psw" aria-required="true" placeholder="Password" >
         </span>
    </label>
    <br><br>
    <input type="submit" value="Login" name="submit-login">
    </form>
    <br>
    <p>dont have an account? <br><br><a href="register.php"> Create new account</a> </p>
    </div>

    <?php
    if (isset($_GET['email_8alat'])==true) {
        echo"<br>"."<br>";
        echo"<p style="."text-align:center;"."><b>please Type a correct valid email address</b></p>";
    }
    elseif(isset($_GET['email_or_password_8alat'])==true)
    {
        echo"<br>"."<br>";
        echo"<p style="."text-align:center;"."><b>failed to login please check your email or password</b></p>";
    }
    
    ?>

</body>
</html>
