@extends('utilisateur.Layouts.app')

@section('title', 'Liste des attestations')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="border-radius-lg pt-4 pb-3" style="background-color: #1a4b8c; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <h6 class="text-white text-capitalize ps-3">Liste des attestations</h6>
                    </div>
                </div>
                
                <div class="card-body px-0 pb-2">
                    <div class="d-flex justify-content-end mx-3 mb-3">
                        <a href="{{ route('attestations.create') }}" class="btn btn-sm text-white" style="background-color: #1a4b8c;">
                            <i class="material-symbols-rounded me-1 text-white">add</i>
                            <span class="text-white">Ajouter une attestation</span>
                        </a>
                    </div>
                    
                    <div class="table-responsive p-3">
                        <table id="attestationTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Candidat</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Type</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Description</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Fichier</th>
                                    <th class="text-secondary opacity-7 text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attestations as $attestation)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $attestation->id }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $attestation->candidat->nom }} {{ $attestation->candidat->prenom }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $attestation->type_attestation }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 200px;">{{ $attestation->description }}</p>
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/' . $attestation->attestation) }}" 
                                           target="_blank" 
                                           class="badge badge-sm text-white" 
                                           style="background-color: #1a4b8c; padding: 4px 8px;">
                                           Voir
                                        </a>
                                    </td>
                                    <td class="align-center text-end pe-4">
                                        <form id="delete-form-{{ $attestation->id }}" 
                                            action="{{ route('attestations.destroy', $attestation->id) }}" 
                                            method="POST" 
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    onclick="confirmDelete({{ $attestation->id }}, this, 'cette attestation')" 
                                                    class="btn btn-link text-danger font-weight-bold text-xs p-0">
                                                <i class="material-symbols-rounded">delete</i>
                                            </button>
                                            
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @if ($attestations->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Aucune attestation trouvée</td>
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

{{-- DataTables & SweetAlert --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<style>
    /* Style for the "Voir" button hover */
    a.badge[style*="#1a4b8c"]:hover {
        background-color: #0d3a73 !important;
        text-decoration: none;
    }
</style>
@endsection