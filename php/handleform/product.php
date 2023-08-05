<?php 

require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../filterForm.php';
require_once __DIR__.'/../../addproduct.php';



if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name=filterString($_POST['name']);
    $price=filterString($_POST['price']);
    $des=filterString($_POST['description']);
    if(!$name){  $nameEror='لا يمكن اهمال هذا الحقل'; }
    if(!$price){ $priceEror='لا يمكن اهمال هذا الحقل'; }
    if(!$des){ $deserror="لا يمكن اهمال هذا الحقل";}

    $uploadimg=canUploadImage($_FILES[$fileForm]);
    if($uploadimg===true){
        $filename=time().$_FILES[$fileForm]['name'];
          move_uploaded_file($_FILES[$fileForm]['tmp_name'],$uploadDir.'/'.$filename);
        
    }
    else{
        $fileError=$uploadimg;
    
    }

    if(!$nameEror && !$deserror && !$priceEror && !$fileError){
        $filetmpname=time().$_FILES[$fileForm]['name'];


        $insertProduct=$mysqli->prepare('insert into product(product_name,description,price,product_img,cat_id)' . "values(?,?,?,?,?)");
        $insertProduct->bind_param('ssisi',$productname,$productdes,$productprice,$productimg,$product_id);
        $productname=$name;
        $productprice=$price;
        $productimg="$uploadDir/$filetmpname";
        $productdes=$des;
        $product_id=$_POST["id"];

      $insertProduct->execute();

      ob_start();
      header("Location: http://localhost/متجري");
    }

}