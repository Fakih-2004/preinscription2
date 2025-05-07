@extends('utilisateur.Layouts.app')

@section('title', 'Ajouter un diplôme')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary text-center">Ajouter un nouveau diplôme</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('diplomes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Type de diplôme Bac+2</label>
                <input type="text" name="type_diplome_bac+2" class="form-control" placeholder="Entrez le type de diplôme Bac+2" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Année Bac+2</label>
                <input type="date" name="anne_bac+2" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Filère Bac+2</label>
                <input type="text" name="filiere_bac+2" class="form-control" placeholder="Entrez la filière Bac+2" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Scan Bac+2</label>
                <input type="file" name="scan_bac+2" class="form-control" accept="application/pdf,image/*" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Établissement Bac+2</label>
                <input type="text" name="etalissement_bac+2" class="form-control" placeholder="Entrez l'établissement Bac+2" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Type de diplôme Bac+3</label>
                <input type="text" name="type_bac+3" class="form-control" placeholder="Entrez le type de diplôme Bac+3" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Année Bac+3</label>
                <input type="date" name="annee_bac+3" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Filère Bac+3</label>
                <input type="text" name="filiere_bac+3" class="form-control" placeholder="Entrez la filière Bac+3" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Établissement Bac+3</label>
                <input type="text" name="etablissement_bac+3" class="form-control" placeholder="Entrez l'établissement Bac+3" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Scan Bac+3</label>
                <input type="file" name="scan_bac+3" class="form-control" accept="application/pdf,image/*" required>
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
            <a href="{{ route('diplomes.index') }}" class="btn btn-secondary px-5">Annuler</a>
        </div>
    </form>
</div>
@endsection
