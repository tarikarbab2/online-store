<?php $title='متجري';
$front_end=".";

require_once './config/database.php';
require_once './config/app.php';


require_once './templates/header.php';
require_once './templates/mesage.php';

if($_SERVER['REQUEST_METHOD']=="POST" && !in_array($_POST['order'],$_SESSION['orders']) ){
    
    array_push($_SESSION['orders'],$_POST['order']);
    header("location:index.php");
    unset($_POST['order']);
   }
$categorise=$mysqli->prepare("select * from categorise");

  $categorise->execute();
  
  $catresult=$categorise->get_result()->fetch_all(MYSQLI_ASSOC);

$product=$mysqli->prepare("select product.id,product_name,product_img,price,cat_id from product join categorise on product.cat_id=categorise.id  limit 5");

$product->execute();

$productres=$product->get_result()->fetch_all(MYSQLI_ASSOC);






?>
    
  
    
    <header class="header">
  
      
        <div class="header__container">
            <div class="header__slide fade">
                <img src="./front-end/img/header-1.jpg" alt="header-img" class="header__img">
                <h2 class="header__text">وفر على نفسك الوقت واحصل على اجود الملابس بأفضل الأسعار وباسرع وقت ممكن </h2>
            </div>
            <div class="header__slide fade">
                <img src="./front-end/img/header-2.jpg" alt="header-img" class="header__img">
                <h2 class="header__text">جميع الماركات العالمية متواجدة لدينا هنا مزودة من الشركة الأم إليك مباشرة.   </h2>
            </div>
            <div class="header__slide  fade">
                <img src="./front-end/img/header-3.jpg" alt="header-img" class="header__img">
                <h2 class="header__text">شاركنا ارائك وساعدنا لنقدم لك افضل خدمه ممكنه ,فرأيك يهمنا </h2>
            </div>
          

            

        </div>
        <div class="header__dots">
            <span class="header__dot"></span>
            <span class="header__dot"></span>
            <span class="header__dot"></span>
        </div>

    </header>

    <main>
        <section class='categories'>
            <h1 class="categories__title">اختر ما تريد</h1>
            <div class="categories__container">
                <?php foreach($catresult as $categorie){ ?>
                    <a href="./catagories.php?id=<?php echo $categorie['id'] ?>">
                    <div class="categories__card"> <img src="<?php echo $categorie['categorise_img'];?>" alt="t-shirt-1" class="categories__img">
    <h1 class="categories__header"><?php echo $categorie['categorise_name'];?></h1></div>
    </a>
                  <?php } ?>  
   
                <!-- <div class="categories__card"> <img src="./front-end/img/t-shirt-1.jpg" alt="t-shirt-1" class="categories__img">
                    <h1 class="categories__header">أقمصة</h1></div>
               
           
            <div class="categories__card"> <img src="./front-end/img/shoes-1.jpg" alt="t-shirt-1" class="categories__img">
                <h1 class="categories__header">احذية رياضية</h1></div>
           
        
        <div class="categories__card"> <img src="./front-end/img/jeans-1.jpg" alt="t-shirt-1" class="categories__img">
            <h1 class="categories__header">جينز</h1></div>
       
   
    <div class="categories__card"> <img src="./front-end/img/dress.-1jpg.jpg" alt="t-shirt-1" class="categories__img">
        <h1 class="categories__header">فساتين</h1></div>

        <div class="categories__card"> <img src="./front-end/img/bags.-1jpg.jpg" alt="t-shirt-1" class="categories__img">
            <h1 class="categories__header">حقائب نسائية</h1></div>

            <div class="categories__card"> <img src="./front-end/img/heels-1.jpg" alt="t-shirt-1" class="categories__img">
                <h1 class="categories__header">كعب عالي</h1></div> -->
   
</div>
</div>

        </section>

        <section class="products">
  
        <h1 class="products__title">الاكثر رواجا</h1>
            <div class="card__container">
            <?php foreach($productres as $product){ ?>
                <a href="./product.php?id=<?php echo $product['id'] ?>">
                <div class="card">
                    <img src="<?php echo $product['product_img']; ?>" alt="" class="card__img">
                    <h2 class="card__title"><?php echo $product['product_name'] ?></h2>
                    
                    <div class="card__price">
                        <div class="card__animation">
                       <form method="POST" ><button name='order' value="<?php echo $product['id'] ?>"> <img src="./front-end/img/cart-add.svg" alt="" class="card__cart" ></button></form>
                    </div>
                        <h3><?php echo $product['price']."$"; ?></h3>
                  
                    </div>
                </div>
                </a>
        <?php }?>
     
            </div>
        </section>
    </main>

   <?php require_once './templates/footer.php'; ?>
   
  
   
</body>
</html>