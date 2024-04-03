@extends('layouts.app')

@section('content')
    <main class="container py-3">

        <h1>Modify a project</h1>

        <form action="{{ route('dashboard.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input
                    type="text"
                    class="form-control
                        @error('name')
                            is-invalid
                        @enderror"
                    name='name'
                    id="name"
                    value="{{ old('name', $project->name) }}"
                />
                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
            </div>

            <div class="mb-3">
                <label for="owner" class="form-label">Owner</label>
                <input
                    type="text"
                    class="form-control"
                    name='owner'
                    id="owner"
                    value="{{ old('owner', $project->owner) }}"
                />
            </div>

            <div class="mt-3">
                @if($project->cover_image)
                    <img src="{{ asset('/storage/' . $project->cover_image) }}" alt="" style="width: 400px">
                @endif

                <div class="mt-3 mb-3">
                    <input
                        type="file" 
                        name="cover_image" 
                        id="cover_image" 
                        class="form-control @error('cover_image') is-invalid @enderror">
                </div>
    
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Types</label>
                <select
                    class="
                        form-select
                        form-select-lg
                        @error('type_id') is_invalid @enderror
                        "
                    name="type_id"
                    id="type_id"
                >
                    <option value="">Select one</option>

                    @foreach ($types as $item)
                    <option
                        value="{{ $item->id }}"
                        {{ $item->id == old('type_id', $project->type ? $project->type->id : '') ? 'selected' : '' }}
                        >{{ $item->type }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </main>
@endsection