    const uploadButton = document.getElementById('upload-button');
    const fileInput = document.getElementById('file-input');
    const responseDiv = document.getElementById('response');
    const radioDiv = document.getElementById('radio');
    const form = document.getElementById('upload-form');
    const tableContainer = document.getElementById('container-data');
    const loading = document.getElementById('loading');
    
    

    fileInput.addEventListener('change',function(e){
        let fileRead = e.target.files[0];
        if(fileRead){
            tableContainer.style.display = 'block';
            const reader = new FileReader();
            reader.onload = function (e){
                const contents = e.target.result;
                const lines = contents.split(/\r?\n|\r/);

                const table = document.getElementById('table-data');
                table.innerHTML = '';

                for (let i = 0; i < lines.length; i++){
                    const row = document.createElement('tr');
                    const cells = lines[i].split(',');

                    for (let j = 0; j < cells.length; j++){
                        const cell = i === 0 ? document.createElement('th') : document.createElement('td');
                        cell.textContent = cells[j];
                        row.appendChild(cell);
                    }

                    table.appendChild(row);
                }
                const tableContainer = document.getElementById('container-data');
                tableContainer.innerHTML = '';
                tableContainer.appendChild(table);
            }

            reader.readAsText(fileRead);
        }


        if(fileInput.files.length > 0){
        radioDiv.style.display = 'block';
        uploadButton.style.display = 'block';
       }
    },false)


 

    uploadButton.addEventListener('click', function () {
        const file = fileInput.files[0];
        const selection = document.querySelector('input[name="selection"]:checked');
        loading.style.display = 'block';
        let formData = new FormData();
        formData.append('file', file);
        formData.append('selection', selection.value);

        if(fileInput.files.length > 0){
            
            axios.post('upload.php',formData)
            .then(function(response){
                 res = response.data;
                 responseDiv.innerHTML = res;
                 loading.style.display = 'none';
                 console.log(res);
                 form.reset();
            })
            .catch(function (error) {
                console.log(error);
                responseDiv.innerHTML = 'Ha ocurrido un error en la carga... Por favor, intentelo de nuevamente';
            })
        }else{
            console.log('No hay archivo subidos, o formato incompatible...');
        }
    });
