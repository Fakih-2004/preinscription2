@extends('Layouts.app')

@section('title', 'Ajouter un candidat')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary text-center">Ajouter un nouveau candidat</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('candidats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="mb-3">
                <label for="formation_id" class="form-label">Type de formation</label>
                <select name="formation_id" id="formation_id" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    @foreach ($formations as $formation)
                        <option value="{{ $formation->id }}">{{ ucfirst($formation->type_formation) }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-6 mb-3">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nom AR</label>
                <input type="text" name="nom_ar" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Prénom AR</label>
                <input type="text" name="prenom_ar" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>CNE</label>
                <input type="text" name="CNE" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>CIN</label>
                <input type="text" name="CIN" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Ville naissance</label>
                <input type="text" name="ville_naissance" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Ville naissance AR</label>
                <input type="text" name="ville_naissance_ar" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Province</label>
                <input type="text" name="province" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Pays naissance</label>
                <input type="text" name="pay_naissance" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nationalité</label>
                <input type="text" name="nationalite" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Sexe</label>
                <select name="sexe" class="form-control" required>
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Téléphone mobile</label>
                <input type="text" name="telephone_mob" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Téléphone fixe</label>
                <input type="text" name="telephone_fix" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Ville</label>
                <input type="text" name="ville" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Pays</label>
                <input type="text" name="pays" class="form-control" required>
            </div>

            <div class="col-md-12 mb-3">
                <label>Adresse</label>
                <textarea name="adresse" class="form-control" rows="2" required></textarea>
            </div>

            {{-- Fichiers --}}
            <div class="col-md-6 mb-3">
                <label>CV (PDF)</label>
                <input type="file" name="cv" class="form-control" accept="application/pdf" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Demande (PDF)</label>
                <input type="file" name="demand" class="form-control" accept="application/pdf" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Carte d'identité (scan)</label>
                <input type="file" name="scan_cartid" class="form-control" accept="application/pdf,image/*" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*" required>
            </div>

            {{-- Bac --}}
            <div class="col-md-6 mb-3">
                <label>Série Bac</label>
                <input type="text" name="serie_bac" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Année Bac</label>


<select name="annee_bac" id="annee_bac" class="form-control">
    <option value="">année bac</option>

    @for ($i = now()->year; $i >= 2000; $i--)
        <option value="{{ ($i-1) . '/' . $i }}">{{ ($i-1) . '/' . $i }}</option>
    @endfor
</select>

               
            </div>

            <div class="col-md-6 mb-3">
                <label>Scan Bac</label>
                <input type="file" name="scan_bac" class="form-control" accept="application/pdf,image/*" required>
            </div>

        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
