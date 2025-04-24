@extends('admin.Layout.app')


@section('content')
    <div class="container mt-5">
        @php
        $formations = App\Models\Formation::all();
        @endphp

        <h1 class="mb-4">Modifier formation</h1>


        <form action="{{ route('formations.update', $formation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

           
            <div class="mb-3">
                <label for="formation_id" class="form-label">Société:</label>
                <select name="formation_id" id="formation_id" class="form-control" required>
                    @foreach ($formations as $formation)
                        <option value="{{ $formation->id }}" {{ $formation->id == $formation->formation_id ? 'selected' : '' }}>
                            {{ $formation->raison_social }}
                        </option>
                    @endforeach
                </select>
            </div>

          
            <div class="mb-3">
                <label for="nbr_siege" class="form-label">Nombre de sièges:</label>
                <input type="number" class="form-control" name="nbr_siege" id="nbr_siege"
                    value="{{ old('nbr_siege', $formation->nbr_siege) }}" required>
            </div>

           
            

          
            <div class="mb-3">
                <label for="matricule" class="form-label">Matricule:</label>
                <input type="text" class="form-control" name="matricule" id="matricule"
                    value="{{ old('matricule', $formation->matricule) }}" required>
            </div>

           
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-2">
                <i class="bi bi-save"></i> Enregistrer
            </button>
            <a href="{{ route('formations.index') }}" class="btn btn-secondary">
                Annuler
            </a>
        </div>
        </form>
    </div>
@endsection
