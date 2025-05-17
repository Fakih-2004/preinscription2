@extends('utilisateur.Layouts.app')
@section('title', 'Les Stages')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="border-radius-lg pt-4 pb-3" style="background-color: #1a4b8c; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <h6 class="text-white text-capitalize ps-3">Liste des Stages</h6>
                    </div>
                </div>
                
                <div class="card-body px-0 pb-2">
                    <div class="d-flex justify-content-end mx-3 mb-3">
                        <a href="{{ route('stages.create') }}" class="btn btn-sm text-white" style="background-color: #1a4b8c;">
                            <i class="material-symbols-rounded me-1">add</i>
                            <span>Ajouter un stage</span>
                        </a>
                    </div>
                    @php
                        $placeholder = 'Rechercher un Stage...';
                    @endphp
                    
                    <div class="table-responsive p-3">
                        <table id="searshTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Candidat</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Fonction</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Période</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Attestation</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Établissement</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Secteur</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Description</th>
                                    <th class="text-secondary opacity-7 text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stages as $stage)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $stage->id }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $stage->candidat->nom ?? 'Unknown' }} {{ $stage->candidat->prenom ?? '' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $stage->fonction }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $stage->periode }}</p>
                                    </td>
                                    <td>
                                        @if ($stage->attestation)
                                        <a href="{{ asset('storage/' . $stage->attestation) }}" 
                                           target="_blank" 
                                           class="badge badge-sm text-white" 
                                           style="background-color: #1a4b8c; padding: 4px 8px;">
                                           Voir
                                        </a>
                                        @else
                                        <p class="text-xs text-secondary mb-0">Aucune</p>
                                        @endif
                                    </td>                                
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $stage->etablissement }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $stage->secteur_activite }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 200px;">{{ $stage->description }}</p>
                                    </td>
                                    <td class="align-center text-end pe-4">
                                        <form id="delete-form-{{ $stage->id }}" 
                                            action="{{ route('stages.destroy', $stage->id) }}" 
                                            method="POST" 
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    onclick="confirmDelete({{ $stage->id }}, this, 'ce stage')" 
                                                    class="btn btn-link text-danger p-0">
                                                <i class="material-symbols-rounded">delete</i>
                                            </button>
                                        </form>                     
                                    </td>
                                </tr>
                                @endforeach
                                
                                @if ($stages->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">Aucun stage trouvé</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Button hover effect */
    .btn[style*="#1a4b8c"]:hover {
        background-color: #0d3a73 !important;
    }
    
    /* View button hover */
    a.badge[style*="#1a4b8c"]:hover {
        background-color: #0d3a73 !important;
        text-decoration: none;
    }
    
    /* Table row hover effect */
    .table-hover tbody tr:hover {
        background-color: rgba(26, 75, 140, 0.05);
    }
</style>
@endsection