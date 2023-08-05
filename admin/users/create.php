<?php
$title='register';
$front_end='../..';
$admin=true;
require_once '../templates/mesage.php';
require_once '../../config/database.php';
require_once '../../config/app.php';
require_once '../templates/header.php';
$side='../';
 $name=$password_error=$password_form=$passowrd_confirmation_form=$email=$nameError=$emailError='';

  
  if($_SERVER['REQUEST_METHOD']=="POST"){
          
  
      $user_role=mysqli_real_escape_string($mysqli,$_POST['role']);
      $user_email=mysqli_real_escape_string($mysqli,$_POST['email']);
      $username=mysqli_real_escape_string($mysqli,$_POST['name']);
      $password=mysqli_real_escape_string($mysqli,$_POST['password']);
      
      $name=$_POST['name'];
      $email=$user_email;
      
        
      if(empty($email)){$emailError='email can not be emty';}
      if(empty($name)){$nameError='name can not be emty';}
      if(empty($password)){$password_error='passowrd can not be emty';}
     
  
     
  
      if(!$nameError&&!$emailError&&!$password_error){
          $emailExist=$mysqli->query("select id,email from users where email='$email' limit 1");
          $userExist=$mysqli->query("select id,email from users where name='$name' limit 1");
          if($emailExist->num_rows){ $emailError='email already exist';  }
          if($userExist->num_rows){$nameError='user name already exist';}
          else{
              $password=password_hash($password,PASSWORD_DEFAULT);
              $query="insert into users(email,name,password,role) values('$user_email','$username','$password','$user_role')";
              $mysqli->query($query);
          
              $_SESSION['success_message']="welcome , the account with the name  $name   account have been createrd successfully ";
              header('location:./index.php'); 
          }
      }  
  
  }
?>
 <div class="header__emty">&nbsp;</div>
<form action="" method="POST" class="form form-admin" id='signupForm'>

        <div class="form__container form__container-admin">


        
        <h1 class="form__title">انشاء حساب جديد</h1>
        <label>
            اسم المستخدم
            <input type="text" name='name' class="form__input" value="<?php echo $name ?>" >
            <span class="form__error"><?php echo $nameError?></span>
        </label>
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
        <label>
          الصلاحيات
         <select name="role" class="form__select" id="">
            <option value="user">user</option>
            <option value="admin">admin</option>
         </select>
        </label>
        <button class="form__btn">انشاء الحساب</button>
    </div>

        
    </form>
   