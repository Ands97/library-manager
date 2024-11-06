@extends('adminlte::page')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Listagem de Livros</h1>

    <form method="GET" action="{{ route('books.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Buscar por título ou autor" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <input type="number" name="publication_year" class="form-control" placeholder="Ano de Publicação" value="{{ request('publication_year') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Limpar</a>
            </div>
        </div>
    </form>

    @if($books->isEmpty())
        <div class="alert alert-warning" role="alert">
            Nenhum livro encontrado.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Ano de Publicação</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publication_year }}</td>
                        <td>
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $book->id }}, '{{ $book->title }}')">
                                <i class="fas fa-trash-alt"></i> Deletar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $books->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<script>
    function confirmDelete(bookId, bookTitle) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Você está prestes a excluir o livro: " + bookTitle,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ url('books') }}/" + bookId;
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = "{{ csrf_token() }}";

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
