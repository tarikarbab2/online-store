<?php  $title='add'; 

require_once './config/database.php';
require_once './config/app.php';
$fileForm="catagorie";
require_once './templates/header.php' ;
require_once './php/filterForm.php';
require_once './php/handleform/categorie.php';






?>
<h1>&nbsp;</h1>
<?php  
if(isset($_POST['name']) && isset($_FILES['catagorie']['tmp_name'])){
  echo "<pre>";echo print_r($_FILES['catagorie']);  echo "</pre>"; 
  echo"<h1>"; echo  $catagorieError; echo"</h1>";
}?>
<form <?php echo $_SERVER['PHP_SELF'] ?> method="POST" enctype="multipart/form-data" class=" formadd" >  
<div class="formadd__container">
        

        
        <h1 class="formadd__title">اضف قائمه جديدة للصفحه الرئيسية</h1>
        <label>
          اسم التصنيف
        <input type="text" name='name' class="formadd__input" value="<?php echo $name?>">
        <span class="formadd__error"><?php echo $nameEror?></span>
        </label>
        <label>
            صورة عرض للصنف           <input type="file" name="<?php echo $fileForm; ?>" class="formadd__input" value="<?php echo $catagorie?>">
            <span class="formadd__error"><?php echo $catagorieError;?></span>
        </label>
   
        <button class="formadd__btn">اضافة صنف للقائمه الرئيسية</button>
    </div>

</form>
<?php
if(isset($_POST["name"] )&& isset($_POST["catagorie"])){

}?>







<?php require_once './templates/footer.php'; ?>