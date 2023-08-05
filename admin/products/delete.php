<?php 
require_once '../../config/database.php';
require_once '../../config/app.php';



if(!isset($_GET['id']) || !$_GET['id']){
    die('404 page not found');
}

$user_id=$_GET['id'];
$categorie_img=$_GET['path'];
if(unlink("../../$categorie_img")){
   echo 'yse sir';
}
else{
    die('no sir');
}
$user=$mysqli->prepare('delete from product where id='."$user_id");
$user->execute();
ob_start();
header("Location: http://localhost/متجري/admin/products");
       
;


?>