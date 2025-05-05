@extends('Layouts.app')
@section('title', 'Ajouter un diplôme')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary text-center">Ajouter un  stage</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="fonction" class="form-label">Fonction</label>
            <input type="text" name="fonction" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="periode" class="form-label">Période</label>
            <input type="text" name="periode" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="attestation" class="form-label">Attestation (PDF, JPG, PNG)</label>
            <input type="file" name="attestation" class="form-control">
        </div>

        <div class="mb-3">
            <label for="etablissement" class="form-label">Établissement</label>
            <input type="text" name="etablissement" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="secteur_activite" class="form-label">Secteur d'activité</label>
            <input type="text" name="secteur_activite" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="discription" class="form-label">Description</label>
            <textarea name="discription" class="form-control" rows="3" required></textarea>
        </div>

        <div class="col-md-6 mb-3">
            <label>Candidat</label>
            <select name="candidat_id" class="form-select" required>
                <option value="">-- Choisir un candidat --</option>
                @foreach ($candidats as $candidat)
                    <option value="{{ $candidat->id }}">{{ $candidat->nom }} {{ $candidat->prenom }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary px-5">Enregistrer</button>
        <a href="{{ route('stages.index') }}" class="btn btn-secondary px-5">Annuler</a>
    </div>    </form>
</div>
@endsection
