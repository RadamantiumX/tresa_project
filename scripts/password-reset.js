const btnReset = document.getElementById('btn-reset');
const password1 = document.getElementById('password1');
const password2 = document.getElementById('password2');
const emailPassword = document.getElementById('email-password');
const resetAlert = document.getElementById('reset-alert');

window.addEventListener('load',()=>{
    const urlSearchParams = new URLSearchParams(window.location.search);
    const secret = urlSearchParams.get("secret");
    if(!secret){
        window.location.href = "https://treza.com.mx/reports/login.html"
    }
})
const errorP = document.getElementById('error-p');

//Password Reset form
btnReset.addEventListener('click',()=>{
    let formData = new FormData();
    
    formData.append('password1',password1.value);
    formData.append('password2',password2.value);
    formData.append('email',emailPassword.value);

    if (password1.value === password2.value){
        axios.post('password-reset.php',formData)
         .then((response)=>{
            res = response.data;
            resetAlert.style.display = 'block';
            resetAlert.innerHTML = res;
            setTimeout(()=>{
                window.location.href = "https://treza.com.mx/reports/login.html" 
            },5000)

            console.log(res);
         })
         .catch((err)=>{
            console.log(err);
         })
    }else{
       errorP.innerHTML = 'Las contraseñas coinciden...' 
    }
})