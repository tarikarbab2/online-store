<?php
$title='update user';
$front_end='../..';
$side='../';
$admin=true;
require_once '../templates/mesage.php';
require_once '../../config/database.php';
require_once '../../config/app.php';
require_once '../templates/header.php';
$name=$password_error=$password_form=$passowrd_confirmation_form=$email=$nameError=$emailError='';

if(!isset($_GET['id']) || !$_GET['id']){
    die('404 page not found');
}

$user_id=$_GET['id'];
$user=$mysqli->query('select name,email,role,password from users where id='."$user_id");
if(!$user){
    die('404 page not found');
}
$userdb=$user->fetch_assoc();



$name=$userdb['name'];
$email=$userdb['email'];
$role=$userdb['role'];
$password=$userdb['password'];

if($_SERVER['REQUEST_METHOD']=="POST"){
$st=$mysqli->prepare('update users set name=? , email=? , password=? , role=? where id=?');
$st->bind_param('ssssi',$nameup,$emailup,$passwordup,$roledb,$iddb);
$nameup=$_POST['name'];
$emailup=$_POST['email'];
$_POST['password'] ? $passwordup=password_hash($_POST['password'],PASSWORD_DEFAULT) : $passwordup=$password;
$roledb=$_POST['role'];
$iddb=$user_id;
$st->execute();

if($st->error){
    die('error 505');
}
else{
    $_SESSION['success_message']="welcome , the account with the name  $nameup   account have been updated successfully ";
    ob_start();

    header('location:./index.php');
}

}
?>




<div class="header__emty">&nbsp;</div>
<form action="" method="POST" class="form form-admin" id='signupForm'>

        <div class="form__container form__container-admin">


        
        <h1 class="form__title">تحديث بيانات المستخدم</h1>
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
            <option value="user" <?php if($role==='user'){ echo 'selected'; } ?>>user</option>
            <option value="admin" <?php if($role==='admin'){ echo 'selected'; } ?>>admin</option>
         </select>
        </label>
        <button class="form__btn">انشاء الحساب</button>
    </div>

        
    </form>
   