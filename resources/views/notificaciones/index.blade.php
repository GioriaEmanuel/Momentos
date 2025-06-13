@extends('app')

@section('titulo')
    Notificaciones
@endsection

@section('contenido')

<x-listar-notificaciones :user="$user"/>


@endsection