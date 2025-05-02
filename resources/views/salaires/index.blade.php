@extends('adminlte::page')

@section('title', 'Liste des salaires')

@section('content_header')
    <h1>Liste des salaires</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('salaires.create') }}" class="btn btn-primary">Ajouter un salaire</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Utilisateur</th>
                                <th>Montant</th>
                                <th>Date de crédit</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salaires as $salaire)
                                <tr>
                                    <td>{{ $salaire->id }}</td>
                                    <td>{{ $salaire->user->name }}</td>
                                    <td>{{ $salaire->montant }}</td>
                                    <td>{{ $salaire->date_credit }}</td>
                                    <td>
                                        <a href="{{ route('salaires.edit', $salaire->id) }}" class="btn btn-sm btn-info" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('salaires.destroy', $salaire->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce salaire ?')" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop 