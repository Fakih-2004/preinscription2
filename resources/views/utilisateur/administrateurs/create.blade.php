@extends('utilisateur.Layouts.app')
@section('title', 'Ajouter un utilisateur') <!-- Changed title -->

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="background: #1a4b8c; background: linear-gradient(195deg, #1a4b8c 0%, #12315f 100%);">
                        <h6 class="text-white text-capitalize ps-3">Ajouter un nouvel utilisateur</h6> <!-- Changed heading -->
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <form action="{{ route('administrateurs.store') }}" method="POST"> <!-- Changed route -->
                        @csrf
                        
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Nom et Prénom</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg text-white" style="background-color: #1a4b8c;">
                                <i class="material-symbols-rounded me-1">save</i> Enregistrer
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
@endsection