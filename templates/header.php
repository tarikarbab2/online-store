<?php
 $title;
 require_once __DIR__.'/../config/app.php';
 session_start();
 
 if(!isset($_SESSION['orders'])){
    $_SESSION['orders']=[];
 }


 
 ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href="<?php echo $front_end; ?>/front-end/css/main.css?v=<?php echo time(); ?>">
    <title><?php echo $title; ?></title>
</head>
<body>
  
    <nav class="nav " id="#nav">
        <div class="nav__logo ">
            <a class="nav__link" href='<?php echo $config["app_url"];?>'><h1>متجري</h1></a>

        </div>
        <?php if(!isset($admin)){ ?>
        <form class="nav__search">
            <label>
             <img class="nav__search-img" src="./front-end/img/search.svg">        
            <input type="text" class="nav__input"  placeholder="كل ما تحتاجه موجود هنا">
            ابحث
        </label>
        </form>
     
        <ul class="nav__items ">
            <?php if(isset($_SESSION["logged_in"])){ ?>
            <li class="nav__item"><a class="nav__link" href="#" id='login' ><img src="front-end/img/sign in.svg">welcome , <?php echo $_SESSION["user_name"]; ?>  </a></li>
            <li class="nav__item"><a class="nav__link" href="./uploads/logout.php" id='login' ><img src="<?php  echo $front_end ?>/front-end/img/logout.png"> تسجيل الخروج </a></li>
            <?php } else{ ?>
      
            <li class="nav__item"><a class="nav__link" href="./login.php" id='login' ><img src="<?php  echo $front_end ?>/front-end/img/sign in.svg"> تسجيل الدخول </a></li>
            <li class="nav__item"><a class="nav__link" href="./regtration.php" id="signup" ><img src="<?php  echo $front_end ?>/front-end/img/sign up.svg"> تسجيل جديد </a></li>
          
            <?php } ?>
                 <li class="nav__item"><a class="nav__link cart" href="./cart.php"  > <script>
                 let item=<?php
                 if(!isset($_SESSION['orders'])){  echo false;  }
                 else{
                   echo count($_SESSION['orders']);
                 } ?>
                
                
                 if(item){
              
                  document.querySelector('.cart').style.setProperty("--cart",'"<?php if(!isset($_SESSION['orders'])){echo 0;} else{ echo count($_SESSION['orders']);} ?>"'); 
          

                 } </script><img src="<?php  echo $front_end ?>/front-end/img/cart-1.svg" class="nav__cart"> </a></li> 
          


           
        </ul>
        <button  class="nav__icon" ><img src="./front-end/img/navigation.svg" alt="navigation" class="nav__hum"></button>
        <?php }?>
    </nav>
   

 <?php 