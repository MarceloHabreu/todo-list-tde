@extends('master')

@section('content')
    <a href="{{ route('welcome') }}">Voltar</a> |
    <a href="{{ route('register.index') }}">Registrar-se</a>

    <h2>Login</h2>

    @error('error')
        <span>{{ $message }}</span>
    @enderror

    @if (session('successfully'))
        <div style="color: green;">
            {{ session('successfully') }}
        </div>
    @endif
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        {{-- Email --}}
        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="email...">
        @error('email')
            <div style="color: red;">
                {{ $message }}
            </div>
        @enderror

        {{-- Password --}}
        <label for="password">Senha:</label>
        <input type="password" name="password" placeholder="senha...">
        @error('password')
            <div style="color: red;">
                {{ $message }}
            </div>
        @enderror


        <button type="submit">Entrar</button>
    </form>
@endsection
