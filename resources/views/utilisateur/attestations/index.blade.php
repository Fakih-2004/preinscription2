@extends('utilisateur.Layouts.app')

@section('title', 'Liste des attestations')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 fw-bold text-primary">Liste des attestations</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('attestations.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter une attestation
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light text-nowrap ">
                        <tr>
                            <th>ID</th>
                            <th>Nom Candidat</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Fichier</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-nowrap">
                        @foreach ($attestations as $attestation)
                        <tr>
                            <td>{{ $attestation->id }}</td>
                            <td>{{ $attestation->candidat->nom }} {{ $attestation->candidat->prenom }}</td>
                            <td>{{ $attestation->type_attestation }}</td>
                            <td>{{ $attestation->discription }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $attestation->attestation) }}" target="_blank">Voir</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('attestations.edit', $attestation->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('attestations.destroy', $attestation->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cette attestation ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if ($attestations->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Aucune attestation trouvée.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
