<?php 
require_once '../../config/database.php';
require_once '../../config/app.php';



if(!isset($_GET['id']) || !$_GET['id']){
    die('404 page not found');
}

$user_id=$_GET['id'];
$user=$mysqli->prepare('delete from users where id='."$user_id");
$user->execute();
ob_start();
header("Location: http://localhost/متجري/admin/users");
       
;


?>
