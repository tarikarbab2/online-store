<?php 
session_start();
if(isset($_SESSION['logged_in'])){
   $_SESSION= [];
   $_SESSION['success_message']="you have been loged out successfully, see you soon";
   header('location:../index.php');
   die();
}