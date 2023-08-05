<?php  $title='add product'; 



$front_end='../..';
$side='../';
$admin=true;

require_once '../../config/database.php';
require_once '../../config/app.php';

require_once '../templates/header.php';
require_once '../../templates/mesage.php';

$fileForm="product";
$name="";
$des="";
$deserror='';
$typeerror="";
$nameEror=$deserror=$fileError=$typeerror=$price=$productError=$priceEror='';


$uploadDir=__DIR__.'/../../front-end/img';
$uploadDir=__DIR__.'/../../front-end/img';
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

 
  
$uploadimg=canUploadImage($_FILES[$fileForm]);
if($uploadimg===true){
    $filename=time().$_FILES[$fileForm]['name'];

    if (is_dir($uploadDir) && is_writable($uploadDir)) {
      move_uploaded_file($_FILES[$fileForm]['tmp_name'],$uploadDir.'/'.$filename);
  }else{
    echo 'Upload directory is not writable, or does not exist.';
  }
     
   

}
else{
    $catagorieError=$uploadimg;

}
}


if($_SERVER['REQUEST_METHOD'] =="POST" && !$nameEror &&!$productError){
  $filetmpname=time().$_FILES['product']['name'];
         

    $insertproduct=$mysqli->prepare("insert into product(product_name,description,price,product_img,cat_id)" ."values(?,?,?,?,?)");
     $insertproduct->bind_param('ssisi',$product_name,$product_description,$product_price,$product_img,$cat_id);
     $product_name=$_POST['name'];
     $product_img="./front-end/img/$filetmpname";
     $product_price=$_POST['price'];
     $product_description=$_POST['description'];
     $cat_id=$_POST['id'];
     
     $insertproduct->execute();
     ob_start();
     header("Location: http://store.local/admin/products/");
     
}
 
$categorise=$mysqli->prepare("select * from categorise");

$categorise->execute();

$catresult=$categorise->get_result()->fetch_all(MYSQLI_ASSOC);



?>
<h1>&nbsp;</h1>


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
                <option value="<?php echo $categorie["id"] ?>"  class="formadd__option"><?php echo $categorie["categorise_name"]; ?></option>
            <?php } ?>
            
        </select>
        <span class="formadd__error"><?php echo $typeerror;?></span>
</label>
        <label>
        <textarea class="formadd__textarea" name="description" value="<?php echo $des; ?>">  </textarea>
        <span class="formadd__error"><?php echo $deserror;?></span>
        </label>
        <label>
        سعر منتج

        <div>
        $   <input type="number" name='price' class="formadd__input formadd__input-number" value="<?php echo $price?>">
        </div>
     
        <span class="formadd__error"><?php echo $priceEror?></span>
        </label>
   
        <button class="formadd__btn">اضافة منتج</button>
    </div>

</form>


<?php
echo print_r($_POST);
echo print_r($_FILES['product']['tmp_name'])
?>
