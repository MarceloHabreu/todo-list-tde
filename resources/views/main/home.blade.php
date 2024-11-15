@extends('master')

@section('content')
    @if (auth()->check())
        Você está logado {{ auth()->user()->firstname }} - <a href="{{ route('login.destroy') }}">Sair</a>
    @endif
@endsection
