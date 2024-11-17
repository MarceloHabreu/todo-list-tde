@extends('master') @section('content')
    <a href="{{ route('home') }}">Voltar</a>
    <div>
        <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <label for="name">Nome da Categoria:</label>
            <input type="text" name="name" value="{{ $category->name }}">
            <label for="name">Descrição da categoria:</label>
            <input type="text" name="description" value="{{ $category->description }}">
            <button type="submit">Atualizar</button>
        </form>
    </div>
@endsection
