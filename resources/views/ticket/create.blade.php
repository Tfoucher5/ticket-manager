@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4">Créer un nouveau ticket</h1>

        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf

            <!-- Affichage des erreurs -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input
                    type="text"
                    id="titre"
                    name="titre"
                    value="{{ old('titre') }}"
                    class="form-control @error('titre') is-invalid @enderror"
                    required>
                @error('titre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="categorie_id" class="form-label">Catégorie</label>
                <select
                    id="categorie_id"
                    name="categorie_id"
                    class="form-select @error('categorie_id') is-invalid @enderror"
                    required>
                    @foreach($categories as $categorie)
                        <option
                            value="{{ $categorie->id }}"
                            {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->libelle }}
                        </option>
                    @endforeach
                </select>
                @error('categorie_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="priorite_id" class="form-label">Priorité</label>
                <select
                    id="priorite_id"
                    name="priorite_id"
                    class="form-select @error('priorite_id') is-invalid @enderror"
                    required>
                    @foreach($priorites as $priorite)
                        <option
                            value="{{ $priorite->id }}"
                            {{ old('priorite_id') == $priorite->id ? 'selected' : '' }}>
                            {{ $priorite->libelle }}
                        </option>
                    @endforeach
                </select>
                @error('priorite_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button
                type="submit"
                class="btn btn-primary w-100">
                Créer le ticket
            </button>
        </form>
    </div>
@endsection
