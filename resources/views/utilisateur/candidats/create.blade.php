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
                <div class="card-body px-4 pb-2">
                    @if ($errors->any())
                        <div class="alert alert-danger text-white">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('candidats.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Formation Selection -->
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Type de formation</label>
                            <select name="formation_id" class="form-control" required>
                                <option value="">-- Choisir --</option>
                                @foreach ($formations as $formation)
                                <option value="{{ $formation->id }}">
                                    {{ ucfirst($formation->type_formation) }} ({{ $formation->titre }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Personal Information -->
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">الاسم العائلي</label>
                            <input type="text" name="nom_ar" class="form-control text-end" dir="rtl" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">الاسم الشخصي</label>
                            <input type="text" name="prenom_ar" class="form-control text-end" dir="rtl" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">CNE</label>
                            <input type="text" name="CNE" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">CIN</label>
                            <input type="text" name="CIN" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Date de naissance</label>
                            <input type="date" name="date_naissance" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Ville naissance</label>
                            <input type="text" name="ville_naissance" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">مدينة الولادة</label>
                            <input type="text" name="ville_naissance_ar" class="form-control text-end" dir="rtl" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Province</label>
                            <input type="text" name="province" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Pays naissance</label>
                            <input type="text" name="pay_naissance" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Nationalité</label>
                            <input type="text" name="nationalite" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Sexe</label>
                            <select name="sexe" class="form-control" required>
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>

                        <!-- Contact Information -->
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Téléphone mobile</label>
                            <input type="text" name="telephone_mob" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Téléphone fixe</label>
                            <input type="text" name="telephone_fix" class="form-control">
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Ville</label>
                            <input type="text" name="ville" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Pays</label>
                            <input type="text" name="pays" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Adresse</label>
                            <textarea name="adresse" class="form-control" rows="2" required></textarea>
                        </div>

                        <!-- Documents -->
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">CV (PDF)</label>
                            <input type="file" name="CV" class="form-control" accept="application/pdf" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Demande (PDF)</label>
                            <input type="file" name="demande" class="form-control" accept="application/pdf" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Carte d'identité (scan)</label>
                            <input type="file" name="scan_cartid" class="form-control" accept="application/pdf,image/*" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*" required>
                        </div>

                        <!-- Bac Information -->
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Série Bac</label>
                            <input type="text" name="serie_bac" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Année Bac</label>
                            <select name="annee_bac" class="form-control" required>
                                <option value="">-- Sélectionnez --</option>
                                @for ($i = now()->year; $i >= 2000; $i--)
                                    <option value="{{ ($i-1) . '/' . $i }}">{{ ($i-1) . '/' . $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Scan Bac</label>
                            <input type="file" name="scan_bac" class="form-control" accept="application/pdf,image/*" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg text-white" style="background-color: #1a4b8c;">
                                <i class="material-symbols-rounded me-1">save</i> Enregistrer
                            </button>
                            <a href="{{ route('candidats.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                                <i class="material-symbols-rounded me-1">cancel</i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection