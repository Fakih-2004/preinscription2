@extends('Layouts.app') 
@section('title', 'les stage') 

@section('content') 
    <div class="container mt-4">
        <h1 class="text-center mb-4">les stages</h1>

       
                       
                        @php
                            $candidats = \App\Models\Candidat::all();
                        @endphp
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
            <th>ID</th>
            <th>fonction</th>
            <th>periode</th>
            <th>attestation</th>
            <th>etablissement</th>
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
                <td>{{ $stage->type_attestation}}</td>
                <td><a href="{{ asset('storage/' . $stage->attestation) }}" target="_blank">attestation</a></td>
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


