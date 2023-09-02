    const uploadButton = document.getElementById('upload-button');
    const fileInput = document.getElementById('file-input');
    const responseDiv = document.getElementById('response');
    const radioDiv = document.getElementById('radio');

    fileInput.addEventListener('change',function(){
        if(fileInput.files.length > 0){
        radioDiv.style.display = 'block';
        uploadButton.style.display = 'block';
       }
    })

    uploadButton.addEventListener('click', function () {
        const file = fileInput.files[0];
        const selection = document.querySelector('input[name="selection"]:checked');
      
        let formData = new FormData();
        formData.append('file', file);
        formData.append('selection', selection.value);

        if(fileInput.files.length > 0){
            
            axios.post('upload.php',formData)
            .then(function(response){
                 res = response.data;
                 responseDiv.innerHTML = res;
                 console.log(res);
            })
            .catch(function (error) {
                console.log(error);
                responseDiv.innerHTML = 'Ha ocurrido un error en la carga... Por favor, intentelo de nuevamente';
            })
        }else{
            console.log('No hay archivo subidos...');
        }
    });
