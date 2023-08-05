
<?php
$title='update categorise';
$front_end='../..';
$side='../';
$admin=true;
require_once '../templates/mesage.php';
require_once '../../config/database.php';
require_once '../../config/app.php';
require_once '../templates/header.php';
$nameEror=$catagorieError='';
$fileForm="catagorie";
// require_once __DIR__.'/../../php/filterForm.php';
if(!isset($_GET['id']) || !$_GET['id']){
    die('404 page not found');
}

$uploadDir=__DIR__.'/../../front-end/img';

$categorie_id=$_GET['id'];
$categorie=$mysqli->query('select * from categorise where id='."$categorie_id");
if(!$categorie){
    die('404 page not found');
}
$categoriedb=$categorie->fetch_assoc();

$name=$categoriedb['categorise_name'];
$categorise_img=$categoriedb['categorise_img'];


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
     $filename=$categorise_img;
    }else{
    unlink("../../"."$categorise_img");
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

}


if($_SERVER['REQUEST_METHOD'] =="POST" && !$nameEror &&!$catagorieError){

         

    $insertcatagorie=$mysqli->prepare("update categorise set categorise_name=? ,categorise_img=? where id=? ");
     $insertcatagorie->bind_param('ssi',$categorie_name,$categorie_img,$categorie_id);
     $categorie_name=$name;
     $categorie_img=$filename;
     
     $insertcatagorie->execute();
     ob_start();
     header("Location: http://localhost/متجري/admin/categorie/");
     
}

?>



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