@extends('Layouts.app') 
@section('title', 'les stage') 

@section('content') 
    <div class="container mt-4">
        <h1 class="text-center mb-4">les stages</h1>

       
        <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('stages.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un stage
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
            <th>fonction</th>
            <th>periode</th>
            <th>attestation</th>
            <th>établissement</th>
            <th>secteur activite</th>
            <th>description</th>
            <th>Actions</th>
        </tr>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($stages as $stage)
                        <tr>

                <td>{{ $stage->id }}</td>
                <td>{{ $stage->candidat->nom  ?? 'Non défini'}}</td>
                <td>{{ $stage->candidat->CIN  ?? 'Non défini'}}</td>
                <td>{{ $stage->fonction}}</td>
                <td>{{ $stage->periode}}</td>
                <td><a href="{{ asset('storage/' . $stage->attestation) }}" target="_blank">attestation</a></td>
                <td>{{ $stage->etablissement}}</td>
                <td>{{ $stage->secteur_activite}}</td>
                <td>{{ $stage->description}}</td>
                
             
                            <td>
                                <div class="d-flex gap-2">
                                    
                                    <form action="{{ route('stages.destroy', $stage->id) }}" method="POST"
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


