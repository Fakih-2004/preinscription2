@extends('layout.index')

@section('content')
<div class="container inscription-form">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('candidat.submit') }}" method="POST" enctype="multipart/form-data" class="p-4 bg-white shadow rounded">
        @csrf
        <input type="hidden" name="step" value="{{ $step }}">

        <!-- Step 1: Informations Personnelles -->
        @if ($step == 1)
            <h2 class="section-title">Informations Personnelles</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="titre_id">Formation</label>
                    <select name="titre_id" class="form-control" id="titre_id" >
                        <option value="">Sélectionner une formation</option>
                        @foreach ($titres as $titre)
                            <option value="{{ $titre->id }}" {{ old('titre_id', $data['titre_id'] ?? '') == $titre->id ? 'selected' : '' }}>
                                {{ $titre->titre }}
                            </option>
                        @endforeach
                    </select>
                    @error('titre_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" class="form-control" id="nom" placeholder="Entrez votre nom" value="{{ old('nom', $data['nom'] ?? '') }}" >
                    @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Entrez votre prénom" value="{{ old('prenom', $data['prenom'] ?? '') }}" >
                    @error('prenom') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nom_ar">الاسم العائلي بالعربية</label>
                    <input type="text" name="nom_ar" class="form-control" id="nom_ar" placeholder="الاسم العائلي بالعربية" value="{{ old('nom_ar', $data['nom_ar'] ?? '') }}"  dir="rtl">
                    @error('nom_ar') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="prenom_ar">الاسم الشخصي بالعربية</label>
                    <input type="text" name="prenom_ar" class="form-control" id="prenom_ar" placeholder="الاسم الشخصي بالعربية" value="{{ old('prenom_ar', $data['prenom_ar'] ?? '') }}"  dir="rtl">
                    @error('prenom_ar') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="CNE">CNE</label>
                    <input type="text" name="CNE" class="form-control" id="CNE" placeholder="Entrez votre CNE" value="{{ old('CNE', $data['CNE'] ?? '') }}" >
                    @error('CNE') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="CIN">CIN</label>
                    <input type="text" name="CIN" class="form-control" id="CIN" placeholder="Entrez votre CIN" value="{{ old('CIN', $data['CIN'] ?? '') }}" >
                    @error('CIN') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date_naissance">Date de naissance</label>
                    <input type="date" name="date_naissance" class="form-control" id="date_naissance" value="{{ old('date_naissance', $data['date_naissance'] ?? '') }}" >
                    @error('date_naissance') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ville_naissance">Ville de naissance</label>
                    <input type="text" name="ville_naissance" class="form-control" id="ville_naissance" placeholder="Entrez votre ville de naissance" value="{{ old('ville_naissance', $data['ville_naissance'] ?? '') }}" >
                    @error('ville_naissance') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ville_naissance_ar">مدينة الازدياد بالعربية</label>
                    <input type="text" name="ville_naissance_ar" class="form-control" id="ville_naissance_ar" placeholder="مدينة الازدياد بالعربية" value="{{ old('ville_naissance_ar', $data['ville_naissance_ar'] ?? '') }}"  dir="rtl">
                    @error('ville_naissance_ar') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="province">Province</label>
                    <input type="text" name="province" class="form-control" id="province" placeholder="Entrez votre province" value="{{ old('province', $data['province'] ?? '') }}" >
                    @error('province') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pay_naissance">Pays de naissance</label>
                    <input type="text" name="pay_naissance" class="form-control" id="pay_naissance" placeholder="Entrez votre pays de naissance" value="{{ old('pay_naissance', $data['pay_naissance'] ?? '') }}" >
                    @error('pay_naissance') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nationalite">Nationalité</label>
                    <input type="text" name="nationalite" class="form-control" id="nationalite" placeholder="Entrez votre nationalité" value="{{ old('nationalite', $data['nationalite'] ?? '') }}" >
                    @error('nationalite') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="sex">Sexe</label>
                    <select name="sex" class="form-control" id="sex" >
                        <option value="">Sélectionner un sexe</option>
                        <option value="Homme" {{ old('sex', $data['sex'] ?? '') == 'Homme' ? 'selected' : '' }}>Homme</option>
                        <option value="Femme" {{ old('sex', $data['sex'] ?? '') == 'Femme' ? 'selected' : '' }}>Femme</option>
                    </select>
                    @error('sex') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telephone_mob">Téléphone mobile</label>
                    <input type="text" name="telephone_mob" class="form-control" id="telephone_mob" placeholder="Entrez votre téléphone mobile" value="{{ old('telephone_mob', $data['telephone_mob'] ?? '') }}" >
                    @error('telephone_mob') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telephone_fix">Téléphone fixe</label>
                    <input type="text" name="telephone_fix" class="form-control" id="telephone_fix" placeholder="Entrez votre téléphone fixe" value="{{ old('telephone_fix', $data['telephone_fix'] ?? '') }}">
                    @error('telephone_fix') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" class="form-control" id="adresse" placeholder="Entrez votre adresse" value="{{ old('adresse', $data['adresse'] ?? '') }}" >
                    @error('adresse') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Entrez votre email" value="{{ old('email', $data['email'] ?? '') }}" >
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ville">Ville actuelle</label>
                    <input type="text" name="ville" class="form-control" id="ville" placeholder="Entrez votre ville actuelle" value="{{ old('ville', $data['ville'] ?? '') }}" >
                    @error('ville') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pays">Pays actuel</label>
                    <input type="text" name="pays" class="form-control" id="pays" placeholder="Entrez votre pays actuel" value="{{ old('pays', $data['pays'] ?? '') }}" >
                    @error('pays') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="CV">CV</label>
                    <input type="file" name="CV" class="form-control" id="CV" accept=".pdf,.doc,.docx" >
                    @error('CV') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="demande">Demande</label>
                    <input type="file" name="demande" class="form-control" id="demande" accept=".pdf,.doc,.docx" >
                    @error('demande') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="scan_cartid">Scan de la carte d'identité</label>
                    <input type="file" name="scan_cartid" class="form-control" id="scan_cartid" accept=".jpg,.jpeg,.png,.pdf" >
                    @error('scan_cartid') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" class="form-control" id="photo" accept=".jpg,.jpeg,.png" >
                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Suivant</button>
            </div>
        @endif

        <!-- Step 2: Bac -->
        @if ($step == 2)
            <hr>
            <h2 class="section-title">Informations sur le Baccalauréat</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="serie_bac">Série du Bac</label>
                    <input type="text" name="serie_bac" class="form-control" id="serie_bac" placeholder="Série du Bac" value="{{ old('serie_bac', $data['serie_bac'] ?? '') }}" >
                    @error('serie_bac') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="annee_bac">Année du Bac</label>
                    <select name="annee_bac" class="form-control" id="annee_bac" >
                        <option value="">Veuillez sélectionner</option>
                        @for ($i = now()->year; $i >= 2000; $i--)
                            <option value="{{ ($i-1) . '/' . $i }}" {{ old('annee_bac', $data['annee_bac'] ?? '') == ($i-1) . '/' . $i ? 'selected' : '' }}>
                                {{ ($i-1) . '/' . $i }}
                            </option>
                        @endfor
                    </select>
                    @error('annee_bac') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="scan_bac">Scan Bac</label>
                    <input type="file" name="scan_bac" class="form-control" id="scan_bac" accept=".pdf,.jpg,.jpeg,.png" >
                    @error('scan_bac') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-3">
                <form action="{{ route('candidat.previous') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="step" value="{{ $step }}">
                    <button type="submit" class="btn btn-secondary">Retour</button>
                </form>
                <button type="submit" class="btn btn-primary">Suivant</button>
            </div>
        @endif

        <!-- Step 3: Diplomes -->
        @if ($step == 3)
            <hr>
            <h2 class="section-title">Diplômes (Max 2)</h2>
            <div id="diplomes">
                @foreach ($data['diplomes'] ?? [[]] as $index => $diplome)
                    <div class="diplome-form mb-4 p-3 border rounded">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="type_diplome_bac_2_{{ $index }}">Type diplôme Bac+2</label>
                                <input type="text" name="diplomes[{{ $index }}][type_diplome_bac_2]" class="form-control" id="type_diplome_bac_2_{{ $index }}" placeholder="Type Diplôme Bac+2" value="{{ old('diplomes.' . $index . '.type_diplome_bac_2', $diplome['type_diplome_bac_2'] ?? '') }}" >
                                @error('diplomes.' . $index . '.type_diplome_bac_2') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="annee_diplome_bac_2_{{ $index }}">Année Bac+2</label>
                                <select name="diplomes[{{ $index }}][annee_diplome_bac_2]" class="form-control" id="annee_diplome_bac_2_{{ $index }}" >
                                    <option value="">Veuillez sélectionner</option>
                                    @for ($i = now()->year; $i >= 2000; $i--)
                                        <option value="{{ ($i-1) . '/' . $i }}" {{ old('diplomes.' . $index . '.annee_diplome_bac_2', $diplome['annee_diplome_bac_2'] ?? '') == ($i-1) . '/' . $i ? 'selected' : '' }}>
                                            {{ ($i-1) . '/' . $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('diplomes.' . $index . '.annee_diplome_bac_2') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="filier_diplome_bac_2_{{ $index }}">Filière Bac+2</label>
                                <input type="text" name="diplomes[{{ $index }}][filier_diplome_bac_2]" class="form-control" id="filier_diplome_bac_2_{{ $index }}" placeholder="Filière Bac+2" value="{{ old('diplomes.' . $index . '.filier_diplome_bac_2', $diplome['filier_diplome_bac_2'] ?? '') }}" >
                                @error('diplomes.' . $index . '.filier_diplome_bac_2') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="scan_bac_2_{{ $index }}">Scan Bac+2</label>
                                <input type="file" name="diplomes[{{ $index }}][scan_bac_2]" class="form-control" id="scan_bac_2_{{ $index }}" accept=".jpg,.jpeg,.png,.pdf" >
                                @error('diplomes.' . $index . '.scan_bac_2') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="etablissement_bac_2_{{ $index }}">Établissement Bac+2</label>
                                <input type="text" name="diplomes[{{ $index }}][etablissement_bac_2]" class="form-control" id="etablissement_bac_2_{{ $index }}" placeholder="Établissement Bac+2" value="{{ old('diplomes.' . $index . '.etablissement_bac_2', $diplome['etablissement_bac_2'] ?? '') }}" >
                                @error('diplomes.' . $index . '.etablissement_bac_2') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="type_diplome_bac_3_{{ $index }}">Type Diplôme Bac+3 (optionnel)</label>
                                <input type="text" name="diplomes[{{ $index }}][type_diplome_bac_3]" class="form-control" id="type_diplome_bac_3_{{ $index }}" placeholder="Type Diplôme Bac+3" value="{{ old('diplomes.' . $index . '.type_diplome_bac_3', $diplome['type_diplome_bac_3'] ?? '') }}">
                                @error('diplomes.' . $index . '.type_diplome_bac_3') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="annee_diplome_bac_3_{{ $index }}">Année Bac+3 (optionnel)</label>
                                <select name="diplomes[{{ $index }}][annee_diplome_bac_3]" class="form-control" id="annee_diplome_bac_3_{{ $index }}">
                                    <option value="">Veuillez sélectionner</option>
                                    @for ($i = now()->year; $i >= 2000; $i--)
                                        <option value="{{ ($i-1) . '/' . $i }}" {{ old('diplomes.' . $index . '.annee_diplome_bac_3', $diplome['annee_diplome_bac_3'] ?? '') == ($i-1) . '/' . $i ? 'selected' : '' }}>
                                            {{ ($i-1) . '/' . $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('diplomes.' . $index . '.annee_diplome_bac_3') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="filier_diplome_bac_3_{{ $index }}">Filière Bac+3 (optionnel)</label>
                                <input type="text" name="diplomes[{{ $index }}][filier_diplome_bac_3]" class="form-control" id="filier_diplome_bac_3_{{ $index }}" placeholder="Filière Bac+3" value="{{ old('diplomes.' . $index . '.filier_diplome_bac_3', $diplome['filier_diplome_bac_3'] ?? '') }}">
                                @error('diplomes.' . $index . '.filier_diplome_bac_3') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="scan_bac_3_{{ $index }}">Scan Bac+3 (optionnel)</label>
                                <input type="file" name="diplomes[{{ $index }}][scan_bac_3]" class="form-control" id="scan_bac_3_{{ $index }}" accept=".jpg,.jpeg,.png,.pdf">
                                @error('diplomes.' . $index . '.scan_bac_3') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="etablissement_bac_3_{{ $index }}">Établissement Bac+3 (optionnel)</label>
                                <input type="text" name="diplomes[{{ $index }}][etablissement_bac_3]" class="form-control" id="etablissement_bac_3_{{ $index }}" placeholder="Établissement Bac+3" value="{{ old('diplomes.' . $index . '.etablissement_bac_3', $diplome['etablissement_bac_3'] ?? '') }}">
                                @error('diplomes.' . $index . '.etablissement_bac_3') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeEntry(this, 'diplomes')">Supprimer</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-diplome" onclick="addDiplome()" class            class="btn btn-secondary mb-3">Ajouter un diplôme</button>
            <div class="mt-3">
                <form action="{{ route('candidat.previous') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="step" value="{{ $step }}">
                    <button type="submit" class="btn btn-secondary">Retour</button>
                </form>
                <button type="submit" class="btn btn-primary">Suivant</button>
            </div>
        @endif

        <!-- Step 4: Stages -->
        @if ($step == 4)
            <hr>
            <h2 class="section-title">Stages (Optionnel, Max 3)</h2>
            <div id="stages">
                @foreach ($data['stages'] ?? [] as $index => $stage)
                    <div class="stage-form mb-4 p-3 border rounded">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fonction_stage_{{ $index }}">Fonction</label>
                                <input type="text" name="stages[{{ $index }}][fonction]" class="form-control" id="fonction_stage_{{ $index }}" placeholder="Fonction" value="{{ old('stages.' . $index . '.fonction', $stage['fonction'] ?? '') }}">
                                @error('stages.' . $index . '.fonction') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="periode_stage_{{ $index }}">Période</label>
                                <input type="text" name="stages[{{ $index }}][periode]" class="form-control" id="periode_stage_{{ $index }}" placeholder="Période" value="{{ old('stages.' . $index . '.periode', $stage['periode'] ?? '') }}">
                                @error('stages.' . $index . '.periode') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="attestation_stage_{{ $index }}">Attestation</label>
                                <input type="file" name="stages[{{ $index }}][attestation]" class="form-control" id="attestation_stage_{{ $index }}" accept=".pdf,.doc,.docx">
                                @error('stages.' . $index . '.attestation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="etablissement_stage_{{ $index }}">Établissement</label>
                                <input type="text" name="stages[{{ $index }}][etablissement]" class="form-control" id="etablissement_stage_{{ $index }}" placeholder="Établissement" value="{{ old('stages.' . $index . '.etablissement', $stage['etablissement'] ?? '') }}">
                                @error('stages.' . $index . '.etablissement') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="secteur_activite_stage_{{ $index }}">Secteur d'activité</label>
                                <input type="text" name="stages[{{ $index }}][secteur_activite]" class="form-control" id="secteur_activite_stage_{{ $index }}" placeholder="Secteur d'activité" value="{{ old('stages.' . $index . '.secteur_activite', $stage['secteur_activite'] ?? '') }}">
                                @error('stages.' . $index . '.secteur_activite') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description_stage_{{ $index }}">Description</label>
                                <textarea name="stages[{{ $index }}][description]" class="form-control" id="description_stage_{{ $index }}" placeholder="Description">{{ old('stages.' . $index . '.description', $stage['description'] ?? '') }}</textarea>
                                @error('stages.' . $index . '.description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeEntry(this, 'stages')">Supprimer</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-stage" onclick="addStage()" class="btn btn-secondary mb-3">Ajouter un stage</button>
            <div class="mt-3">
                <form action="{{ route('candidat.previous') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="step" value="{{ $step }}">
                    <button type="submit" class="btn btn-secondary">Retour</button>
                </form>
                <button type="submit" class="btn btn-primary">Suivant</button>
            </div>
        @endif

        <!-- Step 5: Attestations -->
        @if ($step == 5)
            <hr>
            <h2 class="section-title">Attestations (Optionnel, Max 3)</h2>
            <div id="attestations">
                @foreach ($data['attestations'] ?? [] as $index => $attestation)
                    <div class="attestation-form mb-4 p-3 border rounded">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="attestation_{{ $index }}">Attestation</label>
                                <input type="file" name="attestations[{{ $index }}][attestation]" class="form-control" id="attestation_{{ $index }}" accept=".pdf,.doc,.docx">
                                @error('attestations.' . $index . '.attestation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="type_attestation_{{ $index }}">Type d'attestation</label>
                                <input type="text" name="attestations[{{ $index }}][type_attestation]" class="form-control" id="type_attestation_{{ $index }}" placeholder="Type d'attestation" value="{{ old('attestations.' . $index . '.type_attestation', $attestation['type_attestation'] ?? '') }}">
                                @error('attestations.' . $index . '.type_attestation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description_attestation_{{ $index }}">Description</label>
                                <textarea name="attestations[{{ $index }}][description]" class="form-control" id="description_attestation_{{ $index }}" placeholder="Description">{{ old('attestations.' . $index . '.description', $attestation['description'] ?? '') }}</textarea>
                                @error('attestations.' . $index . '.description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeEntry(this, 'attestations')">Supprimer</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-attestation" onclick="addAttestation()" class="btn btn-secondary mb-3">Ajouter une attestation</button>
            <div class="mt-3">
                <form action="{{ route('candidat.previous') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="step" value="{{ $step }}">
                    <button type="submit" class="btn btn-secondary">Retour</button>
                </form>
                <button type="submit" class="btn btn-primary">Suivant</button>
            </div>
        @endif

        <!-- Step 6: Expériences -->
        @if ($step == 6)
            <hr>
            <h2 class="section-title">Expériences (Optionnel, Max 3)</h2>
            <div id="experiences">
                @foreach ($data['experiences'] ?? [] as $index => $experience)
                    <div class="experience-form mb-4 p-3 border rounded">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fonction_experience_{{ $index }}">Fonction</label>
                                <input type="text" name="experiences[{{ $index }}][fonction]" class="form-control" id="fonction_experience_{{ $index }}" placeholder="Fonction" value="{{ old('experiences.' . $index . '.fonction', $experience['fonction'] ?? '') }}">
                                @error('experiences.' . $index . '.fonction') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="periode_experience_{{ $index }}">Période</label>
                                <input type="text" name="experiences[{{ $index }}][periode]" class="form-control" id="periode_experience_{{ $index }}" placeholder="Période" value="{{ old('experiences.' . $index . '.periode', $experience['periode'] ?? '') }}">
                                @error('experiences.' . $index . '.periode') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="attestation_experience_{{ $index }}">Attestation</label>
                                <input type="file" name="experiences[{{ $index }}][attestation]" class="form-control" id="attestation_experience_{{ $index }}" accept=".jpg,.jpeg,.png,.pdf">
                                @error('experiences.' . $index . '.attestation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="etablissement_experience_{{ $index }}">Établissement</label>
                                <input type="text" name="experiences[{{ $index }}][etablissement]" class="form-control" id="etablissement_experience_{{ $index }}" placeholder="Établissement" value="{{ old('experiences.' . $index . '.etablissement', $experience['etablissement'] ?? '') }}">
                                @error('experiences.' . $index . '.etablissement') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="secteur_activite_experience_{{ $index }}">Secteur d'activité</label>
                                <input type="text" name="experiences[{{ $index }}][secteur_activite]" class="form-control" id="secteur_activite_experience_{{ $index }}" placeholder="Secteur d'activité" value="{{ old('experiences.' . $index . '.secteur_activite', $experience['secteur_activite'] ?? '') }}">
                                @error('experiences.' . $index . '.secteur_activite') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description_experience_{{ $index }}">Description</label>
                                <textarea name="experiences[{{ $index }}][description]" class="form-control" id="description_experience_{{ $index }}" placeholder="Description">{{ old('experiences.' . $index . '.description', $experience['description'] ?? '') }}</textarea>
                                @error('experiences.' . $index . '.description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeEntry(this, 'experiences')">Supprimer</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-experience" onclick="addExperience()" class="btn btn-secondary mb-3">Ajouter une expérience</button>
            <div class="mt-3">
                <form action="{{ route('candidat.previous') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="step" value="{{ $step }}">
                    <button type="submit" class="btn btn-secondary">Retour</button>
                </form>
                <button type="submit" class="btn btn-success">Valider</button>
            </div>
        @endif
    </form>
</div>

<script>
    let diplomeCount = {{ count($data['diplomes'] ?? [[]]) }};
    let stageCount = {{ count($data['stages'] ?? []) }};
    let attestationCount = {{ count($data['attestations'] ?? []) }};
    let experienceCount = {{ count($data['experiences'] ?? []) }};

    function addDiplome() {
        if (diplomeCount >= 3) {
            alert('Vous ne pouvez ajouter que 3 diplômes maximum.');
            return;
        }
        const diplomeDiv = document.createElement('div');
        diplomeDiv.className = 'diplome-form mb-4 p-3 border rounded';
        diplomeDiv.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="type_diplome_bac_2_${diplomeCount}">Type diplôme Bac+2</label>
                    <input type="text" name="diplomes[${diplomeCount}][type_diplome_bac_2]" class="form-control" id="type_diplome_bac_2_${diplomeCount}" placeholder="Type Diplôme Bac+2" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="annee_diplome_bac_2_${diplomeCount}">Année Bac+2</label>
                    <select name="diplomes[${diplomeCount}][annee_diplome_bac_2]" class="form-control" id="annee_diplome_bac_2_${diplomeCount}" >
                        <option value="">Veuillez sélectionner</option>
                        ${[...Array(new Date().getFullYear() - 1999).keys()].map(i => {
                            const year = new Date().getFullYear() - i;
                            return `<option value="${(year-1)}/${year}">${(year-1)}/${year}</option>`;
                        }).join('')}
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="filier_diplome_bac_2_${diplomeCount}">Filière Bac+2</label>
                    <input type="text" name="diplomes[${diplomeCount}][filier_diplome_bac_2]" class="form-control" id="filier_diplome_bac_2_${diplomeCount}" placeholder="Filière Bac+2" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="scan_bac_2_${diplomeCount}">Scan Bac+2</label>
                    <input type="file" name="diplomes[${diplomeCount}][scan_bac_2]" class="form-control" id="scan_bac_2_${diplomeCount}" accept=".jpg,.jpeg,.png,.pdf" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="etablissement_bac_2_${diplomeCount}">Établissement Bac+2</label>
                    <input type="text" name="diplomes[${diplomeCount}][etablissement_bac_2]" class="form-control" id="etablissement_bac_2_${diplomeCount}" placeholder="Établissement Bac+2" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="type_diplome_bac_3_${diplomeCount}">Type Diplôme Bac+3 (optionnel)</label>
                    <input type="text" name="diplomes[${diplomeCount}][type_diplome_bac_3]" class="form-control" id="type_diplome_bac_3_${diplomeCount}" placeholder="Type Diplôme Bac+3">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="annee_diplome_bac_3_${diplomeCount}">Année Bac+3 (optionnel)</label>
                    <select name="diplomes[${diplomeCount}][annee_diplome_bac_3]" class="form-control" id="annee_diplome_bac_3_${diplomeCount}">
                        <option value="">Veuillez sélectionner</option>
                        ${[...Array(new Date().getFullYear() - 1999).keys()].map(i => {
                            const year = new Date().getFullYear() - i;
                            return `<option value="${(year-1)}/${year}">${(year-1)}/${year}</option>`;
                        }).join('')}
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="filier_diplome_bac_3_${diplomeCount}">Filière Bac+3 (optionnel)</label>
                    <input type="text" name="diplomes[${diplomeCount}][filier_diplome_bac_3]" class="form-control" id="filier_diplome_bac_3_${diplomeCount}" placeholder="Filière Bac+3">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="scan_bac_3_${diplomeCount}">Scan Bac+3 (optionnel)</label>
                    <input type="file" name="diplomes[${diplomeCount}][scan_bac_3]" class="form-control" id="scan_bac_3_${diplomeCount}" accept=".jpg,.jpeg,.png,.pdf">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="etablissement_bac_3_${diplomeCount}">Établissement Bac+3 (optionnel)</label>
                    <input type="text" name="diplomes[${diplomeCount}][etablissement_bac_3]" class="form-control" id="etablissement_bac_3_${diplomeCount}" placeholder="Établissement Bac+3">
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeEntry(this, 'diplomes')">Supprimer</button>
        `;
        document.getElementById('diplomes').appendChild(diplomeDiv);
        diplomeCount++;
        updateAddButtonState('diplome', diplomeCount);
    }

    function addStage() {
        if (stageCount >= 3) {
            alert('Vous ne pouvez ajouter que 3 stages maximum.');
            return;
        }
        const stageDiv = document.createElement('div');
        stageDiv.className = 'stage-form mb-4 p-3 border rounded';
        stageDiv.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fonction_stage_${stageCount}">Fonction</label>
                    <input type="text" name="stages[${stageCount}][fonction]" class="form-control" id="fonction_stage_${stageCount}" placeholder="Fonction">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="periode_stage_${stageCount}">Période</label>
                    <input type="text" name="stages[${stageCount}][periode]" class="form-control" id="periode_stage_${stageCount}" placeholder="Période">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="attestation_stage_${stageCount}">Attestation</label>
                    <input type="file" name="stages[${stageCount}][attestation]" class="form-control" id="attestation_stage_${stageCount}" accept=".pdf,.doc,.docx">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="etablissement_stage_${stageCount}">Établissement</label>
                    <input type="text" name="stages[${stageCount}][etablissement]" class="form-control" id="etablissement_stage_${stageCount}" placeholder="Établissement">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="secteur_activite_stage_${stageCount}">Secteur d'activité</label>
                    <input type="text" name="stages[${stageCount}][secteur_activite]" class="form-control" id="secteur_activite_stage_${stageCount}" placeholder="Secteur d'activité">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description_stage_${stageCount}">Description</label>
                    <textarea name="stages[${stageCount}][description]" class="form-control" id="description_stage_${stageCount}" placeholder="Description"></textarea>
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeEntry(this, 'stages')">Supprimer</button>
        `;
        document.getElementById('stages').appendChild(stageDiv);
        stageCount++;
        updateAddButtonState('stage', stageCount);
    }

    function addAttestation() {
        if (attestationCount >= 3) {
            alert('Vous ne pouvez ajouter que 3 attestations maximum.');
            return;
        }
        const attestationDiv = document.createElement('div');
        attestationDiv.className = 'attestation-form mb-4 p-3 border rounded';
        attestationDiv.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="attestation_${attestationCount}">Attestation</label>
                    <input type="file" name="attestations[${attestationCount}][attestation]" class="form-control" id="attestation_${attestationCount}" accept=".pdf,.doc,.docx">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="type_attestation_${attestationCount}">Type d'attestation</label>
                    <input type="text" name="attestations[${attestationCount}][type_attestation]" class="form-control" id="type_attestation_${attestationCount}" placeholder="Type d'attestation">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description_attestation_${attestationCount}">Description</label>
                    <textarea name="attestations[${attestationCount}][description]" class="form-control" id="description_attestation_${attestationCount}" placeholder="Description"></textarea>
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeEntry(this, 'attestations')">Supprimer</button>
        `;
        document.getElementById('attestations').appendChild(attestationDiv);
        attestationCount++;
        updateAddButtonState('attestation', attestationCount);
    }

    function addExperience() {
        if (experienceCount >= 3) {
            alert('Vous ne pouvez ajouter que 3 expériences maximum.');
            return;
        }
        const experienceDiv = document.createElement('div');
        experienceDiv.className = 'experience-form mb-4 p-3 border rounded';
        experienceDiv.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fonction_experience_${experienceCount}">Fonction</label>
                    <input type="text" name="experiences[${experienceCount}][fonction]" class="form-control" id="fonction_experience_${experienceCount}" placeholder="Fonction">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="periode_experience_${experienceCount}">Période</label>
                    <input type="text" name="experiences[${experienceCount}][periode]" class="form-control" id="periode_experience_${experienceCount}" placeholder="Période">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="attestation_experience_${experienceCount}">Attestation</label>
                    <input type="file" name="experiences[${experienceCount}][attestation]" class="form-control" id="attestation_experience_${experienceCount}" accept=".jpg,.jpeg,.png,.pdf">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="etablissement_experience_${experienceCount}">Établissement</label>
                    <input type="text" name="experiences[${experienceCount}][etablissement]" class="form-control" id="etablissement_experience_${experienceCount}" placeholder="Établissement">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="secteur_activite_experience_${experienceCount}">Secteur d'activité</label>
                    <input type="text" name="experiences[${experienceCount}][secteur_activite]" class="form-control" id="secteur_activite_experience_${experienceCount}" placeholder="Secteur d'activité">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description_experience_${experienceCount}">Description</label>
                    <textarea name="experiences[${experienceCount}][description]" class="form-control" id="description_experience_${experienceCount}" placeholder="Description"></textarea>
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeEntry(this, 'experiences')">Supprimer</button>
        `;
        document.getElementById('experiences').appendChild(experienceDiv);
        experienceCount++;
        updateAddButtonState('experience', experienceCount);
    }

    function removeEntry(element, type) {
        element.parentElement.remove();
        if (type === 'diplomes') diplomeCount--;
        else if (type === 'stages') stageCount--;
        else if (type === 'attestations') attestationCount--;
        else if (type === 'experiences') experienceCount--;
        updateAddButtonState(type, window[type + 'Count']);
    }

    function updateAddButtonState(type, count) {
        const button = document.getElementById(`add-${type}`);
        if (count >= 3) {
            button.disabled = true;
            button.style.opacity = '0.5';
            button.style.cursor = 'not-allowed';
        } else {
            button.disabled = false;
            button.style.opacity = '1';
            button.style.cursor = 'pointer';
        }
    }

    window.onload = function() {
        updateAddButtonState('diplome', diplomeCount);
        updateAddButtonState('stage', stageCount);
        updateAddButtonState('attestation', attestationCount);
        updateAddButtonState('experience', experienceCount);
    };
</script>
@endsection