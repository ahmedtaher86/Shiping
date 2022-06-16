<?php
session_start();
require_once 'models/table_manipulation.php' ; 
require 'models/prices_model.php';
require 'models/shipment_model.php';


$PRICE= new price_manipulation () ; 
$SHIPMENT = new shipment_manipulation () ; 




if($_POST['service_type']=="normal")
{
    $price=$PRICE->get_price($_POST['destination_governorate']);

    $price=$price+($_POST['shipment_weight']*5);
}

elseif($_POST['service_type']=="express")
{
    $price=$PRICE->get_price_express($_POST['destination_governorate']);

    $price=$price+($_POST['shipment_weight']*5);
}

elseif($_POST['service_type']=="air")
{
    $price=$PRICE->get_price_Air($_POST['destination_governorate']);
}


$Gov=$PRICE->get_gov($_POST['destination_governorate']);

$SHIPMENT->we_3andak_wa7d_shipment_we_sala7o(

    $Gov,
    $_POST['destination_address'],
    $_POST['service_type'],
    date('Y-m-d H:i:s'),
    $_POST['shipment_weight'],
    $_POST['message'],
    $_SESSION['user-id'],
    $_POST['picking_address'],
    $price

);
$service=$_POST['service_type'];
$url = "order_shipment.php?service_type=$service&order_confirm=true";

header("Location:$url");  




?>