@extends('layouts.app')

@section('content')
    <main class="container py-3">
        <h1>Show del singolo progetto</h1>
        <h3>{{ $project->name }}</h3>

        <p>Owner: {{ $project->owner }}</p>

        @if ($project->cover_image)
            <img src="{{asset('/storage/' . $project->cover_image) }}" alt="" style="width: 400px">
        @endif

        <p>
            <strong>
                {{ $project->type ? $project->type->type : 'Nessun tipo inserito' }}
            </strong>
        </p>
    </main>
@endsection