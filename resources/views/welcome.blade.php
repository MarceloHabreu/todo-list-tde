@extends('master')

@section('content')
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif
    <h2>Page Inicial</h2>
    <hr>
    <a href="{{ route('login.index') }}">Entrar</a> ou
    <a href="{{ route('register.index') }}">Registrar-se</a>
@endsection
