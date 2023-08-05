<?php 
if(isset($_SESSION['success_message'])){?>
 <div class="header__message"> <?php echo $_SESSION['success_message'];  ?> </div> 
 <?php unset($_SESSION['success_message']) ?>
     
<?php } ?>