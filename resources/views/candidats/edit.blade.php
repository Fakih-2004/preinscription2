@extends('Layouts.app')

@section('title', 'Modifier le candidat')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary text-center">Modifier le candidat</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('candidats.update', $candidat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="mb-3">
                <label for="formation_id" class="form-label">Type de formation</label>
                <select name="formation_id" id="formation_id" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    @foreach ($formations as $formation)
                        <option value="{{ $formation->id }}" {{ $candidat->formation_id == $formation->id ? 'selected' : '' }}>
                            {{ ucfirst($formation->type_formation) }}
                        </option>
                    @endforeach
                </select>
            </div>

            @php
                $fields = [
                    ['nom', 'Nom', 'text'],
                    ['prenom', 'Prénom', 'text'],
                    ['nom_ar', 'الاسم العائلي', 'text'],
                    ['prenom_ar', 'الاسم الشخصي', 'text'],
                    ['CNE', 'CNE', 'text'],
                    ['CIN', 'CIN', 'text'],
                    ['email', 'Email', 'email'],
                    ['date_naissance', 'Date de naissance', 'date'],
                    ['ville_naissance', 'Ville naissance', 'text'],
                    ['ville_naissance_ar', 'مدينة الولادة', 'text'],
                    ['province', 'Province', 'text'],
                    ['pay_naissance', 'Pays naissance', 'text'],
                    ['nationalite', 'Nationalité', 'text'],
                    ['telephone_mob', 'Téléphone mobile', 'text'],
                    ['telephone_fix', 'Téléphone fixe', 'text'],
                    ['ville', 'Ville', 'text'],
                    ['pays', 'Pays', 'text'],
                    ['serie_bac', 'Série Bac', 'text'],
                ];
            @endphp

            @foreach ($fields as $field)
                <div class="col-md-6 mb-3">
                    <label>{{ $field[1] }}</label>
                    <input type="{{ $field[2] }}" name="{{ $field[0] }}" class="form-control" value="{{ old($field[0], $candidat->{$field[0]}) }}" required>
                </div>
            @endforeach

            <div class="col-md-6 mb-3">
                <label>Sexe</label>
                <select name="sexe" class="form-control" required>
                    <option value="M" {{ $candidat->sexe == 'M' ? 'selected' : '' }}>Masculin</option>
                    <option value="F" {{ $candidat->sexe == 'F' ? 'selected' : '' }}>Féminin</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Adresse</label>
                <textarea name="adresse" class="form-control" rows="2" required>{{ old('adresse', $candidat->adresse) }}</textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>CV (PDF)</label>
                <input type="file" name="cv" class="form-control" accept="application/pdf">
            </div>

            <div class="col-md-6 mb-3">
                <label>Demande (PDF)</label>
                <input type="file" name="demande" class="form-control" accept="application/pdf">
            </div>

            <div class="col-md-6 mb-3">
                <label>Carte d'identité (scan)</label>
                <input type="file" name="scan_cartid" class="form-control" accept="application/pdf,image/*">
            </div>

            <div class="col-md-6 mb-3">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>

            <div class="col-md-6 mb-3">
                <label>Année Bac</label>
                <select name="annee_bac" id="annee_bac" class="form-control">
                    <option value="">année bac</option>
                    @for ($i = now()->year; $i >= 2000; $i--)
                        @php $annee = ($i-1) . '/' . $i; @endphp
                        <option value="{{ $annee }}" {{ $candidat->annee_bac == $annee ? 'selected' : '' }}>{{ $annee }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Scan Bac</label>
                <input type="file" name="scan_bac" class="form-control" accept="application/pdf,image/*">
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success px-5">Modifier</button>
            <a href="{{ route('candidats.index') }}" class="btn btn-secondary px-5">Annuler</a>
        </div>
    </form>
</div>
@endsection
