<?php 
require_once '../config/database.php';
require_once '../config/app.php';


require_once '../templates/header.php';
if(!isset($_GET['id']) || !$_GET['id']){
    die('404 page not found');
}

$product_id=$_GET['id'];
$product=array_search($product_id,$_SESSION['orders']);
unset($_SESSION['orders'][$product]);
header("location:../cart.php");


?>


