<?php
$title='update categorise';
$front_end='../..';
$side='../';
$admin=true;
require_once '../templates/mesage.php';
require_once '../../config/database.php';
require_once '../../config/app.php';
require_once '../templates/header.php';
$deserror='';
$typeerror="";
$nameEror=$deserror=$fileError=$typeerror=$price=$priceEror='';
$fileForm="products";

if(!isset($_GET['id']) || !$_GET['id']){
    die('404 page not found');
}

$uploadDir=__DIR__.'/../../front-end/img';

$products_id=$_GET['id'];
$products=$mysqli->query("select product.id,product_name,product_img,price,cat_id,categorise_name,description from product join categorise on product.cat_id=categorise.id where product.id=$products_id");
if(!$products){
    die('404 page not found');
}
$productsdb=$products->fetch_assoc();

$name=$productsdb['product_name'];
$products_img=$productsdb['product_img'];
$products_des=$productsdb['description'];
$products_categorie=$productsdb['categorise_name'];
$products_price=$productsdb['price'];


function canUploadImage($field){

  $allowed=[
      'png'=>'image/png',
      "jpg"=>'image/jpeg',
      'gif'=>'image/gif'

    ];
    $fileSize=$field['size'];
    if(!$fileSize==0 && $field["error"]==0){
  $fileMimeType= mime_content_type($field["tmp_name"]);
 $maxFileSize= 3*1024 *1024;


  if(!in_array($fileMimeType,$allowed)){   
    return "نوع الملف غير مسموح به";
  }
  if($maxFileSize<$fileSize){
   return 'حجم الملف كبير الحجم الموصى به'." ". $maxFileSize;
  }

    }  
    else{
        return 'يجب ارفاق ملف';
    }
    return true;
  



}
if($_SERVER['REQUEST_METHOD'] =="POST"){
 
  
    if(!$name){
      $nameEror="لا يمكن اهمال هذا الحقل";
    }
    if(!isset($_FILES[$fileForm]['tmp_name']) || !$_FILES[$fileForm]['tmp_name']){
     $filename=$products_img;
    }else{
    unlink("../../"."$products_img");
   $uploadimg=canUploadImage($_FILES[$fileForm]);
        if($uploadimg===true){
            $file=time().$_FILES[$fileForm]['name'];
        
            if (is_dir($uploadDir) && is_writable($uploadDir)) {
              move_uploaded_file($_FILES[$fileForm]['tmp_name'],$uploadDir.'/'.$file);
              $filename="./front-end/img/$file";
          }else{
            echo 'Upload directory is not writable, or does not exist.';
          }
        }
        else{
            $catagorieError=$uploadimg;
        
        }
    }
    if(!$nameEror && !$deserror && !$priceEror && !$fileError){
    


        $insertProduct=$mysqli->prepare('update product set product_name=? ,description=? , price=? , product_img=? , cat_id=? where id=?');
        $insertProduct->bind_param('ssisii',$productname,$productdes,$productprice,$productimg,$product_id,$pro_id);
        $productname=$_POST['name'];
        $productprice=$_POST['price'];
        $productimg=$filename;
        $productdes=$_POST['description'];;
        $product_id=$_POST["id"];
        $pro_id=$products_id;

      $insertProduct->execute();

      ob_start();
      header("Location:./index.php");
    }

     
   

}


$categorise=$mysqli->prepare("select * from categorise");

$categorise->execute();

$catresult=$categorise->get_result()->fetch_all(MYSQLI_ASSOC);



?>


<form <?php echo $_SERVER['PHP_SELF'] ?> method="POST" enctype="multipart/form-data" class=" formadd" >  
<div class="formadd__container">
        

        
        <h1 class="formadd__title">اضف منتج جديد للصفحه الرئيسية</h1>
        <label>
          اسم منتج
        <input type="text" name='name' class="formadd__input" value="<?php echo $name?>">
        <span class="formadd__error"><?php echo $nameEror?></span>
        </label>
        <label>
            صورة عرض للمنتج           <input type="file" name="<?php echo $fileForm; ?>" class="formadd__input" value="<?php echo $fileForm?>">
            <span class="formadd__error"><?php echo $fileError;?></span>
        </label>
<label>
  نوع المنتج
        <select class="formadd__select" name="id" >
          <?php foreach($catresult as $categorie ){?>
                <option <?php if($categorie['categorise_name']===$products_categorie){echo "selected"; } ?> value="<?php echo $categorie["id"] ?>"  class="formadd__option"><?php echo $categorie["categorise_name"]; ?></option>
            <?php } ?>
            
        </select>
        <span class="formadd__error"><?php echo $typeerror;?></span>
</label>
        <label>
        <textarea class="formadd__textarea" name="description" value="<?php echo $products_des; ?>  "><?php echo $products_des; ?>  </textarea>
        <span class="formadd__error"><?php echo $deserror;?></span>
        </label>
        <label>
        سعر منتج

        <div>
        $   <input type="number" name='price' class="formadd__input formadd__input-number" value="<?php echo $products_price?>">
        </div>
     
        <span class="formadd__error"><?php echo $priceEror?></span>
        </label>
   
        <button class="formadd__btn"> تعديل المنتج</button>
    </div>

</form>


<?php

?>
