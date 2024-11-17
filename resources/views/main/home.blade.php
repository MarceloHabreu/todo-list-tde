@extends('master')

@section('content')
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-md">
            @if (!auth()->check())
                <a href="{{ route('login.index') }}">Login</a>
            @else
                Bem-vindo, {{ auth()->user()->firstname }}! <a href="{{ route('login.destroy') }}">Sair</a>
            @endif
        </div>
    </nav>


    @if ($categories->isEmpty())
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Categorias
                                <a href="{{ route('categories.create') }}" class="btn btn-primary float-end">Criar
                                    Categoria</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Categorias
                                <a href="{{ route('categories.create') }}" class="btn btn-primary float-end">Criar
                                    Categoria</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tarefas
                                <a href="{{ route('tasks.create') }}" class="btn btn-primary float-end">Criar
                                    Tarefa</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('categories')
@endsection
