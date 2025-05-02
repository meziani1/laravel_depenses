@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tableau de bord</h1>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col-md-4">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="form-inline">
                <div class="form-group">
                    <label for="month" class="mr-2">Filtrer par mois :</label>
                    <select name="month" id="month" class="form-control" onchange="this.form.submit()">
                        @foreach($months as $value => $label)
                            <option value="{{ $value }}" {{ $selectedMonth == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ number_format($salaires->sum('montant'), 0) }} €</h3>
                    <p>Total des salaires</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="{{ route('salaires.index') }}" class="small-box-footer">
                    Voir les salaires <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ number_format($depenses->sum('montant'), 0) }} €</h3>
                    <p>Total des dépenses</p>
                </div>
                <div class="icon">
                    <i class="fas fa-receipt"></i>
                </div>
                <a href="{{ route('depenses.index') }}" class="small-box-footer">
                    Voir les dépenses <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ number_format($salaires->sum('montant') - $depenses->sum('montant'), 0) }} €</h3>
                    <p>Épargne</p>
                </div>
                <div class="icon">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Voir le détail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2>Mes salaires récents</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Montant</th>
                        <th>Date de crédit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salaires->take(5) as $salaire)
                        <tr>
                            <td>{{ $salaire->id_salaire }}</td>
                            <td>{{ number_format($salaire->montant, 0) }} €</td>
                            <td>{{ $salaire->date_credit }}</td>
                            <td>
                                <a href="{{ route('salaires.edit', $salaire->id_salaire) }}" class="btn btn-sm btn-info" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('salaires.destroy', $salaire->id_salaire) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce salaire ?')" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Aucun salaire trouvé pour ce mois.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2>Mes dépenses récentes</h2>
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
                    @forelse($depenses->take(5) as $depense)
                        <tr>
                            <td>{{ $depense->id_depense }}</td>
                            <td>{{ $depense->libelle }}</td>
                            <td>{{ number_format($depense->montant, 0) }} €</td>
                            <td>{{ $depense->date }}</td>
                            <td>
                                <a href="{{ route('depenses.edit', $depense->id_depense) }}" class="btn btn-sm btn-info" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('depenses.destroy', $depense->id_depense) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette dépense ?')" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Aucune dépense trouvée pour ce mois.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop 