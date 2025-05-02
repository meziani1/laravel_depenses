@extends('adminlte::page')

@section('title', 'Modifier le profil')

@section('content_header')
    <h1>Modifier le profil</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-4">
                            <img src="{{ auth()->user()->profile_image_url }}" 
                                 class="profile-user-img img-fluid img-circle"
                                 alt="Photo de profil"
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        </div>

                        <div class="form-group">
                            <label for="profile_image">Photo de profil</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" 
                                           class="custom-file-input @error('profile_image') is-invalid @enderror" 
                                           id="profile_image" 
                                           name="profile_image"
                                           accept="image/*">
                                    <label class="custom-file-label" for="profile_image">Choisir une image</label>
                                </div>
                            </div>
                            @error('profile_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Mettre à jour
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        // Afficher le nom du fichier sélectionné
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>
@stop 