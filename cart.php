<?php $title='سلة المشتريات';
$front_end=".";
require_once './config/database.php';
require_once './config/app.php';
require_once './templates/header.php';
if($_SESSION['orders']){
$id=join(',',$_SESSION['orders']);
}else{
    $id=0;
}

$items=$mysqli->prepare("select * from product where id in($id)");

$totalPrice=$mysqli->prepare("select sum(price) as 'total_price' from product where id in($id)");

$totalPrice->execute();
$totalprice=$totalPrice->get_result();
$price=$totalprice->fetch_all(MYSQLI_ASSOC);



$items->execute();


$result=$items->get_result();
if(!$result->num_rows>0){
    die('لا يوجد منتجات في السلة');
 }
$item=$result->fetch_all(MYSQLI_ASSOC);

if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['logged_in']==true){
   $purches=$mysqli->prepare("insert into purches(user_id,product_id,total_price,status)"."values(?,?,?,?)");
   $purches->bind_param('isis',$user_id,$product_id,$product_price,$status);
   $user_id=$_SESSION['user_id'];
   $product_id=$id;
   $product_price=$price[0]['total_price'];
   $status="in-progress";
   $purches->execute();
   unset($_SESSION['orders']);
   header('location:index.php');
}else{
    echo "log in first";
}


?>

<h1 class="cart-title">:خطوات بسيطة تفصلك عن شراء ما ترغب به</h1>

<div class="cart__steps">
    <div class="cart__steps-1">
        <img src="./front-end/img/check.png" alt="checker" class="cart__steps-img">
        <h2 class="cart__steps-title">سلة المشتريات</h2>
    </div>
    <hr>
    <div class="cart__steps-2">
      <div class="cart__steps-circle">
          2
      </div>
      <h2 class="cart__steps-title">طرق الدفع </h2>        
</div>

</div>

<main class="cart">
    <div class="cart__container">
        <?php foreach($item as $product){ ?>
        <div class="cart__item">
            <a href="./php/uncart.php?id=<?php echo $product['id'] ?>" class="cart__delete"><img src="./front-end//img/delete.png" alt="delete-button" class="cart__delete-img"></a>
            <div class="cart__right">
            <h4 class="cart__title"><?php echo $product['product_name'] ?> </h4>
            <img src="<?php echo $product['product_img'] ?>" alt="" class="cart__img">
            </div>
        
            <div class="cart__description__container"><p class="cart__description"><?php echo $product['description'] ?>        
            </p>    </div>    
            
            <h5 class="cart__price"><?php echo $product['price'] ?>$ </h5>
        </div>
        <?php } ?>
     <div class="cart__item cart__total">
         <div class="cart__total-text">
             <h1>مجموع السلة</h1>
             <svg xmlns="http://www.w3.org/2000/svg" class="cart__total-img" width="48.838" height="51" viewBox="0 0 48.838 51">
  <g id="cart-1" transform="translate(-11.6 -25)">
    <path id="XMLID_12_" d="M11.6,28h9.632L28.1,62.359" transform="translate(0 0)" fill="none" stroke="#4A47A3" stroke-miterlimit="10" stroke-width="6"/>
    <ellipse id="XMLID_13_" cx="4.579" cy="5.768" rx="4.579" ry="5.768" transform="translate(24.705 61.464)" fill="none" stroke="#4A47A3" stroke-miterlimit="10" stroke-width="6"/>
    <ellipse id="XMLID_15_" cx="4.579" cy="5.768" rx="4.579" ry="5.768" transform="translate(46.653 61.464)" fill="none" stroke="#4A47A3" stroke-miterlimit="10" stroke-width="6"/>
    <line id="XMLID_16_" x2="13.263" transform="translate(33.626 65.392)" fill="none" stroke="##4A47A3" stroke-miterlimit="10" stroke-width="6"/>
    <path id="XMLID_17_" d="M43.7,63.18H68.058L73.426,41.6H39.4" transform="translate(-16.826 -6.838)" fill="none" stroke="#4A47A3" stroke-miterlimit="10" stroke-width="6"/>
  </g>
</svg>
         </div>
         <h4 class="cart__total-price"><?php echo $price[0]['total_price'] ?>$</h4>
     </div>
     <form action="#" method="POST" class="cart__form">
         <button class="cart__form-sumbit">اتمام الطلب </button>
     </form>

    </div>


</main>