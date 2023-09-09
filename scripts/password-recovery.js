const emailRecovery = document.getElementById('email-recovery');
const btnLink = document.getElementById('btn-link');
const spinnerAwait = document.getElementById('spinner-await');

const alertMessage = document.getElementById('alert');


//Email Link send
btnLink.addEventListener('click',()=>{
   let formData = new FormData();
   formData.append('email',emailRecovery.value);
   spinnerAwait.style.display = 'block';
   axios.post('password-recovery.php',formData)
     .then((response) => {
        res = response.data;
        spinnerAwait.style.display = 'none';
        alertMessage.style.display = 'block';
        alertMessage.innerHTML = res;
        console.log(res);
     }).catch((err) => {
        console.log(err);
     });

});

