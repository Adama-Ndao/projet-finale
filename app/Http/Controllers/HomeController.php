<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $role = Auth::user()->role;


        if ($role == 1) {
            $users = User::where('role', '=', 2)->get();
            // Récupération des projets correspondant à l'id utilisateur et à l'état 2
            $projetencours = Projet::where('etat', 2)
                ->get();

            $projets_termines = Projet::where('etat', 3)
                ->get();
            $projets = Projet::all();

            $nbr_projets=count($projets);
            $nbr_projetencours=count($projetencours);
            $nbr_projetstermines=count($projets_termines);
            $nbr_users=count($users);

            return view('wp-admin/admin', compact('nbr_projets', 'nbr_projetencours', 'nbr_projetstermines', 'nbr_users'));
        }

        if ($role == 2) {
            // Récupération de l'id de l'utilisateur connecté
            $userId = Auth::id();

            // Récupération des projets correspondant à l'id utilisateur et à l'état 2
            $projetencours = Projet::where('user_id', $userId)
                ->where('etat', 2)
                ->get();

            $projets_termines = Projet::where('user_id', $userId)
                ->where('etat', 3)
                ->get();
            return view('dashboard', compact('projetencours', 'projets_termines'));
        }
    }
}
