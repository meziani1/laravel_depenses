@extends('adminlte::page')

@section('title', 'Détails de la dépense')

@section('content_header')
    <h1>Détails de la dépense</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $depense->id_depense }}</td>
                        </tr>
                        <tr>
                            <th>Montant</th>
                            <td>{{ number_format($depense->montant, 2) }} €</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ $depense->date_depense }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $depense->description }}</td>
                        </tr>
                        <tr>
                            <th>Créée par</th>
                            <td>{{ $depense->user->name }}</td>
                        </tr>
                    </table>
                    <div class="mt-3">
                        <a href="{{ route('depenses.edit', $depense->id_depense) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('depenses.destroy', $depense->id_depense) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette dépense ?')">Supprimer</button>
                        </form>
                        <a href="{{ route('depenses.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop 