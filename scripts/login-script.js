
const btnForgot = document.getElementById('forgot-psw');
const loginForm = document.getElementById('login-form');
const passwordRecovery = document.getElementById('password-recovery');
const btnLogin = document.getElementById('btn-login');
const alertMsg = document.getElementById('alert');

const btnSignIn = document.getElementById('btn-sign-in');
const email = document.getElementById('email');
const password = document.getElementById('password');



window.addEventListener('load',()=>{
    if(localStorage.getItem('ACCESS_TOKEN')){
       window.location.href = "https://treza.com.mx/reports/file.html" 
    }
    
})

btnForgot.addEventListener('click',()=>{
    loginForm.style.display = 'none';
    passwordRecovery.style.display = 'block';
})

btnLogin.addEventListener('click',()=>{
    loginForm.style.display = 'block';
    passwordRecovery.style.display = 'none';
    alertMsg.style.display = 'none';
})

btnSignIn.addEventListener('click',()=>{
    let formData = new FormData();

    formData.append('email',email.value);
    formData.append('password',password.value);

    axios.post('login.php',formData)
      .then(function(response){
         // console.log(response.data[0].user);
          if(Array.isArray(response.data)){
          localStorage.setItem('ACCESS_TOKEN',response.data[0].token)
          localStorage.setItem('USER_NAME',response.data[0].user['user_name'])
          localStorage.setItem('USER_EMAIL',response.data[0].user['user_email'])
          //console.log(response.data);
          window.location.href = "https://treza.com.mx/reports/file.html"
          }else{
            alert('Email o contraseña incorrectos...')
        }
      })
})  
