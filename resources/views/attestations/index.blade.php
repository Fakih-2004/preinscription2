@extends('Layouts.app') 
@section('title', 'les attestation') 

@section('content') 
    <div class="container mt-4">
        <h1 class="text-center mb-4">les attestations</h1>

       
                       
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


