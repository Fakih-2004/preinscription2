@extends('utilisateur.Layouts.app')
@section('title', 'Ajouter un diplôme')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="background: #1a4b8c; background: linear-gradient(195deg, #1a4b8c 0%, #12315f 100%);">
                        <h6 class="text-white text-capitalize ps-3">Ajouter un nouveau diplôme</h6>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
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
                            <!-- Bac+2 Section -->
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Type de diplôme Bac+2</label>
                                    <input type="text" name="type_diplome_bac_2" class="form-control" placeholder="Entrez le type de diplôme Bac+2" required>
                                    <input type="text" name="type_diplome_bac_2" class="form-control" placeholder="Entrez le type de diplôme Bac_2" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Année Bac+2</label>
                                                                        <input type="text" name="annee_bac_2" class="form-control" placeholder="Entrez le annee de diplôme Bac+2" required>

                                    <input type="date" name="annee_diplome_bac_2" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Filère Bac+2</label>
                                    <input type="text" name="filiere_bac_2" class="form-control" placeholder="Entrez la filière Bac+2" required>
                                    <input type="text" name="filiere_diplome_bac_2" class="form-control" placeholder="Entrez la filière Bac_2" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Établissement Bac+2</label>
                                    <input type="text" name="etablissement_bac_2" class="form-control" placeholder="Entrez l'établissement Bac+2" required>
                                    <input type="text" name="etablissement_bac_2" class="form-control" placeholder="Entrez l'établissement Bac_2" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Scan Bac+2</label>
                                    <input type="file" name="scan_bac_2" class="form-control" accept="application/pdf,image/*" required>
                                    <input type="file" name="scan_bac_2" class="form-control" accept="application/pdf,image/*" required>
                                </div>
                            </div>

                            <!-- Bac+3 Section -->
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Type de diplôme Bac+3</label>
                                    <input type="text" name="type_bac_3" class="form-control" placeholder="Entrez le type de diplôme Bac+3" >
                                    <input type="text" name="type_diplome_bac_3" class="form-control" placeholder="Entrez le type de diplôme Bac_3" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Année Bac+3</label>
                                                                        <input type="text" name="annee_bac3" class="form-control" placeholder="Entrez le annee de diplôme Bac+3" >

                                    <input type="date" name="annee_diplome_bac_3" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Filère Bac+3</label>
                                    <input type="text" name="filiere_diplome_bac_3" class="form-control" placeholder="Entrez la filière Bac+3" >
                                    <input type="text" name="filiere_diplome_bac_3" class="form-control" placeholder="Entrez la filière Bac_3" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Établissement Bac+3</label>
                                    <input type="text" name="etablissement_bac_3" class="form-control" placeholder="Entrez l'établissement Bac+3" >
                                    <input type="text" name="etablissement_bac_3" class="form-control" placeholder="Entrez l'établissement Bac_3" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Scan Bac+3</label>
                                    <input type="file" name="scan_bac_3" class="form-control" accept="application/pdf,image/*" >
                                    <input type="file" name="scan_bac_3" class="form-control" accept="application/pdf,image/*" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Candidat</label>
                                    <select name="candidat_id" class="form-control" >
                                        <option value="">-- Choisir un candidat --</option>
                                        @foreach ($candidats as $candidat)
                                            <option value="{{ $candidat->id }}">{{ $candidat->nom }} {{ $candidat->prenom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg text-white" style="background-color: #1a4b8c;">
                                <i class="material-symbols-rounded me-1">save</i> Enregistrer
                            </button>
                            <a href="{{ route('diplomes.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
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