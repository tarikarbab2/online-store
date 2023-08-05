<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href="../front-end/css/main.css">
    <title>متجري</title>
</head>
<body>

    <form action="" class="form" id='signupForm'>
        <div class="form__remover"></div>
        <div class="form__container">
            <img src="../front-end/img/cancel.svg" alt="" class="form__cancel">

        
        <h1 class="form__title">اهلا بك في متجري</h1>
        <label>
            اسم المستخدم
            <input type="text" class="form__input">
        </label>
        <label>
            البريد الالكتروني
            <input type="text" class="form__input">
        </label>
        <label>
            كلمة السر
            <input type="text" class="form__input">
        </label>
        <label>
            تأكيد كلمة السر
            <input type="text" class="form__input">
        </label>
        <button class="form__btn">انشاء الحساب</button>
    </div>

        
    </form>
    <form action="" class="form" id="loginForm">
        <div class="form__remover"></div>
        <div class="form__container">
            <img src="../front-end/img/cancel.svg" alt="" class="form__cancel cancel-log">

        
        <h1 class="form__title">اهلا بك في متجري</h1>
     
        <label>
            البريد الالكتروني
            <input type="text" class="form__input">
        </label>
        <label>
            كلمة السر
            <input type="text" class="form__input">
        </label>
      
        <button class="form__btn">تسجيل الدخول</button>
    </div>

        
    </form>
    <nav class="nav">
        <div class="nav__logo">
            <h1><a href="/index.html" class="nav__link">متجري</a> </h1>

        </div>
        <form class="nav__search">
            <label>
             <img class="nav__search-img" src="../front-end/img/search.svg">        
            <input type="text" class="nav__input"  placeholder="كل ما تحتاجه موجود هنا">
            ابحث
        </label>
        </form>
        <ul class="nav__items ">
            <!-- <li class="nav__item"><a class="nav__link" href="#" id='login' ><img src="../front-end/img/sign in.svg"> تسجيل الدخول </a></li>
            <li class="nav__item"><a class="nav__link" href="#" id="signup" ><img src="../front-end/img/sign up.svg"> تسجيل جديد </a></li> -->
            <li class="nav__item"><a class="nav__link cart" href="#"  ><img src="../front-end/img/cart-1.svg" class="nav__cart"> </a></li>
            <li class="nav__item user"><a class="nav__link user" href="#"  ><img src="../front-end/img/sign in.svg" class="nav__cart"> رباب</a></li>
            
          
            

           
        </ul>
        <button  class="nav__icon" ><img src="../front-end/img/navigation.svg" alt="navigation" class="nav__hum"></button>
     
    </nav>

    <section class="products">
        <div class="header__emty">&nbsp;</div>
        <h1 class="products__title">أقمصة</h1>
        <div class="card__container">

            <div class="card">
                <img src="../front-end/img/adidas-shirt.jpg" alt="" class="card__img">
                <h2 class="card__title">اديداس كحلي</h2>
                <p class="card__description">قميص اديداس كحلي يحتوي على شعار مكبر</p>
                <div class="card__price">
                    <div class="card__animation">
                    <img src="../front-end/img/cart-add.svg" alt="" class="card__cart">
                </div>
                    <h3>30$</h3>
              
                </div>
            </div>

            <div class="card">
                <img src="../front-end/img/nikeshirt.jpg" alt="" class="card__img">
                <h2 class="card__title">نايكي اسود</h2>
                <p class="card__description">قميص نايكي اسود خالي من العبارات</p>
                <div class="card__price">
                    <div class="card__animation">
                    <img src="../front-end/img/cart-add.svg" alt="" class="card__cart">
                </div>
                    <h3>25$</h3>
              
                </div>
            </div>

            <div class="card">
                <img src="../front-end/img/black-tshirt.jpg" alt="" class="card__img">
                <h2 class="card__title">اديداس كحلي</h2>
                <p class="card__description">قميص اديداس كحلي يحتوي على شعار مكبر</p>
                <div class="card__price">
                    <div class="card__animation">
                    <img src="../front-end/img/cart-add.svg" alt="" class="card__cart">
                </div>
                    <h3>30$</h3>
              
                </div>
            </div>


         
            </div>

      



         

           

        </div>
    </section>
 
     <script src="../front-end/js/nav.js"></script>
     <script src="../front-end/js/form.js"></script>
</body>
</html>