<?php
$title='register';
$front_end=".";
require_once './templates/header.php';
require_once './templates/mesage.php';

 $name=$password_error=$password_form=$passowrd_confirmation_form=$passwordcon_erorr=$email=$nameError=$emailError='';
 require_once './php/handleform/regestier.php';

?>
 <div class="header__emty">&nbsp;</div>
<form action="" method="POST" class="form" id='signupForm'>

        <div class="form__container">


        
        <h1 class="form__title">اهلا بك في متجري</h1>
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
            تأكيد كلمة السر
            <input type="password" name="password_confirmation" class="form__input" value="<?php echo $passowrd_confirmation_form ?>" >
            <span class="form__error"><?php echo $passwordcon_erorr?></span>
        </label>
        <button class="form__btn">انشاء الحساب</button>
    </div>

        
    </form>
   
    <?php 
    echo "<h1>". $name . $email. "</h1>";