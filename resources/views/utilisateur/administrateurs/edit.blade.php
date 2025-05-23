@extends('utilisateur.Layouts.app')
@section('title', 'Modifier utilisateur') <!-- Changed title -->

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="border-radius-lg pt-4 pb-3" style="background: #1a4b8c; background: linear-gradient(195deg, #1a4b8c 0%, #12315f 100%);">
                        <h6 class="text-white text-capitalize ps-3">Modifier l'utilisateur</h6> <!-- Changed heading -->
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <form action="{{ route('administrateurs.update', $user->id) }}" method="POST"> <!-- Changed route and variable -->
                        @csrf
                        @method('PUT')

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Nom et Prénom</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required> <!-- Changed variable -->
                        </div>
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required> <!-- Changed variable -->
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Mot de passe (laisser vide si inchangé)</label>
                            <input type="password" name="password" class="form-control" placeholder="Nouveau mot de passe">
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg text-white" style="background-color: #1a4b8c;">
                                <i class="material-symbols-rounded me-1">save</i> Mettre à jour
                            </button>
                            <a href="{{ route('administrateurs.index') }}" class="btn btn-outline-secondary btn-lg ms-2"> <!-- Changed route -->
                                <i class="material-symbols-rounded me-1">cancel</i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Style for the input fields when focused */
    .input-group.input-group-outline:not(.is-filled) .form-label {
        color: #1a4b8c;
    }
    .input-group.input-group-outline.is-filled .form-label,
    .input-group.input-group-outline.is-focused .form-label {
        color: #1a4b8c;
    }
    .input-group.input-group-outline .form-control:focus {
        border-color: #1a4b8c;
        box-shadow: 0 0 0 2px rgba(26, 75, 140, 0.2);
    }
    
    /* Button hover effects */
    .btn[style*="#1a4b8c"]:hover {
        background-color: #0d3a73 !important;
    }
    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection