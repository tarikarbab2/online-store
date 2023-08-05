<?php
$title='متجري';
$front_end=".";
require_once './config/database.php';
require_once './config/app.php';


require_once './templates/header.php';

if(!isset($_GET['id']) || !$_GET['id']){
    die('404 page not found');
}
$product_id=$_GET['id'];
if($_SERVER['REQUEST_METHOD']=="POST" && !in_array($_POST['order'],$_SESSION['orders']) ){
    
    array_push($_SESSION['orders'],$_POST['order']);
    header("location:product.php?id=$product_id");
    unset($_POST['order']);
   }
$product=$mysqli->prepare("select product.id,product_name,product_img,price,cat_id ,categorise_name,description from product join categorise on product.cat_id=categorise.id where product.id=?");
$product->bind_param('s',$product_id);

$product->execute();

$result=$product->get_result();
if(!$result->num_rows>0){
   die('404 page not found');
}
$productes=$result->fetch_all(MYSQLI_ASSOC)

?>


<main class="product">
    <div class="product__link">
    <a href="./product.php?id=<?php echo $productes[0]['id'] ?>" class="product__categorie"><?php echo $productes[0]['product_name'] ?></a>   
    <   <a href="./catagories.php?id=<?php echo $productes[0]['cat_id'] ?>" class="product__categorie"><?php echo $productes[0]['categorise_name'] ?></a>
    <
    <a href="./index.php" class="product__categorie"> القائمة الرئيسية</a>
    </div>
    <div class="product__container">
        <h1 class="product__title"><?php echo $productes[0]['product_name']; ?></h1>
  
        <img src="<?php echo $productes[0]['product_img']; ?>" alt="" class="product__img">
       
        <p class="product__decription"><?php echo $productes[0]['description']; ?></p>
        <h3 class="product__price">price: <?php echo $productes[0]['price']; ?>$</h3>
        <form method="POST" ><button name='order' class="product__cart" value="<?php echo $productes[0]['id'] ?>"><h1> اضافة الى السلة </h1>
      <img src="./front-end/img/cart-add.svg" alt="" class="card__cart" ></button></form>
    </div>

</main>