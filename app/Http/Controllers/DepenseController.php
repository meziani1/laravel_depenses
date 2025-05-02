<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depenses = Depense::where('user_id', auth()->id())
            ->with('user')
            ->orderBy('date', 'desc')
            ->get();
        return view('depenses.index', compact('depenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'date' => 'required|date',
            'montant' => 'required|numeric|min:0',
        ]);
        $depense = new Depense();
        $depense->libelle = $validated['libelle'];
        $depense->date = $validated['date'];
        $depense->montant = $validated['montant'];
        $depense->user_id = Auth::id();
        $depense->save();
        return redirect()->route('admin.dashboard')->with('success', 'Dépense ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $depense = Depense::findOrFail($id);
        return view('depenses.show', compact('depense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_depense)
    {
        $depense = Depense::findOrFail($id_depense);
        return view('depenses.edit', compact('depense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_depense)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'date' => 'required|date',
            'montant' => 'required|numeric|min:0',
        ]);

        $depense = Depense::findOrFail($id_depense);
        $depense->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Dépense mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_depense)
    {
        $depense = Depense::findOrFail($id_depense);
        $depense->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Dépense supprimée avec succès.');
    }
} 