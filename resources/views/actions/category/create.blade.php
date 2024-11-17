@extends('master') @section('content')
    <a href="{{ route('home') }}">Voltar</a>
    <div>
        <form action="{{ route('categories.store') }}" method="post">
            @csrf
            <label for="name">Nome da Categoria:</label>
            <input type="text" name="name" placeholder="nome...">
            <label for="description">Descrição da categoria:</label>
            <input type="text" name="description" placeholder="descrição...">
            <button type="submit">Criar</button>
        </form>
    </div>
@endsection
