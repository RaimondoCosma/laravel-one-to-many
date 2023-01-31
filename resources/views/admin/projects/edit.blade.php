@extends('layouts.admin')

@section('content')
    <section class="container">
        <h1 class="text-center">Modifica: {{ $project->title }}</h1>
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titolo*</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $project->title) }}" placeholder="Inserisci il Titolo">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione*</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="10" placeholder="Inserisci Descrizione">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="thumb" class="form-label">Scegli immagine</label>
                @if ($project->thumb)
                    {{-- Checkbox per abilitare o disabilitare le immagini --}}
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="no_thumb" name="no_thumb">
                        <label class="form-check-label" for="no_thumb" id="text-no_thumb">Disabilita Immagine</label>
                    </div>
                    {{-- /Checkbox per abilitare o disabilitare le immagini --}}
                @endif
                <img id="output" width="100" class="d-block my-3"
                    @if ($project->thumb) src="{{ asset("storage/$project->thumb") }}" @endif />
                <input type="file" class="form-control @error('thumb') is-invalid @enderror" id="thumb"
                    name="thumb" value="{{ old('thumb') }}" placeholder="Inserisci il Titolo" onchange="loadFile(event)">
                <script>
                    const noThumb = document.getElementById('no_thumb');
                    const inputThumb = document.getElementById('thumb');
                    // let textNoThumb = document.getElementById('text-no_thumb').innerHTML;
                    noThumb.addEventListener('change', function() {
                        if (noThumb.checked) {
                            inputThumb.disabled = true;
                            // textNoThumb = 'Abilita Immagine!';
                        } else {
                            inputThumb.disabled = false;
                            // textNoThumb = 'Disabilita Immagine!';
                        }
                    });
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
                        <option value="{{ $type->id }}"
                            {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </section>
@endsection
