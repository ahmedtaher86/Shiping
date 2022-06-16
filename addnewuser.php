<?php
require_once "models/table_manipulation.php"; 
require "models/user_model.php";
require "models/shipment_model.php" ;
require "models/prices_model.php";
include 'functions.php';


$TABLE = new table_manipulation(); 

$PRICE =new price_manipulation() ; 
$SHIPMENT = new shipment_manipulation(); 
$USER = new user_manipulation() ;

if (
!empty($_POST['fname']) 
&& !empty($_POST['mobile']) 
&& isset($_POST['gender']) 
&& !empty($_POST['mail']) 
&& !empty($_POST['psww']) 
&& !empty($_POST['psww_repeat'])
&& !empty($_POST['governorate'])
&& isset($_POST['submit-register'])
)
{
if($_POST['psww']==$_POST['psww_repeat'])
{
$fname=$_POST['fname'];
$mobile=$_POST['mobile'];
$gender=$_POST['gender'];
$mail=$_POST['mail'];
$governorate=$_POST['governorate'];



$G=$PRICE->fields_to_array(array("governorate"),"WHERE governorate ="."'".$governorate."'");



if ($governorate=="Cairo") {
    $bandary=1;
}


$password=$_POST['psww'];
$password_mofa5a5=sha1($password);


if ($USER->user_exists_wala_la2a($mail)) {header('Location:register.php?show=Register&emailerror=true');}
elseif(filter_var($mail,FILTER_VALIDATE_EMAIL)==false){ header('Location:register.php?show=Register&email8alat=true');}
elseif(validating($mobile)==false){header('Location:register.php?show=Register&phone8alat=true');}

elseif ($G == false && !isset($bandary)) 
{header('Location:register.php?show=Register&governorateerror=true');}
else

{

    $v=$USER->add([
    "full_name"=> $fname ,
    "email" => $mail ,
    "password" => $password_mofa5a5 , 
    "mobile"=> $mobile , 
    "gender"=> $gender  , 
    "admin_flag"=>'0' , 
    "governorate"=> $governorate
    ]);



   
    
}



if ($v == true) {header('Location:register.php?show=Register&d5alna_user=true');}
}
else
{
header('Location:register.php?show=Register&passworderror=true');
}
}
else {
header('Location:register.php?show=Register&all_fields_error=true');
}




?>