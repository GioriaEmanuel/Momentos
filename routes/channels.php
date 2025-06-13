<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::routes(['middleware' => ['auth:api']]);

Broadcast::channel('chat.{receptorId}', function ($user, $receptorId) {
    // Lógica para determinar si el $user puede escuchar en el canal 'chat.' . $receptorId
    return (int) $user->id === (int) $receptorId; // Ejemplo: Solo el receptor puede escuchar su propio canal
});