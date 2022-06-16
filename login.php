<?php
session_start();
require_once 'models/table_manipulation.php' ;
require 'models/user_model.php';



$USER = new user_manipulation(); 



if (isset($_POST['submit-login']) && filter_var($_POST['log'],FILTER_VALIDATE_EMAIL) && !empty($_POST['psw']))
{


$entered_email=$_POST['log'];
$entered_password=$_POST['psw'];
$entered_password_mofa5a5=sha1($entered_password);

if ( !empty($USER->shoof_email_shoof_password( $entered_email , $entered_password_mofa5a5 ) )) 
{ 


$user_array=$USER->shoof_email_shoof_password( $entered_email , $entered_password_mofa5a5 ) ; 


$_SESSION['logged-in']=true;
$_SESSION['user-id']=$user_array[0]['id'];
$_SESSION['user-email']=$user_array[0]['email'];
$_SESSION['user-governorate']=$user_array[0]['governorate'];
$_SESSION['user-fullname']=$user_array[0]['full_name'];
if ($user_array[0]['admin_flag'] === '0')

{
$_SESSION['login-type']='user';
header('location:index.php');
}
else if ($user_array[0]['admin_flag'] === '1' )
{
$_SESSION['login-type']='admin';
header('location:admin_panel.php');
}


}
else
{
header('location:Log-in.php?email_or_password_8alat=true');
}
}
else 
{
header('location:Log-in.php?email_8alat=true');
}





















?>