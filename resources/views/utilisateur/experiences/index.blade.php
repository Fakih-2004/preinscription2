@extends('utilisateur.Layouts.app')

@section('title', 'Liste des expériences')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 fw-bold text-primary">Liste des expériences</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('experiences.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter une expérience
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light text-nowrap text-center align-middle">
                        <tr>
                            <th>ID</th>
                            <th>Nom Candidat</th>
                            <th>Fonction</th>
                            <th>Secteur</th>
                            <th>Période</th>
                            <th>Établissement</th>
                            <th>Description</th>
                            <th>Attestation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-nowrap">
                        @foreach ($experiences as $experience)
                        <tr>
                            <td>{{ $experience->id }}</td>
                            <td>{{ $experience->candidat->nom }} {{ $experience->candidat->prenom }}</td>
                            <td>{{ $experience->fonction }}</td>
                            <td>{{ $experience->secteur_activite }}</td>
                            <td>{{ $experience->periode }}</td>
                            <td>{{ $experience->etablissement }}</td>
                            <td>{{ $experience->discription }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $experience->attestation) }}" target="_blank">Voir</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('experiences.edit', $experience->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('experiences.destroy', $experience->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cette expérience ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if ($experiences->isEmpty())
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">Aucune expérience trouvée.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
