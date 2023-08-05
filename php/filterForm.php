<?php 

require_once __DIR__.'/../config/database.php';
$nameEror=$catagorieError=$emailError=$passowrdError=$fileError="";

$name= $catagorie =$email="";
$uploadDir='../../front-end/img';

function filterString($field){

    $field=filter_var(trim($field) , FILTER_SANITIZE_STRING);
    if(empty($field)){
        return false;
    }else{
    return $field;
    }
}

function filterEmail($field){

    $field=filter_var(trim($field),FILTER_SANITIZE_EMAIL );

    if(filter_var($field,FILTER_VALIDATE_EMAIL)){
        return $field;
    }else{
        return false;
    }
}

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

function uploadimage($file){
    $uploadDir='../../front-end/img';
    $canupload=canUploadImage($file);
  

      if($canupload===true){
       
        if(!is_dir($uploadDir)){
          umask(0);
          mkdir('http://127.0.0.1/%d9%85%d8%aa%d8%ac%d8%b1%d9%8a/front-end/img',0775);
        }
        
       
       return true;
       
    

      }
      else{
      return   $canupload;
         
      }
       
  
}

  
  
 






?>