
const btnForgot = document.getElementById('forgot-psw');
const loginForm = document.getElementById('login-form');
const passwordRecovery = document.getElementById('password-recovery');
const btnLogin = document.getElementById('btn-login');

const btnSignIn = document.getElementById('btn-sign-in');
const email = document.getElementById('email');
const password = document.getElementById('password');



window.addEventListener('load',()=>{
    if(localStorage.getItem('ACCESS_TOKEN')){
       window.location.href = "http://localhost/tresa/test.html" 
    }
    
})

btnForgot.addEventListener('click',()=>{
    loginForm.style.display = 'none';
    passwordRecovery.style.display = 'block';
})

btnLogin.addEventListener('click',()=>{
    loginForm.style.display = 'block';
    passwordRecovery.style.display = 'none';
})

btnSignIn.addEventListener('click',()=>{
    let formData = new FormData();

    formData.append('email',email.value);
    formData.append('password',password.value);

    axios.post('login.php',formData)
      .then(function(response){
         // console.log(response.data[0].user);
          
          localStorage.setItem('ACCESS_TOKEN',response.data[0].token)
          localStorage.setItem('USER_NAME',response.data[0].user['user_name'])
          localStorage.setItem('USER_EMAIL',response.data[0].user['user_email'])
          
          window.location.href = "http://localhost/tresa/index.html"
        
      })
})  
