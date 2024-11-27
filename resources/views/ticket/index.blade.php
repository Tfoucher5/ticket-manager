@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gestion des Tickets</h1>

        <!-- Afficher l'option de création de ticket uniquement pour le client -->
        @if (auth()->user()->isA('client'))
            <div class="text-center mb-4">
                <a href="{{ route('tickets.create') }}" class="btn btn-success btn-lg">
                    + Créer un nouveau ticket
                </a>
            </div>
        @endif

        <!-- Tableau des tickets -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Description</th>
                        <th scope="col">Statut</th>
                        @if (auth()->user()->isA('admin'))
                            <th scope="col">Assignation</th>
                        @endif
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->titre }}</td>
                            <td>{{ Str::limit($ticket->description, 50, '...') }}</td>
                            <td>
                                @if ($ticket->statut === 'Ouvert')
                                    <span class="badge bg-success text-light">Ouvert</span>
                                @elseif ($ticket->statut === 'Assigné')
                                    <span class="badge bg-primary text-light">Assigné</span>
                                @elseif ($ticket->statut === 'Résolu')
                                    <span class="badge bg-secondary text-light">Résolu</span>
                                @elseif ($ticket->statut === 'Annulé')
                                    <span class="badge bg-danger text-light">Annulé</span>
                                @else
                                    <span class="badge bg-warning text-dark">Inconnu</span>
                                @endif
                            </td>

                            @if (auth()->user()->isA('admin'))
                                @if ($ticket->developpeur_id == null)
                                <td>
                                    <form action="{{ route('tickets.assign', $ticket->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="developpeur_id" class="form-select">
                                            <option value="">Sélectionner</option>
                                            @foreach($developpeurs as $developpeur)
                                                <option value="{{ $developpeur->id }}" {{ $ticket->developpeur_id == $developpeur->id ? 'selected' : '' }}>
                                                    {{ $developpeur->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm mt-2">
                                            Assigner
                                        </button>
                                    </form>
                                </td>
                            @else
                                <td>
                                    <p>Assigné</p>
                                </td>
                            @endif
                            @endif

                            <td>
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm mb-1">
                                    Voir les détails
                                </a>
                                @if (auth()->user()->isA('client') && $ticket->statut != 'Résolu' && $ticket->statut != 'Annulé')
                                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">
                                        Modifier
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-6">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
@endsection
