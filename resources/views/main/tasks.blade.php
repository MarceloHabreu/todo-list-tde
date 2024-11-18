@extends('master')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">Voltar</a>
        </div>
        @if (session()->has('successfully'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('successfully') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="container mt-4">
            <h2>Lista de Todas as Tarefas desta Categoria:</h2>
            @if ($tasks->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Nenhuma tarefa encontrada.
                </div>
            @else
                <div class="row">
                    @foreach ($tasks as $task)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $task->title }}</h5>
                                    <p class="card-text">{{ $task->description }}</p>
                                    <p class="card-text">Data de criação:
                                        {{ $task->created_at->format('d/m/Y') }} às
                                        {{ $task->created_at->subHours(3)->format('H:i') }}</p>
                                    <p class="card-text">Data de encerramento:
                                        {{ $task->due_date->format('d/m/Y') }}</p>
                                    <p class="card-text">Status:
                                        <a href="{{ route('task.change-situation', ['task' => $task->id]) }}">
                                            <span
                                                class="badge bg-{{ $task->status->color }}">{{ $task->status->name }}</span>
                                        </a>
                                    </p>
                                    <a href="{{ route('tasks.show', $task->id) }}"
                                        class="btn btn-secondary btn-sm">Visualizar</a>
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                        class="btn btn-primary btn-sm">Editar</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')"
                                            type="submit" class="btn btn-danger btn-sm">Remover</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
