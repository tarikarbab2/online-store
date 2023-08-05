<?php 
$title='users';
$front_end='../..';
$admin=true;
require_once '../../config/database.php';
require_once '../../config/app.php';

$side='../';
require_once '../templates/header.php';
require_once '../../templates/mesage.php';

$data=$mysqli->prepare('select * from users limit ?,?');
if(isset($_GET['limit'])){
    $data->bind_param('s',$_GET['limit']);
}
else{
    $data->bind_param('ii',$limit,$number);
    $limit=0;
    $number=10;
}
$data->execute();
$user=$data->get_result();
$users=$user->fetch_all(MYSQLI_ASSOC);



?>

<main class="users">
<h1 class="users__title">يمكنك التعديل او اضافة مستخدمين جدد عن طريق هذه الصفحه</h1>
<div class="users__add-container"><a href="./create.php" class="users__add"> اضافة مستخدم جديد</a></div>
<h4 class="users__table">:قائمة المستخدمين</h4>

  <?php foreach($users as $all){ ?> 
 <div class="users__container">

    <div class="users__edit">
        <a class="users__update users__btn" href="./edit.php?id=<?php echo $all['id'] ?>">EDIT</a>
        <a href="./delete.php?id=<?php echo $all['id'] ?>" class="users__delete users__btn">DELETE</a>
    </div>
    <div class="users__data">
    <h1 class="users__name"><?php echo $all['name'] ?>:اسم المستخدم</h1>
    <h2 class="users__name"><?php echo $all['email'] ?> :البريد الالكتروني</h2>
    <h5 class="users__roll"><?php echo $all['role'] ?>  :الصلاحيات</h5>
    </div>
 </div>
 <?php } ?>

</main>