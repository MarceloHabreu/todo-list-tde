@extends('master')

@section('content')
    <a href="{{ route('welcome') }}">Voltar</a> |
    <a href="{{ route('login.index') }}">Entrar</a>

    <h2>Register</h2>
    @if (session('successfully'))
        <div style="color: green;">
            {{ session('successfully') }}
        </div>
    @endif
    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <!-- First Name -->
        <label for="firstname">Nome:</label>
        <input type="text" name="firstname" value="{{ old('firstname') }}" placeholder="nome...">
        @error('firstname')
            <div style="color: red;">
                {{ $message }}
            </div>
        @enderror

        <!-- Last Name -->
        <label for="lastname">Sobrenome:</label>
        <input type="text" name="lastname" value="{{ old('lastname') }}" placeholder="sobrenome...">
        @error('lastname')
            <div style="color: red;">
                {{ $message }}
            </div>
        @enderror

        <!-- Email -->
        <label for="email">Email:</label>
        <input type="text" name="email" value="{{ old('email') }}" placeholder="email...">
        @error('email')
            <div style="color: red;">
                {{ $message }}
            </div>
        @enderror

        <!-- Password -->
        <label for="password">Senha:</label>
        <input type="password" name="password" placeholder="senha...">
        @error('password')
            <div style="color: red;">
                {{ $message }}
            </div>
        @enderror

        <!-- Password Confirmed -->
        <label for="password_confirmation">Confirme sua Senha:</label>
        <input type="password" name="password_confirmation" placeholder="senha...">
        @error('password_confirmation')
            <div style="color: red;">
                {{ $message }}
            </div>
        @enderror


        <!-- Submit -->
        <button type="submit">Cadastrar</button>
    </form>
@endsection
