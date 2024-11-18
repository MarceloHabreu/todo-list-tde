@extends('master')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Detalhes da Tarefa</h4>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-sm">Voltar</a>
            </div>
            <div class="card-body">
                {{-- Mensagens de feedback --}}
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

                {{-- Informações da Tarefa --}}
                <h5 class="card-title">{{ $task->title }}</h5>
                <p class="card-text"><strong>Descrição:</strong> {{ $task->description }}</p>
                <p class="card-text"><strong>Data de criação:</strong>
                    {{ $task->created_at->subHours(3)->format('d/m/Y') }} às
                    {{ $task->created_at->subHours(3)->format('H:i') }}
                </p>
                <p class="card-text"><strong>Data de atualização:</strong>
                    {{ $task->updated_at->subHours(3)->format('d/m/Y') }} às
                    {{ $task->updated_at->subHours(3)->format('H:i') }}
                </p>
                <p class="card-text"><strong>Data de encerramento:</strong>
                    {{ $task->due_date->format('d/m/Y') }}
                </p>
                <p class="card-text">
                    <strong>Status:</strong>
                    <a href="{{ route('task.change-situation', ['task' => $task->id]) }}">
                        <span class="badge bg-{{ $task->status->color }}">
                            {{ $task->status->name }}
                        </span>
                    </a>
                </p>
                <p class="card-text"><strong>Categoria:</strong> {{ $task->category->name }}</p>

                {{-- Botões de Ação --}}
                <div class="mt-4">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Editar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
