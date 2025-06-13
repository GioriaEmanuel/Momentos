<div class="p-6 ">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <div class="flex flex-col gap-4  max-h-[80%]  py-4">

        @foreach ($mensajes as $mensaje)
            @if ($mensaje->user_id == auth()->user()->id)
                <div class="colocador bg-black text-titulos py-2 px-3 rounded-r-2xl rounded-t-2xl max-w-80 ">
                    <p class="">{{ $mensaje->mensaje }}</p>
                    <p class=" font-thin text-xs">{{ $mensaje->created_at->diffForHumans() }}</p>
                </div>
            @else
                <div class="colocador bg-gray-800 text-titulos py-2 px-3 rounded-l-2xl rounded-t-2xl max-w-80 self-end">
                    <p class="">{{ $mensaje->mensaje }}</p>
                    <p class=" font-thin text-xs">{{ $mensaje->created_at->diffForHumans() }}</p>
                </div>
            @endif
        @endforeach

    </div>

    <div>
        @push('scripts')
            <script>
                document.addEventListener('livewire:load', () => {
                    Echo.private(`chat.${@this.receptorId}`)
                        .listen('MensajeEnviado', (e) => {
                            Livewire.emit('nuevoMensajeRecibido', e.mensaje);
                        });
                });
            </script>
        @endpush
    </div>
</div>
