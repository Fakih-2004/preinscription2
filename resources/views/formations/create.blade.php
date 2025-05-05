@extends('Layouts.app')

@section('title', 'Ajouter une formation')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary text-center">Ajouter une nouvelle formation</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('formations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Type de formation</label>
            <select name="type_formation" class="form-control" required>
                <option value="">Choisir...</option>
                <option value="Licence">Licence</option>
                <option value="Master">Master</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="titre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Date début</label>
            <input type="date" name="date_debut" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date fin</label>
            <input type="date" name="date_fin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Administrateur</label>
            <select name="administrateur_id" class="form-control" required>
                <option value="">Sélectionner un administrateur</option>
                @foreach ($administrateurs as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->prenom }} {{ $admin->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
