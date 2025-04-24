@extends('Layouts.app')
@section('title', 'Modifier administrateur')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary fw-bold">Modifier l’administrateur</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('administrateurs.update', $administrateur->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ $administrateur->nom }}" required>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $administrateur->prenom }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $administrateur->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe (laisser vide si inchangé)</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Nouveau mot de passe">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">Mettre à jour</button>
                    <a href="{{ route('administrateurs.index') }}" class="btn btn-secondary ms-2">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
