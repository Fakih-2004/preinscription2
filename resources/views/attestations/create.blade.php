@extends('Layouts.app')

@section('title', 'Ajouter une attestation')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary text-center">Ajouter une attestation</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('attestations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class=" col-md-6 mb-3">
            <label>Type d'attestation</label>
            <input type="text" name="type_attestation" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Description</label>
            <textarea name="discription" class="form-control"  required></textarea>
        </div>

        <div class="col-md-6 mb-3">
            <label>Fichier (PDF, JPG, PNG)</label>
            <input type="file" name="attestation" class="form-control" required>
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

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary px-5">Enregistrer</button>
            <a href="{{ route('attestations.index') }}" class="btn btn-secondary px-5">Annuler</a>
        </div>
    </form>
</div>
@endsection
