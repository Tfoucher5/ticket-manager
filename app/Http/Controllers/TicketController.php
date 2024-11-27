<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Categorie;
use App\Models\Priorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\Notifications\TicketCreated;
use App\Notifications\NewTicket;



class TicketController extends Controller
{
    // Afficher tous les tickets
    public function index()
    {
        if (auth()->user()->isA('admin'))
        {
            $developpeurs = User::whereIs('developpeur')->get();
            $tickets = Ticket::paginate(10);

            return view('ticket.index', compact('tickets', 'developpeurs'));

        } elseif (auth()->user()->isA('developpeur'))
            {
                $tickets = Ticket::where('developpeur_id', auth()->user()->id)->where('statut', 'Assigné')->paginate(20);

                return view('ticket.index', compact('tickets'));

            } elseif (auth()->user()->isA('client'))
                {
                    $tickets = Ticket::orderBy('created_at', 'desc')->paginate(20);

                    return view('ticket.index', compact('tickets'));
                }

        return view('ticket.index', compact('tickets', 'developpeurs'));
    }

    // Afficher la page de création de ticket
    public function create()
    {
        $categories = Categorie::all();
        $priorites = Priorite::all();

        return view('ticket.create', compact('categories', 'priorites'));
    }

    // Sauvegarder un ticket
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
            'priorite_id' => 'required|exists:priorites,id',
        ]);

        // Création d'un nouveau ticket
        $ticket = new Ticket();
        $ticket->titre = $request->titre ?? 'Je suis le titre par défaut';
        $ticket->description = $request->description;
        $ticket->categorie_id = $request->categorie_id;
        $ticket->priorite_id = $request->priorite_id;
        $ticket->statut = 'Ouvert';
        $ticket->user_id = Auth::id();
        $ticket->developpeur_id = null;

        // Sauvegarde dans la base de données
        $ticket->save();

        // Notification à l'administrateur
        $admins = User::whereIs('admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new TicketCreated($ticket));
        }

        // Redirection avec un message de succès
        return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès.');
    }


    // Afficher un ticket spécifique
    public function show(Ticket $ticket)
    {
        $commentaires = $ticket->commentaires()->with('user')->latest()->paginate(6); // 10 par page
        return view('ticket.show', compact('ticket', 'commentaires'));
    }

    // Modifier un ticket (afficher le formulaire de modification)
    public function edit(Ticket $ticket)
    {
        $categories = Categorie::all();
        $priorites = Priorite::all();

        return view('ticket.edit', compact('ticket', 'categories', 'priorites'));
    }

    // Mettre à jour un ticket
    public function update(Request $request, Ticket $ticket)
    {
        // Validation des données
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
            'priorite_id' => 'required|exists:priorites,id',
        ]);

        // Mise à jour du ticket
        $ticket->titre = $request->titre;
        $ticket->description = $request->description;
        $ticket->categorie_id = $request->categorie_id;
        $ticket->priorite_id = $request->priorite_id;
        $ticket->save();

        // Redirection avec message de succès
        return redirect()->route('tickets.index');
    }

    public function assign(Request $request, Ticket $ticket)
    {
        if (auth()->user()->isA('admin'))
        {
            $ticket->developpeur_id = $request->developpeur_id;
            $ticket->statut = 'Assigné';
            $ticket->save();

            $developpeur = User::find($request->developpeur_id);

            $developpeur->notify(new NewTicket($ticket));

            return redirect()->route('tickets.index')->with('success', 'Le développeur a été assigné et notifié.');
        }
    }

    public function resolve(Ticket $ticket)
    {
        // Vérifier les permissions (client)
        if (auth()->user()->isA('client')) {
            $ticket->statut = 'Résolu';
            $ticket->save();

            return redirect()->route('tickets.show', $ticket->id)
                            ->with('success', 'Le ticket a été marqué comme résolu.');
        }

        return redirect()->route('tickets.show', $ticket->id)
                        ->with('error', 'Vous n\'avez pas la permission de résoudre ce ticket.');
    }

    public function cancel(Ticket $ticket)
    {
        // Vérifier les permissions (client)
        if (auth()->user()->isA('client')) {
            $ticket->statut = 'Annulé';
            $ticket->save();

            return redirect()->route('tickets.show', $ticket->id)
                            ->with('success', 'Le ticket a été annulé.');
        }

        return redirect()->route('tickets.show', $ticket->id)
                        ->with('error', 'Vous n\'avez pas la permission d\'annuler ce ticket.');
    }

    public function compteurs()
{
    // Compter le nombre de tickets résolus
    $resolvedTickets = Ticket::where('statut', 'Résolu')->count();

    // Compter le nombre de tickets en cours
    $pendingTickets = Ticket::where('statut', 'Assigné')->count();

    // Compter le nombre de tickets annulés
    $cancelledTickets = Ticket::where('statut', 'Annulé')->count();

    // Récupérer les derniers tickets
    $recentTickets = Ticket::latest()->take(5)->get();

    return view('welcome', compact('resolvedTickets', 'pendingTickets', 'cancelledTickets', 'recentTickets'));
}
}
