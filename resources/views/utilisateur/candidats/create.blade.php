@extends('utilisateur.Layouts.app')

@section('title', 'Ajouter un candidat')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="background: #1a4b8c; background: linear-gradient(195deg, #1a4b8c 0%, #12315f 100%);">
                        <h6 class="text-white text-capitalize ps-3">Ajouter un nouveau candidat</h6>
                    </div>
                </div>
                <div class="card-body px-4 pb-4">
                    @if ($errors->any())
                        <div class="alert alert-danger text-white mb-4" style="border-left: 4px solid #dc3545;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('candidats.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Formation Selection -->
                        <div class="mb-4">
                            <label for="formation_id" class="form-label text-primary fw-bold">Type de formation</label>
                            <select name="formation_id" id="formation_id" class="form-select form-control-lg bg-light border-0 shadow-sm">
                                <option value="">-- Choisir --</option>
                                @foreach ($formations as $formation)
                                <option value="{{ $formation->id }}">
                                    {{ ucfirst($formation->type_formation) }} ({{ $formation->titre }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Personal Information -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="nom" class="form-label text-primary fw-bold">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="prenom" class="form-label text-primary fw-bold">Prénom</label>
                                    <input type="text" name="prenom" id="prenom" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="nom_ar" class="form-label text-primary fw-bold">الاسم العائلي</label>
                                    <input type="text" name="nom_ar" id="nom_ar" class="form-control form-control-lg bg-light border-0 shadow-sm text-end" dir="rtl" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="prenom_ar" class="form-label text-primary fw-bold">الاسم الشخصي</label>
                                    <input type="text" name="prenom_ar" id="prenom_ar" class="form-control form-control-lg bg-light border-0 shadow-sm text-end" dir="rtl" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="CNE" class="form-label text-primary fw-bold">CNE</label>
                                    <input type="text" name="CNE" id="CNE" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="CIN" class="form-label text-primary fw-bold">CIN</label>
                                    <input type="text" name="CIN" id="CIN" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="email" class="form-label text-primary fw-bold">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="date_naissance" class="form-label text-primary fw-bold">Date de naissance</label>
                                    <input type="date" name="date_naissance" id="date_naissance" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="ville_naissance" class="form-label text-primary fw-bold">Ville naissance</label>
                                    <input type="text" name="ville_naissance" id="ville_naissance" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="ville_naissance_ar" class="form-label text-primary fw-bold">مدينة الولادة</label>
                                    <input type="text" name="ville_naissance_ar" id="ville_naissance_ar" class="form-control form-control-lg bg-light border-0 shadow-sm text-end" dir="rtl" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="province" class="form-label text-primary fw-bold">Province</label>
                                    <input type="text" name="province" id="province" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="pay_naissance" class="form-label text-primary fw-bold">Pays naissance</label>
                                    <input type="text" name="pay_naissance" id="pay_naissance" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="nationalite" class="form-label text-primary fw-bold">Nationalité</label>
                                    <input type="text" name="nationalite" id="nationalite" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <label class="form-label text-primary fw-bold">Sexe</label>
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexe" id="sexe_masculin" value="M" checked>
                                            <label class="form-check-label text-dark fw-medium" for="sexe_masculin">Masculin</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexe" id="sexe_feminin" value="F">
                                            <label class="form-check-label text-dark fw-medium" for="sexe_feminin">Féminin</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="row g-3 mt-4">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="telephone_mob" class="form-label text-primary fw-bold">Téléphone mobile</label>
                                    <input type="text" name="telephone_mob" id="telephone_mob" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="telephone_fix" class="form-label text-primary fw-bold">Téléphone fixe</label>
                                    <input type="text" name="telephone_fix" id="telephone_fix" class="form-control form-control-lg bg-light border-0 shadow-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="ville" class="form-label text-primary fw-bold">Ville</label>
                                    <input type="text" name="ville" id="ville" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="pays" class="form-label text-primary fw-bold">Pays</label>
                                    <input type="text" name="pays" id="pays" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <label for="adresse" class="form-label text-primary fw-bold">Adresse</label>
                                    <textarea name="adresse" id="adresse" class="form-control form-control-lg bg-light border-0 shadow-sm" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Documents -->
                        <div class="row g-3 mt-4">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="CV" class="form-label text-primary fw-bold">CV (PDF)</label>
                                    <input type="file" name="CV" id="CV" class="form-control form-control-lg bg-light border-0 shadow-sm" accept="application/pdf" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="demande" class="form-label text-primary fw-bold">Demande (PDF)</label>
                                    <input type="file" name="demande" id="demande" class="form-control form-control-lg bg-light border-0 shadow-sm" accept="application/pdf" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="scan_cartid" class="form-label text-primary fw-bold">Carte d'identité (scan)</label>
                                    <input type="file" name="scan_cartid" id="scan_cartid" class="form-control form-control-lg bg-light border-0 shadow-sm" accept="application/pdf,image/*" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="photo" class="form-label text-primary fw-bold">Photo</label>
                                    <input type="file" name="photo" id="photo" class="form-control form-control-lg bg-light border-0 shadow-sm" accept="image/*" required>
                                </div>
                            </div>
                        </div>

                        <!-- Bac Information -->
                        <div class="row g-3 mt-4">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="serie_bac" class="form-label text-primary fw-bold">Série Bac</label>
                                    <input type="text" name="serie_bac" id="serie_bac" class="form-control form-control-lg bg-light border-0 shadow-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="annee_bac" class="form-label text-primary fw-bold">Année Bac</label>
                                    <select name="annee_bac" id="annee_bac" class="form-select form-control-lg bg-light border-0 shadow-sm">
                                        <option value="">-- Sélectionnez --</option>
                                        @for ($i = now()->year; $i >= 2000; $i--)
                                            <option value="{{ ($i-1) . '/' . $i }}">{{ ($i-1) . '/' . $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="scan_bac" class="form-label text-primary fw-bold">Scan Bac</label>
                                    <input type="file" name="scan_bac" id="scan_bac" class="form-control form-control-lg bg-light border-0 shadow-sm" accept="application/pdf,image/*" required>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-lg text-white" style="background-color: #1a4b8c; padding: 10px 30px; border-radius: 8px; transition: all 0.3s;">
                                <i class="material-symbols-rounded me-2">save</i> Enregistrer
                            </button>
                            <a href="{{ route('candidats.index') }}" class="btn btn-outline-secondary btn-lg ms-3" style="padding: 10px 30px; border-radius: 8px; transition: all 0.3s;">
                                <i class="material-symbols-rounded me-2">cancel</i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                <input type="file" name="CV" class="form-control" accept="application/pdf" required>
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
>>>>>>> c4e73f0 (v)
</div>
@endsection
