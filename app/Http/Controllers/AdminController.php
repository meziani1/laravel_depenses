<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Salaire;
use App\Models\Depense;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Récupérer le mois sélectionné ou utiliser le mois actuel
        $selectedMonth = $request->input('month', Carbon::now()->format('Y-m'));

        // Convertir en objet Carbon pour les requêtes
        $startDate = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $selectedMonth)->endOfMonth();

        // Récupérer les salaires du mois sélectionné
        $salaires = Salaire::where('user_id', auth()->id())
            ->whereBetween('date_credit', [$startDate, $endDate])
            ->orderBy('date_credit', 'desc')
            ->get();

        // Récupérer les dépenses du mois sélectionné
        $depenses = Depense::where('user_id', auth()->id())
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc')
            ->get();

        // Générer les options de mois pour le select
        $months = [];
        $currentDate = Carbon::now();
        for ($i = 0; $i < 12; $i++) {
            $date = $currentDate->copy()->subMonths($i);
            $months[$date->format('Y-m')] = $date->format('F Y');
        }
            
        return view('admin.dashboard', compact('salaires', 'depenses', 'months', 'selectedMonth'));
    }
}
