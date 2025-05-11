@extends('utilisateur.Layouts.app')
@section('title', 'Ajouter une formation')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="background: #1a4b8c; background: linear-gradient(195deg, #1a4b8c 0%, #12315f 100%);">
                        <h6 class="text-white text-capitalize ps-3">Ajouter une nouvelle formation</h6>
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

                    <form action="{{ route('formations.store') }}" method="POST">
                        @csrf
                        
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Type de formation</label>
                            <select name="type_formation" class="form-control" required>
                                <option value="">Choisir...</option>
                                <option value="Licence">Licence</option>
                                <option value="Master">Master</option>
                            </select>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Date début</label>
                            <input type="date" name="date_debut" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Date fin</label>
                            <input type="date" name="date_fin" class="form-control" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Administrateur</label>
                            <select name="administrateur_id" class="form-control" required>
                                <option value="">Sélectionner un administrateur</option>
                                @foreach ($administrateurs as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->prenom }} {{ $admin->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg text-white" style="background-color: #1a4b8c;">
                                <i class="material-symbols-rounded me-1">save</i> Enregistrer
                            </button>
                            <a href="{{ route('formations.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
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