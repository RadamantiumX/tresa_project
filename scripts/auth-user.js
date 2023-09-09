const userName = localStorage.getItem('USER_NAME');
const userEmail = localStorage.getItem('USER_EMAIL');

window.addEventListener('load',()=>{
   if(!localStorage.getItem('ACCESS_TOKEN')){
    window.location.href = "https://treza.com.mx/reports/login.html";
  }
})

const btnLogout = document.getElementById('btn-logout');
const userNameTag = document.getElementById('user-name');




btnLogout.addEventListener('click',()=>{
    localStorage.removeItem('ACCESS_TOKEN');
    localStorage.removeItem('USER_NAME');
    localStorage.removeItem('USER_EMAIL');

    window.location.href = "https://treza.com.mx/reports/login.html"
})


userNameTag.innerHTML = userName;