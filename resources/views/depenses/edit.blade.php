@extends('adminlte::page')

@section('title', 'Modifier une dépense')

@section('content_header')
    <h1>Modifier une dépense</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('depenses.update', $depense->id_depense) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="libelle">Libellé</label>
                            <input type="text" name="libelle" id="libelle" class="form-control" required value="{{ old('libelle', $depense->libelle) }}">
                        </div>
                        <div class="form-group">
                            <label for="montant">Montant</label>
                            <input type="number" step="1" name="montant" id="montant" class="form-control" required value="{{ old('montant', $depense->montant) }}">
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="datetime-local" name="date" id="date" class="form-control" required value="{{ old('date', $depense->date) }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <a href="{{ route('depenses.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop 