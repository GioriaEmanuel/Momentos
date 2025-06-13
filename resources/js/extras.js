
document.addEventListener('DOMContentLoaded', function () {

    //selecciono todos los links de navegacion de los posts

    const links = document.querySelectorAll('.page-item');

    if (links.length > 0) {

        document.querySelector('.pagination').classList.add('items-center');
        //itero sobre los links de paginacion
        links.forEach((link) => {

            //modificaciones al estilo de todos los links
            link.classList.add('transition-all', 'hover:bg-titulos', 'w-10', 'h-10', 'hover:rounded-full', 'items-center', 'flex', 'justify-center');
            //si el link tiene el elemento hijo lo modifico - las flechas no lo tienen - 
            if (link.firstChild.classList) {
                link.firstChild.classList.add('hover:text-fondosecundario');
            } else {
                //si no lo tiene le aplico el efecto a link perse
                link.classList.add('hover:text-fondosecundario');
            }
            if (link.classList.contains('active')) {

                link.classList.add('bg-titulos', 'w-10', 'h-10', 'rounded-full', 'items-center', 'flex', 'justify-center');
                link.firstChild.classList.add('text-fondosecundario');
            }

        });
    }

    //Filtro de chats:

    if (document.querySelector('#chat')) {
        let chats_array = document.querySelectorAll('#chat');
        let input_filtro = document.querySelector('#buscar_chat');

        input_filtro.addEventListener('input', filtrarchats);

        function filtrarchats(e) {

            chats_array.forEach((chat) => {

                let receptor = chat.querySelector('#chat_receptor').innerText;


                if (receptor.includes(input_filtro.value)) {
                    chat.style.display = '';
                } else {
                    chat.style.display = 'none';
                }


            });

        }
    }

});
