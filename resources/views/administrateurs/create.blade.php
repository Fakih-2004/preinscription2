@extends('Layouts.app')
@section('title', 'Ajouter un administrateur')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 text-success fw-bold">Ajouter un nouvel administrateur</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('administrateurs.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom" required>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Entrez le prénom" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="exemple@email.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4">Enregistrer</button>
                    <a href="{{ route('administrateurs.index') }}" class="btn btn-secondary ms-2">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
