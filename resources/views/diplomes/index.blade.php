@extends('Layouts.app') 
@section('title', 'les diplome') 

@section('content') 
    <div class="container mt-4">
        <h1 class="text-center mb-4">les diplomes</h1>

        <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('diplomes.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un diplome
        </a>
    </div>
       
                        @php
                            $diplomes = \App\Models\Diplome::all();
                        @endphp
        
                        <div class="card shadow-sm border-0">
        <div class="card-body p-0">            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                    <th>ID</th>
            <th>type de diplome_bac+2</th>
            <th>Année de bac+2</th>
            <th>Filier de bac+2</th>
            <th>scan de bac+2</th>
            <th>établissement (bac+2)</th>
            <th>type de diplome bac+3</th>
            <th>Année de bac+3</th>
            <th>filier de bac+3</th>
            <th>établissement (bac+3)</th>
            <th>scan de bac+3</th>
            <th>Actions</th>
        </tr>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($diplomes as $diplome)
                        <tr>

                <td>{{ $diplome->id }}</td>
                <td>{{ $diplome->candidat->nom  ?? 'Non défini'}}</td>
                <td>{{ $diplome->type_diplome_bac+2 }}</td>
                <td>{{ $diplome->annee_bac+2 }}</td>
                <td>{{ $diplome->filier_bac+2 }}</td>
                <td><a href="{{ asset('storage/' . $diplome->scan_bac+2) }}" target="_blank">scan bac+2</a></td>
                <td>{{ $diplome->etablissement}}</td>
                <td>{{ $diplome->type_diplome_bac+3 }}</td>
                <td>{{ $diplome->annee_bac+3 }}</td>
                <td>{{ $diplome->filier_bac+3 }}</td>
                <td><a href="{{ asset('storage/' . $diplome->scan_bac+3) }}" target="_blank">scan bac+3</a></td>
                <td>{{ $diplome->etablissement}}</td>
             
                            <td>
                                <div class="d-flex gap-2">
                                    
                                    <form action="{{ route('diplomes.destroy', $diplome->id) }}" method="POST"
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


