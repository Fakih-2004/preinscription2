@extends('Layouts.app') 
@section('title', 'les attestation') 

@section('content') 
    <div class="container mt-4">
        <h1 class="text-center mb-4">les attestations</h1>

        <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('attestations.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un attestation
        </a>
    </div>
                       
                        @php
                            $candidats = \App\Models\Candidat::all();
                        @endphp
        
                        <div class="card shadow-sm border-0">
        <div class="card-body p-0">            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
            <th>ID</th>
            <th>nom</th>
            <th>CIN</th>
            <th>attestation</th>
            <th>type attestation</th>
            <th>description</th>
            <th>Actions</th>
        </tr>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($attestations as $attestation)
                        <tr>

                <td>{{ $attestation->id }}</td>
                <td>{{ $attestation->candidat->nom  ?? 'Non défini'}}</td>
                <td>{{ $attestation->candidat->CIN  ?? 'Non défini'}}</td>
                <td>{{ $attestation->type_attestation}}</td>
                <td><a href="{{ asset('storage/' . $attestation->attestation) }}" target="_blank">attestation</a></td>
                <td>{{ $attestation->description}}</td>
                
             
                            <td>
                                <div class="d-flex gap-2">
                                    
                                    <form action="{{ route('attestations.destroy', $attestation->id) }}" method="POST"
                                        onsubmit="confirmDelete(event, this)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?')">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>
    @endsection


