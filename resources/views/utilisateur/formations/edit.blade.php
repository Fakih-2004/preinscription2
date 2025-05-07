@extends('utilisateur.Layouts.app')


@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary fw-bold">Modifier formation</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('formations.update', $formation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="type_formation" class="form-label">type formation</label>
                    <input type="text" name="type_formation" id="type_formation" class="form-control" value="{{ $formation->type_formation }}" required>
                </div>

                <div class="mb-3">
                    <label for="date_debut" class="form-label">date debut</label>
                    <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ $formation->date_debut }}" required>
                </div>

                <div class="mb-3">
                    <label for="date_fin" class="form-label">date_fin</label>
                    <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ $formation->date_fin }}" required>
                </div>

                <div class="mb-3">
                <label for="administrateure_id" class="form-label">administrateur</label>
                <select name="administrateur_id" id="administrateur_id" class="form-control" required>
                    @foreach ($administrateurs as $administrateur)
                        <option value="{{ $administrateur->id }}" {{ $administrateur->id == $formation->administrateur_id ? 'selected' : '' }}>
                            {{ $administrateur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">Mettre à jour</button>
                    <a href="{{ route('formations.index') }}" class="btn btn-secondary ms-2">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
