@extends('adminlte::page')

@section('title', 'Liste des dépenses')

@section('content_header')
    <h1>Liste des dépenses</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('depenses.create') }}" class="btn btn-primary">Ajouter une dépense</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Libellé</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($depenses as $depense)
                        <tr>
                            <td>{{ $depense->id_depense }}</td>
                            <td>{{ $depense->libelle }}</td>
                            <td>{{ number_format($depense->montant, 0) }} €</td>
                            <td>{{ $depense->date }}</td>
                            <td>
                                <a href="{{ route('depenses.edit', $depense->id_depense) }}" class="btn btn-sm btn-primary">Modifier</a>
                                <form action="{{ route('depenses.destroy', $depense->id_depense) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette dépense ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop 