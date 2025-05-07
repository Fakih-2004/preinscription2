@extends('utilisateur.Layouts.app')

@section('title', 'Les stages')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 fw-bold text-primary">Liste des stages</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('stages.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un stage
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light text-nowrap text-center align-middle">
                        <tr>
                            <th>ID</th>
                            <th>Candidat</th>
                            <th>Fonction</th>
                            <th>Période</th>
                            <th>Attestation</th>
                            <th>Établissement</th>
                            <th>Secteur d'activité</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody class="text-nowrap">
                        @foreach ($stages as $stage)
                        <tr>
                            <td>{{ $stage->id }}</td>
                            <td>{{ $stage->candidat->nom ?? 'Unknown' }} {{ $stage->candidat->prenom ?? '' }}</td>
                            <td>{{ $stage->fonction }}</td>
                            <td>{{ $stage->periode }}</td>
                            <td>
                                @if ($stage->attestation)
                                    <a href="{{ asset(str_replace('public/', 'storage/', $stage->attestation)) }}" target="_blank">Voir Attestation</a>
                                @else
                                    No Attestation
                                @endif
                            </td>
                            <td>{{ $stage->etablissement }}</td>
                            <td>{{ $stage->secteur_activite }}</td>
                            <td>{{ $stage->discription }}</td>
                            <td class="text-center">
                                <a href="{{ route('stages.edit', $stage->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('stages.destroy', $stage->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($stages->isEmpty())
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Aucun stage trouvé.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
