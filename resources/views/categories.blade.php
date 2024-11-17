<div class="container mt-4">
    @if (session()->has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label=" Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            {{ $category->created_at->subHours(3)->format('d/m/Y H:i') }}</h6>
                        <p class="card-text">{{ $category->description }}</p>
                        <a href="{{ route('tasks.index', $category->id) }}" class="btn btn-secondary btn-sm">Visualizar
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
</div>
