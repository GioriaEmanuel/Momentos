import 'emoji-picker-element';


document.addEventListener('DOMContentLoaded', function() {

    const abrirEmoji = document.getElementById('abrirEmoji');
    const picker = document.querySelector('emoji-picker');
    const textarea = document.getElementById('coment');
    const btnSubmit = document.getElementById('btn_comentar');
    const ventana_modal = document.querySelector('.modal');
    const body = document.querySelector('#ventana_chat');
    const btn_abrirModal = document.querySelector('.abrir_modal');
 

    if(textarea){

        textarea.dispatchEvent(new Event('input')); // Forzar que Livewire detecte el cambio
        textarea.addEventListener('input', mostrarBoton);
    }

    if(ventana_modal){

        btn_abrirModal.addEventListener('click', abrirModal);
        
    }

    if(abrirEmoji){
        
        abrirEmoji.addEventListener('click', function() {
    
            picker.classList.toggle('hidden');
            
        });
    }

    if(picker){

        if(!picker.classList.contains('.hidden')){
    
            textarea.addEventListener('click', function(){
               picker.classList.add('hidden');
               console.log(!picker.classList.contains('hidden'))
            });
        }

        //disparar un evento a ver si livewire quere introducir los emojis
 
    picker.addEventListener('emoji-click', event => {
       
       
        const emoji = event.detail.unicode;
        
        // Guardar la posición actual del cursor
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;

        // Insertar el emoji en la posición del cursor
        const textBefore = textarea.value.substring(0, start);
        const textAfter = textarea.value.substring(end);
        textarea.value = textBefore + emoji + textAfter;

        
        textarea.focus(); // Asegurar que el foco se mantenga en el textarea
        
        // Mover el cursor al final del emoji insertado
        const newCursorPosition = start + emoji.length;
        textarea.setSelectionRange(newCursorPosition, newCursorPosition);
        //obligo al navegador a detectar el input en el textarea, sino, el componente de livewire no detecta valores ingresados con js, a menos que lo acompañe una entrada con teclado
        textarea.dispatchEvent(new Event('input'));
       
        //Evaluar que el text area ya no esta vacio para mostrar el boton
        mostrarBoton();
    });
    }

    //Mostrar ventana modal de likers
    function abrirModal(){
        const btn_cerrarModal = document.querySelector('.cerrar_modal');
        ventana_modal.classList.remove('hidden')
        btn_cerrarModal.addEventListener('click', cerrarModal);
        window.dispatchEvent(new Event('upgradeLikers'));
        
    }
   
    function cerrarModal(){
    
        ventana_modal.classList.add('hidden');
    }
    //evaluar que el text area no este vacio para mostrar el boton de comentar
   
    if(btnSubmit){
        
        btnSubmit.addEventListener('click', function(){
    
            textarea.value = textarea.value + '.';
            
            
        })
    }
 

    function mostrarBoton(){
        if(textarea.value != ''){
            document.getElementById('btn_comentar').classList.remove('hidden');
        }else{
            document.getElementById('btn_comentar').classList.add('hidden');
        }
    }

    
});