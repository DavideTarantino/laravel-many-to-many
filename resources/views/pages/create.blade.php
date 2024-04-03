@extends('layouts.app')

@section('content')
    <main class="container py-3">

        <h1>Create a new project</h1>

        <form action="{{ route('dashboard.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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
                    aria-describedby="helpId"
                    placeholder=""
                />
            </div>

            <div class="mb-3">
                <input
                    type="file" 
                    name="cover_image" 
                    id="cover_image" 
                    class="form-control @error('cover_image') is-invalid @enderror">
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
                    <option  value="{{ $item->id }}"
                        {{ $item->id == old('tipe_id') ? 'selected' : '' }}
                        >{{ $item->type }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tecnologies" class="form-label">Select Tecnology</label>

                <select
                    multiple

                    class="form-select form-select-lg"
                    name="tecnologies[]"
                    id="tecnologies"
                >
                    <option value="">Select one</option>

                    @forelse ($tecnologies as $item)

                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @empty

                        <option value="">Non e stata dichiarata la tecnologia utilizzata</option>

                    @endforelse

                </select>
            </div>

            <div class="mb-3">
                <label for="creation_date" class="form-label">Creation Date</label>
                <input
                    type="date"
                    class="form-control"
                    name='creation_date'
                    id="creation_date"
                    aria-describedby="helpId"
                    placeholder=""
                />
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>

    </main>
@endsection