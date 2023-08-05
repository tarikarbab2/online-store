<?php  $title='add product'; 

require_once './config/database.php';
require_once './config/app.php';
$fileForm="product";
$des="";
$deserror='';
$typeerror="";

$nameEror=$deserror=$fileError=$typeerror=$price=$priceEror='';
require_once './templates/header.php';
require_once './php/handleform/product.php';
require_once './php/filterForm.php';

 
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

?>







<?php require_once './templates/footer.php'; ?>