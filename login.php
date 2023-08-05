<?php
$title='login';
$front_end=".";
require_once './templates/header.php';
require_once __DIR__.'/config/database.php';
require_once './php/filterForm.php';
require_once './templates/mesage.php';

 $name=$password_error=$password_form=$passowrd_confirmation_form=$passwordcon_erorr=$email=$nameError=$emailError='';
 if(isset($_SESSION['logged_in'])){
    header("location:index.php");  
  }
  if($_SERVER['REQUEST_METHOD']=="POST"){
        


    $user_email=mysqli_real_escape_string($mysqli,$_POST['email']);
   
    $password=mysqli_real_escape_string($mysqli,$_POST['password']);
   
   
    $email=filterEmail($_POST['email']);
    
      
    if(empty($email)){$emailError='email can not be emty';}
   
    if(empty($password)){$password_error='passowrd can not be emty';}

    if(!$emailError && !$password_error){
        $userExist=$mysqli->query("select id,name,email,password from users where email='$email' limit 1");
       
        if(!$userExist->num_rows){ $emailError='email dose not exist';  }
        
        else{
        $foundUser=$userExist->fetch_assoc();
    
        $name=$userExist->fetch_assoc()['name'];
        $id=$userExist->fetch_assoc()['id'];
        if(password_verify($password,$foundUser['password'])){
            
            $_SESSION['logged_in']=true;
            $_SESSION['user_id']=$foundUser['id'];
            $_SESSION['user_name']=$foundUser['name'];
            $_SESSION['success_message']="welcome back" .$_SESSION['user_name'];
            header("location:index.php");  
        
        }
        else{
            $password_error="wrong password";
        }

        }
    }

  }



?>
 <div class="header__emty">&nbsp;</div>
<form action="" method="POST" class="form" id='signupForm'>

        <div class="form__container">
        
        <h1 class="form__title">مرحبا بك من جديد</h1>
  
        <label>
            البريد الالكتروني
            <input type="email" name="email" class="form__input" value="<?php echo $email ?>" >
            <span class="form__error"><?php echo $emailError?></span>
        </label>
        <label>
            كلمة السر
            <input type="password" name="password" class="form__input" value="<?php echo $password_form ?>" > 
            <span class="form__error"><?php echo $password_error ?></span>
        </label>
       
        <button class="form__btn">تسجيل الدخول</button>
    </div>

        
    </form>