<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salaire;
use Illuminate\Support\Facades\Auth;

class SalaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $salaires = Salaire::with('user')
                ->orderBy('date_credit', 'desc')
                ->get();
        } else {
            $salaires = Salaire::where('user_id', auth()->id())
                ->with('user')
                ->orderBy('date_credit', 'desc')
                ->get();
        }
        return view('salaires.index', compact('salaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salaires.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0',
            'date_credit' => 'required|date',
        ]);
        $salaire = new Salaire();
        $salaire->montant = $validated['montant'];
        $salaire->date_credit = $validated['date_credit'];
        $salaire->user_id = Auth::id();
        $salaire->save();
        return redirect()->route('salaires.index')->with('success', 'Salaire ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salaire $salaire)
    {
        return view('salaires.show', compact('salaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salaire $salaire)
    {
        return view('salaires.edit', compact('salaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salaire $salaire)
    {
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0',
            'date_credit' => 'required|date',
        ]);

        $salaire->update($validated);

        return redirect()->route('salaires.index')->with('success', 'Salaire mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salaire $salaire)
    {
        $salaire->delete();
        return redirect()->route('salaires.index')->with('success', 'Salaire supprimé avec succès.');
    }
}
