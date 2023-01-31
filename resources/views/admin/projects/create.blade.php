@extends('layouts.admin')

@section('content')
    <section class="container">
        <h1 class="text-center">Aggiungi Progetto:</h1>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titolo*</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}" placeholder="Inserisci il Titolo">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione*</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="10" placeholder="Inserisci Descrizione">{{ old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="thumb" class="form-label">Scegli immagine</label>
                <img id="output" width="100" class="d-block my-3" />
                <input type="file" class="form-control @error('thumb') is-invalid @enderror" id="thumb"
                    name="thumb" value="{{ old('thumb') }}" placeholder="Inserisci il Titolo" onchange="loadFile(event)">
                <script>
                    const loadFile = function(event) {
                        const output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                            URL.revokeObjectURL(output.src) // free memory
                        }
                    };
                </script>
                @error('thumb')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type_id" class="form-label">Seleziona tipologia</label>
                <select type="file" class="form-select @error('type_id') is-invalid @enderror" id="type_id"
                    name="type_id">
                    <option value="">Nessuna Tipologia</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </section>
@endsection
