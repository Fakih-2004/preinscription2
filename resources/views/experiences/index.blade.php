@extends('Layouts.app') 
@section('title', 'les experience') 

@section('content') 
    <div class="container mt-4">
        <h1 class="text-center mb-4">les experiences</h1>


        <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('experiences.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un experience
        </a>
    </div>
       
                        @php
                            $candidats = \App\Models\Candidat::all();
                        @endphp
                       
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
            <th>ID</th>
            <th>nom</th>
            <th>CIN</th>
            <th>fonction</th>
            <th>secteur activite</th>
            <th>periode</th>
            <th>attestation</th>
            <th>établissement </th>
            <th>description</th>
            <th>Actions</th>
        </tr>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($experiences as $experience)
                        <tr>

                <td>{{ $experience->id }}</td>
                <td>{{ $experience->candidat->nom  ?? 'Non défini'}}</td>
                <td>{{ $experience->candidat->CIN ?? 'Non défini'}}</td>
                <td>{{ $experience->fonction }}</td>
                <td>{{ $experience->secteur_activite }}</td>
                <td>{{ $experience->periode }}</td>
                <td><a href="{{ asset('storage/' . $experience->attestation) }}" target="_blank">scan bac+2</a></td>
                <td>{{ $experience->etablissement}}</td>
                <td>{{ $experience->description }}</td>
               
                            <td>
                                <div class="d-flex gap-2">
                                    
                                    <form action="{{ route('experiences.destroy', $experience->id) }}" method="POST"
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


