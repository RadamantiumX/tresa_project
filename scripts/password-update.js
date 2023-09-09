const btnPasswordUpdate = document.getElementById('btn-password-update');
const update1 = document.getElementById('update1');
const update2 = document.getElementById('update2');

btnPasswordUpdate.addEventListener('click',()=>{
    let formData = new FormData();
    formData.append('password1',update1.value);
    formData.append('password2',update2);
    formData.append('email',localStorage.getItem('USER_EMAIL'));

    axios.post('password-reset.php',formData)
     .then((response)=>{
        console.log(response.data);
        alert(response.data);
     })
     .catch((err)=>{
        console.log(err);
        alert(response.data);
     })

})



