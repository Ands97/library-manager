@extends('adminlte::page')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Adicionar novo livro</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('books.store') }}" method="POST" class="bg-light p-4 rounded shadow">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="form-control" placeholder="Insira o título do livro">
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Autor</label>
            <input type="text" id="author" name="author" value="{{ old('author') }}" required class="form-control" placeholder="Insira o nome do autor">
        </div>

        <div class="mb-3">
            <label for="publication_year" class="form-label">Ano de Publicação</label>
            <input type="number" id="publication_year" name="publication_year" value="{{ old('publication_year') }}" required class="form-control" placeholder="Insira o ano de publicação">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Insira uma breve descrição do livro">{{ old('description') }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary w-100">Adicionar Livro</button>
    </form>
</div>
@endsection