import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

document.addEventListener('DOMContentLoaded', function() {
    const dropzoneElement = document.querySelector('#dropzone'); // Obtener el elemento

    // Solo inicializa Dropzone si el elemento existe
    if (dropzoneElement) {
        const dropzone = new Dropzone(dropzoneElement, {
            dictDefaultMessage : "Arrastra y suelta tu imagen aqui",
            acceptedFiles : '.jpg, .jpeg, .png', // Corregido .jpng a .jpeg
            addRemoveLinks: true,
            dictRemoveFile : 'borrar archivo',
            maxFiles : 1,

            init: function(){
                // Revisa si 'imagen' existe antes de intentar acceder a su value
                const imagenInput = document.getElementById('imagen');
                if(imagenInput && imagenInput.value.trim()){
                    const imagenPublicada = {
                        size: 1234,
                        name: imagenInput.value,
                    };

                    this.options.addedfile.call(this, imagenPublicada);
                    this.options.thumbnail.call(this, imagenPublicada,`/uploads/${imagenPublicada.name}`);

                    imagenPublicada.previewElement.classList.add('dz-complete', 'dz-success'); // Corregido 'dz-sucess' a 'dz-success'
                }
            }
        });

        dropzone.on('success', (file, response) => {
            const imagenInput = document.getElementById('imagen');
            if (imagenInput) {
                imagenInput.value = response; // Asumiendo que 'response' es el nombre del archivo
            }
            console.log(response);
        });

        dropzone.on('removedfile', () => {
            const imagenInput = document.getElementById('imagen');
            if (imagenInput) {
                imagenInput.value = '';
            }
            console.log('imagen borrada');
        });
    } else {
        console.error("Error: El elemento con ID 'dropzone' no fue encontrado en el DOM.");
    }
});