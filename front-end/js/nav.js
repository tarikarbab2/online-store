const nav=document.querySelector('.nav__icon')
const items=document.querySelector('.nav__items')
const card=document.querySelector(".card")

nav.addEventListener('click',function(e){
    
    items.style.display=items.style.display===''?'flex':"";

})
var myNav = document.querySelector('.nav');
window.onscroll = function () { 
    "use strict";
    if (document.body.scrollTop >= 200 || document.documentElement.scrollTop >= 200 ){
        myNav.classList.add("nav-colored");
        myNav.classList.remove("nav-transparent");
    } 
    else {
        myNav.classList.add("nav-transparent");
        myNav.classList.remove("nav-colored");
    }
};
