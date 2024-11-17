<div class="container mt-4">
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



    @if ($categories->isEmpty())
        <div class="alert alert-warning" role="alert">
            Adicione uma categoria!
        </div>
    @else
        <div class="row">
            <h2>Todas as categorias: </h2>
            @foreach ($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                Criada em: {{ $category->created_at->subHours(3)->format('d/m/Y \à\s H:i') }}
                            </h6>
                            <p class="card-text">{{ $category->description }}</p>
                            <a href="{{ route('tasks.index.category', ['category' => $category->id]) }}"
                                class="btn btn-secondary btn-sm">Visualizar
                                Tarefas</a>
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Tem certeza que deseja exluir esta categoria juntamente com suas tarefas?')"
                                    type="submit" class="btn btn-danger btn-sm">Remover</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
