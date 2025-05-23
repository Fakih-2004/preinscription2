@extends('utilisateur.Layouts.app')
@section('title', 'Ajouter un stage')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="background: #1a4b8c; background: linear-gradient(195deg, #1a4b8c 0%, #12315f 100%);">
                        <h6 class="text-white text-capitalize ps-3">Ajouter un stage</h6>
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

                    <form action="{{ route('stages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Fonction</label>
                                    <input type="text" name="fonction" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Période</label>
                                    <input type="text" name="periode" class="form-control" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Établissement</label>
                                    <input type="text" name="etablissement" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Secteur d'activité</label>
                                    <input type="text" name="secteur_activite" class="form-control" >
                                </div>
                            </div>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                            <textarea name="description" class="form-control" rows="3" ></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Attestation (PDF, JPG, PNG)</label>
                                    <input type="file" name="attestation" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label class="form-label">Candidat</label>
                                    <select name="candidat_id" class="form-control">
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
                            <a href="{{ route('stages.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
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