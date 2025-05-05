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
                    <h3 class="card-title">Gestion des salaires</h3>
                    @can('create_salaires')
                        <div class="card-tools">
                            <a href="{{ route('salaires.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Ajouter un salaire
                            </a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Utilisateur</th>
                                <th>Montant</th>
                                <th>Date de crédit</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($salaires as $salaire)
                                <tr>
                                    <td>{{ $salaire->id }}</td>
                                    <td>{{ $salaire->user->name }}</td>
                                    <td>{{ number_format($salaire->montant, 2, ',', ' ') }} €</td>
                                    <td>{{ \Carbon\Carbon::parse($salaire->date_credit)->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('edit_salaires')
                                                <a href="{{ route('salaires.edit', $salaire) }}" class="btn btn-sm btn-info" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('delete_salaires')
                                                <form action="{{ route('salaires.destroy', $salaire) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce salaire ?')" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucun salaire trouvé</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop 