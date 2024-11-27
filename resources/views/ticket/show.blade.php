@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Colonne de gauche -->
            <div class="col-md-8">
                <!-- Bouton Retour -->
                <div class="mb-3">
                    <a href="{{ route('tickets.index') }}" class="btn btn-link d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 0 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
                        </svg>
                        Retour
                    </a>
                </div>

                <!-- Informations du ticket -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">{{ $ticket->titre }}</h2>
                        <p class="card-text"><strong>Description :</strong> {{ $ticket->description }}</p>
                        <p class="card-text">
                            <strong>Statut :</strong>
                            <span class="badge bg-primary">{{ $ticket->statut }}</span>
                        </p>
                        <!-- Boutons d'action -->
                        @if(auth()->user()->isA('client') && $ticket->statut != 'Résolu' && $ticket->statut != 'Annulé')
                            <div class="mt-3">
                                <form action="{{ route('tickets.resolve', $ticket->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Résolu</button>
                                </form>
                                <form action="{{ route('tickets.cancel', $ticket->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Formulaire de commentaire -->
                @if(auth()->check() && $ticket->statut != 'Résolu' && $ticket->statut != 'Annulé')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ajouter un commentaire</h5>
                            <form action="{{ route('commentaires.store', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="contenu" class="form-label">Nouveau commentaire</label>
                                    <textarea id="contenu" name="contenu" rows="4" class="form-control" placeholder="Écrivez votre commentaire ici..."></textarea>
                                    @error('contenu')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="fichier" class="form-label">Joindre un fichier</label>
                                    <input type="file" class="form-control" id="fichier" name="fichier">
                                    @error('fichier')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Ajouter un commentaire</button>
                            </form>

                        </div>
                    </div>
                @endif
            </div>

            <!-- Colonne de droite -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Commentaires</h5>
                        <div class="list-group">
                            @foreach($commentaires as $commentaire)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $commentaire->user->name }}</strong>
                                        <small class="text-muted">{{ $commentaire->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                    <p class="mb-0">{{ $commentaire->contenu }}</p>

                                    <!-- Affichage du fichier si présent -->
                                    @if ($commentaire->fichier_path)
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $commentaire->fichier_path   ) }}" class="btn btn-link" target="_blank">
                                                Voir le fichier joint
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            {{ $commentaires->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
