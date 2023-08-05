<?php

$connection =[
      "host"=>"localhost",
      "username"=>"root"
      ,"password"=>"",
      "dbname"=>"mystore"

];
$mysqli=new mysqli($connection["host"],
$connection["username"],
$connection["password"],
$connection["dbname"]);

if($mysqli->connect_error){
    die("eror");
}