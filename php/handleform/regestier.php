<?php 
require_once __DIR__.'/../../config/database.php';

require_once __DIR__.'/../../regtration.php';
require_once __DIR__.'/../filterForm.php';

if(isset($_SESSION['logged_in'])){
  header("location:index.php");  
}

if($_SERVER['REQUEST_METHOD']=="POST"){
        


    $user_email=mysqli_real_escape_string($mysqli,$_POST['email']);
    $username=mysqli_real_escape_string($mysqli,$_POST['name']);
    $password=mysqli_real_escape_string($mysqli,$_POST['password']);
    $passowrd_confirmation=mysqli_real_escape_string($mysqli,$_POST['password_confirmation']);
    $name=$_POST['name'];
    $email=filterEmail($_POST['email']);
    
      
    if(empty($email)){$emailError='email can not be emty';}
    if(empty($name)){$nameError='name can not be emty';}
    if(empty($password)){$password_error='passowrd can not be emty';}
    if($password !==$passowrd_confirmation){    
        $passwordcon_erorr='passowrd dose not match';

      
    }

   

    if(!$nameError&&!$emailError&&!$password_error&&!$passwordcon_erorr){
        $emailExist=$mysqli->query("select id,email from users where email='$email' limit 1");
        $userExist=$mysqli->query("select id,email from users where name='$name' limit 1");
        if($emailExist->num_rows){ $emailError='email already exist';  }
        if($userExist->num_rows){$nameError='user name already exist';}
        else{
            $password=password_hash($password,PASSWORD_DEFAULT);
            $query="insert into users(email,name,password) values('$user_email','$username','$password')";
            $mysqli->query($query);
            $_SESSION['logged_in']=true;
            $_SESSION['user_id']=$mysqli->insert_id;
            $_SESSION['user_name']=$name;
            $_SESSION['success_message']="welcome , $name  your account have been createrd successfully ";
            header("location:index.php");  
        }
    }  

}