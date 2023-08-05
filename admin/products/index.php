<?php 
$title='categories';
$front_end='../..';
$admin=true;
$side='../';
require_once '../../config/database.php';
require_once '../../config/app.php';


require_once '../templates/header.php';
require_once '../../templates/mesage.php';

$data=$mysqli->prepare('select product.id,product_name,product_img,price,cat_id,categorise_name,description from product join categorise on product.cat_id=categorise.id  limit ?,?');
if(isset($_GET['limit'])){
    $data->bind_param('s',$_GET['limit']);
}
else{
    $data->bind_param('ii',$limit,$number);
    $limit=0;
    $number=10;
}
$data->execute();
$product=$data->get_result();
$products=$product->fetch_all(MYSQLI_ASSOC);
?>


<main class="users">
<h1 class="users__title">يمكنك التعديل او اضافة تصنيفات جديده عن طريق هذه الصفحه</h1>
<div class="users__add-container"><a href="./create.php" class="users__add"> اضافة تصنيف جديد</a></div>
<h4 class="users__table">:قائمة التصنيفات </h4>
<?php foreach($products as $item){ ?>
<div class="users__container">

    <div class="users__edit">
        <a class="users__update users__btn" href="./edit.php?id=<?php echo $item['id'] ?>">EDIT</a>
        <a href="./delete.php?id=<?php echo $item['id'] ?>&path=<?php echo $item['product_img'] ?>" class="users__delete users__btn">DELETE</a>
    </div>
    <div class="users__description">
        <p class="users__text"><?php echo $item['description'] ?></p>
    </div>
    <div class="users__data">
     
    <h1 class="users__name">
         اسم المنتج   :<?php echo $item['product_name'] ?></h1>
     <img class="users__img" src="http://127.0.0.1/%D9%85%D8%AA%D8%AC%D8%B1%D9%8A/<?php echo $item['product_img'] ?>">  
     <h2 class="users__name">  التصنيف :<?php echo $item['categorise_name'] ?></h2>
    </div>
 </div>
<?php } ?>
</main>