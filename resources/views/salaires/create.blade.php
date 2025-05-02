@extends('adminlte::page')

@section('title', 'Ajouter un salaire')

@section('content_header')
    <h1>Ajouter un salaire</h1>
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
                    <form action="{{ route('salaires.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="montant">Montant</label>
                            <input type="number" step="0.01" name="montant" id="montant" class="form-control" required value="{{ old('montant') }}">
                        </div>
                        <div class="form-group">
                            <label for="date_credit">Date de crédit</label>
                            <input type="date" name="date_credit" id="date_credit" class="form-control" required value="{{ old('date_credit') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        <a href="{{ route('salaires.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop 