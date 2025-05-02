@extends('adminlte::page')

@section('title', 'Ajouter une dépense')

@section('content_header')
    <h1>Ajouter une dépense</h1>
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
                    <form action="{{ route('depenses.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="libelle">Libellé</label>
                            <input type="text" name="libelle" id="libelle" class="form-control" required value="{{ old('libelle') }}">
                        </div>
                        <div class="form-group">
                            <label for="montant">Montant</label>
                            <input type="number" step="1" name="montant" id="montant" class="form-control" required value="{{ old('montant') }}">
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="datetime-local" name="date" id="date" class="form-control" required value="{{ old('date') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        <a href="{{ route('depenses.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop 