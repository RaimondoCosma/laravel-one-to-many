@extends('layouts.admin')

@section('content')
    <section class="container">
        @if ($project->thumb)
            <div class="text-center">
                <img class="w-25" src="{{ asset("storage/$project->thumb") }}" alt="{{ $project->title }}">
            </div>
        @endif
        <h1 class="text-center">{{ $project->title }}</h1>
        <h3 class="mt-4">Descrizione progetto:</h3>
        <p>{{ $project->description }}</p>
        <h3 class="mt-4">Slug del progetto</h3>
        <p>{{ $project->slug }}</p>
    </section>
@endsection
