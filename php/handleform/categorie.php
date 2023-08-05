<?php
require_once __DIR__.'/../../config/database.php';

require_once __DIR__.'/../filterForm.php';


if($_SERVER['REQUEST_METHOD'] =="POST"){
    $name=filterString($_POST['name']);
      if(!$name){
        $nameEror="لا يمكن اهمال هذا الحقل";
      }
  $uploadimg=canUploadImage($_FILES[$fileForm]);
  if($uploadimg===true){
      $filename=time().$_FILES[$fileForm]['name'];
        move_uploaded_file($_FILES[$fileForm]['tmp_name'],$uploadDir.'/'.$filename);
      
  }
  else{
      $catagorieError=$uploadimg;
  
  }
  }

if($_SERVER['REQUEST_METHOD'] =="POST" && !$nameEror &&!$catagorieError){
    $filetmpname=time().$_FILES['catagorie']['name'];
           

      $insertcatagorie=$mysqli->prepare("insert into categorise(categorise_name,categorise_img)" ."values(?,?)");
       $insertcatagorie->bind_param('ss',$categorie_name,$categorie_img);
       $categorie_name=$name;
       $categorie_img="$uploadDir/$filetmpname";
       
       $insertcatagorie->execute();
       ob_start();
       header("Location: http://localhost/متجري");
       
  }

  
  $categorise=$mysqli->prepare("select * from categorise");

  $categorise->execute();
  
  $catresult=$categorise->get_result()->fetch_all(MYSQLI_ASSOC);