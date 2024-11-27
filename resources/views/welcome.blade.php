@extends('layouts.app')

@section('content')
<div class="container-fluid bg-light py-5">
    <!-- En-tête de la page -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 font-weight-bold text-primary">Gestion des Tickets</h1>
            <p class="lead text-muted">Suivez et gérez vos tickets efficacement.</p>
        </div>
    </div>

    <!-- Résumé des tickets -->
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">Tickets Résolus</h5>
                    <p class="card-text">Le nombre total de tickets résolus. Gardez une trace de vos succès !</p>
                    <h3 class="display-4 font-weight-bold">{{ $resolvedTickets }}</h3>
                    <a href="{{ route('tickets.index') }}" class="btn btn-success mt-3">Voir les tickets résolus</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning">Tickets En Cours</h5>
                    <p class="card-text">Le nombre total de tickets en attente de résolution.</p>
                    <h3 class="display-4 font-weight-bold">{{ $pendingTickets }}</h3>
                    <a href="{{ route('tickets.index') }}" class="btn btn-warning mt-3">Voir les tickets en cours</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger">Tickets Annulés</h5>
                    <p class="card-text">Le nombre total de tickets annulés ou fermés prématurément.</p>
                    <h3 class="display-4 font-weight-bold">{{ $cancelledTickets }}</h3>
                    <a href="{{ route('tickets.index') }}" class="btn btn-danger mt-3">Voir les tickets annulés</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Actions principales -->
    <div class="row text-center justify-center mt-5">
        <div class="col-12">
            <h2 class="font-weight-bold mb-4">Quelles actions voulez-vous effectuer ?</h2>
        </div>
        <div class="col-md-4 mb-4">
            <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-lg w-100">
                <i class="fas fa-plus-circle"></i> Créer un Nouveau Ticket
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="{{ route('tickets.index') }}" class="btn btn-secondary btn-lg w-100">
                <i class="fas fa-list"></i> Voir Tous les Tickets
            </a>
        </div>
    </div>

    <!-- Section Derniers Tickets -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="font-weight-bold mb-4 text-center">Derniers Tickets</h2>
        </div>
        @foreach($recentTickets as $ticket)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">{{ $ticket->titre }}</h5>
                        <p class="card-text">{{ Str::limit($ticket->description, 100) }}</p>
                        <span class="badge {{ $ticket->statut == 'Résolu' ? 'bg-success' : 'bg-warning' }}">{{ $ticket->statut }}</span>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-outline-primary btn-sm mt-3">Voir le Ticket</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
