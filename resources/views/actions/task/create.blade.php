@extends('master')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">Voltar</a>
        </div>
        <div class="card-body">
            {{-- Modal para exibição de erros --}}
            @if ($errors->any())
                <div class="modal fade show" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
                    aria-hidden="true" style="display: block; background: rgba(0, 0, 0, 0.5);">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="errorModalLabel"><i class="bi bi-x-circle"></i> Erros de
                                    Validação</h5> <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Formulario --}}
            <form action="{{ route('tasks.store') }}" method="post" class="row g-3">

                @csrf
                {{-- Titulo --}}
                <div class="col-md-12">
                    <label for="title" class="form-label">Título da tarefa:</label>
                    <input type="text" name="title" placeholder="Título..." value="{{ old('title') }}"
                        class="form-control">
                </div>

                {{-- Descrição --}}
                <div class="col-md-12">
                    <label for="description" class="form-label">Descrição da tarefa:</label>
                    <textarea name="description" placeholder="Descrição..." class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                {{-- Data Limite --}}
                <div class="col-md-4">
                    <label for="due_date" class="form-label">Data limite de encerramento:</label>
                    <input type="date" name="due_date" value="{{ old('due_date') }}" class="form-control">
                </div>

                {{-- Status --}}
                <div class="col-md-4">
                    <label for="status" class="form-label">Status da tarefa:</label>
                    <select name="status_id" id="status" class="form-select">
                        <option value="">Selecione</option>
                        @forelse ($statusTasks as $status)
                            <option value="{{ $status->id }} {{ old('status_id') == $status->id ? 'selected' : '' }}">
                                {{ $status->name }}</option>
                        @empty
                            <option value="">Nenhuma situação de status encontrada</option>
                        @endforelse
                    </select>
                </div>

                {{-- Categoria --}}
                <div class="col-md-4">
                    <label for="category" class="form-label">Escolha a categoria:</label>
                    <select name="category_id" id="category" class="form-select">
                        <option value="">Selecione</option>
                        @forelse ($categories as $category)
                            <option
                                value="{{ $category->id }} {{ old('category_id') == $category->id ? 'selected' : '' }}">
                                {{ $category->name }}</option>
                        @empty
                            <option value="">Nenhuma categoria encontrada</option>
                        @endforelse
                    </select>
                </div>

                {{-- Botão --}}
                <div class="col-12">
                    <button type="submit" class="btn btn-success btn-sm">Criar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
