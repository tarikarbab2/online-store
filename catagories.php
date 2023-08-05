<?php $title='متجري';
$front_end=".";
require_once './config/database.php';
require_once './config/app.php';
require_once './templates/header.php';




if(!isset($_GET['id']) || !$_GET['id']){
    die('404 page not found');
}

if($_SERVER['REQUEST_METHOD']=="POST" && !in_array($_POST['order'],$_SESSION['orders']) ){
    
    array_push($_SESSION['orders'],$_POST['order']);
    header("location:index.php");
    unset($_POST['order']);
   }
$catagorie=$mysqli->prepare('select id from categorise where id=?');
$catagorie->bind_param('s',$cat_id);
$catagorie->execute();
$check=$catagorie->get_result();
if($check->num_rows>0){
   die('404 page not found');
}

$product=$mysqli->prepare("select product.id,product_name,product_img,price,cat_id ,categorise_name from product join categorise on product.cat_id=categorise.id where categorise.id=?");
$product->bind_param('s',$cat_id);
$cat_id=$_GET['id'];
$product->execute();

$result=$product->get_result();
if(!$result->num_rows>0){
   die('لم يتم اضافة منتجات بعد');
}
$productes=$result->fetch_all(MYSQLI_ASSOC)






?>

<section class="products">
<h1 class="products__title"><?php echo $productes[0]['categorise_name'] ?></h1>
<div class="card__container">


<?php foreach($productes as $product){ ?>
  
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