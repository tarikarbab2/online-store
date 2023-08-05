<?php ?>
   <script src="./front-end/js/nav.js"></script>
   <script src="./front-end/js/header.js">
</script>
<script>  window.addEventListener("scroll",function(e){
  const navmove=document.querySelector(".nav");
  let scroll=this.scrollY;

  if(scroll>0){
    navmove.style.position="fixed";
  }else{
   navmove.style.position="relative";
  }
})</script>