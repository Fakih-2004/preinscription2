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
                    <option value="{{ $formation->id }}">
                        {{ ucfirst($formation->type_formation) }} ({{ $formation->titre }})
                    </option>
                     @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" placeholder="Entrez votre nom" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" placeholder="Entrez votre prénom" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>الاسم العائلي</label>
                <input type="text" name="nom_ar" class="form-control" placeholder="أدخل اسمك العائلي بالعربية" required>
            </div>

            <div class="col-md-6 mb-3">
                <label> الاسم الشخصي</label>
                <input type="text" name="prenom_ar" class="form-control" placeholder="أدخل اسمك الشخصي بالعربية" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>CNE</label>
                <input type="text" name="CNE" class="form-control" placeholder="Entrez votre CNE" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>CIN</label>
                <input type="text" name="CIN" class="form-control" placeholder="Entrez votre CIN" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Entrez votre email" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Ville naissance</label>
                <input type="text" name="ville_naissance" class="form-control" placeholder="Entrez la ville de naissance" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>مدينة الولادة</label>
                <input type="text" name="ville_naissance_ar" class="form-control" placeholder="أدخل مدينة الولادة بالعربية" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Province</label>
                <input type="text" name="province" class="form-control" placeholder="Entrez votre province" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Pays naissance</label>
                <input type="text" name="pay_naissance" class="form-control" placeholder="Entrez votre pays de naissance" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nationalité</label>
                <input type="text" name="nationalite" class="form-control" placeholder="Entrez votre nationalité" required>
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
                <input type="text" name="telephone_mob" class="form-control" placeholder="Entrez votre téléphone mobile" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Téléphone fixe</label>
                <input type="text" name="telephone_fix" class="form-control" placeholder="Entrez votre téléphone fixe">
            </div>

            <div class="col-md-6 mb-3">
                <label>Ville</label>
                <input type="text" name="ville" class="form-control" placeholder="Entrez votre ville" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Pays</label>
                <input type="text" name="pays" class="form-control" placeholder="Entrez votre pays" required>
            </div>

            <div class="col-md-12 mb-3">
                <label>Adresse</label>
                <textarea name="adresse" class="form-control" rows="2" placeholder="Entrez votre adresse" required></textarea>
            </div>

            
            <div class="col-md-6 mb-3">
                <label>CV (PDF)</label>
                <input type="file" name="cv" class="form-control" accept="application/pdf" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Demande (PDF)</label>
                <input type="file" name="demande" class="form-control" accept="application/pdf" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Carte d'identité (scan)</label>
                <input type="file" name="scan_cartid" class="form-control" accept="application/pdf,image/*" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*" required>
            </div>

            
            <div class="col-md-6 mb-3">
                <label>Série Bac</label>
                <input type="text" name="serie_bac" class="form-control" placeholder="Entrez la série du Bac" required>
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
            <a href="{{ route('candidats.index') }}" class="btn btn-secondary px-5">Annuler</a>
        </div>
    </form>
</div>
@endsection
