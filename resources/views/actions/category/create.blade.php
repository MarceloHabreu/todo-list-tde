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

            {{-- Formulário --}}
            <form action="{{ route('categories.store') }}" method="post">
                @csrf

                {{-- Nome da categoria --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nome da Categoria:</label>
                    <input type="text" name="name" placeholder="nome..." value="{{ old('name') }}"
                        class="form-control">
                </div>

                {{-- Descrição --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição da Categoria:</label>
                    <textarea name="description" placeholder="Descrição..." class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                {{-- Botão --}}
                <div class="mb-3">
                    <button type="submit" class="btn btn-success btn-sm">Criar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
