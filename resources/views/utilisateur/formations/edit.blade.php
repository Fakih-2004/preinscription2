@extends('utilisateur.Layouts.app')
@section('title', 'Modifier Formation')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="border-radius-lg pt-4 pb-3" style="background: #1a4b8c; background: linear-gradient(195deg, #1a4b8c 0%, #12315f 100%);">
                        <h6 class="text-white text-capitalize ps-3">Modifier la Formation</h6>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <form action="{{ route('formations.update', $formation->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Type de formation</label>
                            <input type="text" name="type_formation" class="form-control" value="{{ $formation->type_formation }}" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Date début</label>
                            <input type="date" name="date_debut" class="form-control" value="{{ $formation->date_debut }}" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Date fin</label>
                            <input type="date" name="date_fin" class="form-control" value="{{ $formation->date_fin }}" required>
                        </div>

                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Administrateur</label>
                            <select name="administrateur_id" class="form-control" required>
                                @foreach ($administrateurs as $administrateur)
                                    <option value="{{ $administrateur->id }}" {{ $administrateur->id == $formation->administrateur_id ? 'selected' : '' }}>
                                        {{ $administrateur->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg text-white" style="background-color: #1a4b8c;">
                                <i class="material-symbols-rounded me-1">save</i> Mettre à jour
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

<style>
    /* Style for the input fields when focused */
    .input-group.input-group-outline:not(.is-filled) .form-label {
        color: #1a4b8c;
    }
    .input-group.input-group-outline.is-filled .form-label,
    .input-group.input-group-outline.is-focused .form-label {
        color: #1a4b8c;
    }
    .input-group.input-group-outline .form-control:focus,
    .input-group.input-group-outline .form-select:focus {
        border-color: #1a4b8c;
        box-shadow: 0 0 0 2px rgba(26, 75, 140, 0.2);
    }
    
    /* Select dropdown styling */
    .form-select {
        padding: 0.5rem;
        border-radius: 0.375rem;
        border: 1px solid #d2d6da;
    }
    
    /* Button hover effects */
    .btn[style*="#1a4b8c"]:hover {
        background-color: #0d3a73 !important;
    }
    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection