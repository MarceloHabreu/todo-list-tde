@extends('master')

@section('content')
    <div>
        <h2>Lista de Tarefas:</h2>
        <ul>
            @foreach ($tasks as $task)
                <li>Título: {{ $task->title }}</li>
                <li>Descrição: {{ $task->description }}</li>
                <li>Data de encerramento: {{ $task->due_date }}</li>
                <li>Status: {{ $task->status }}</li>
                <li>Categoria: {{ $task->category_name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
