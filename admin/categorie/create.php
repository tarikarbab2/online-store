<?php  $title='add'; 
$title='categories';
$front_end='../..';
$side='../';
$admin=true;
require_once '../../config/database.php';
require_once '../../config/app.php';

require_once '../templates/header.php';
require_once '../../templates/mesage.php';
$name="";
$fileForm="catagorie";
$nameEror=$catagorieError='';


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


if($_SERVER['REQUEST_METHOD'] =="POST" && !$nameEror &&!$catagorieError){
  $filetmpname=time().$_FILES['catagorie']['name'];
         

    $insertcatagorie=$mysqli->prepare("insert into categorise(categorise_name,categorise_img)" ."values(?,?)");
     $insertcatagorie->bind_param('ss',$categorie_name,$categorie_img);
     $categorie_name=$_POST['name'];
     $categorie_img="./front-end/img/$filetmpname";
     
     $insertcatagorie->execute();
     ob_start();
     header("Location: http://store.local/admin/categorie/");
     
}






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







