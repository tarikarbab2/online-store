const signup=document.querySelector('#signup');
const signupForm=document.querySelector('#signupForm')
const login=document.querySelector('#login');
const loginForm=document.querySelector('#loginForm')
const closedsign=document.querySelector('.form__cancel')
const closedlog=document.querySelector('.cancel-log')
signup.addEventListener('click',(e)=>{
    signupForm.style.display='flex';
})
login.addEventListener('click',(e)=>{
    loginForm.style.display='flex';
})
closedsign.addEventListener('click',(e)=>{
     signupForm.style.display='none';
     
})
closedlog.addEventListener('click',(e)=>{
    loginForm.style.display='none';
    
})

