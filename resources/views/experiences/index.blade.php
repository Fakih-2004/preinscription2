@extends('Layouts.app') 
@section('title', 'les experience') 
@section('content') 


<div class="container mt-5">
    <h1 class="text-center mb-5 fw-bold text-primary">Liste Experiences</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('experiences.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un experience
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
                            <th class="text-center">ID</th>
                            <th>nom</th>
                            <th>CIN</th>
                            <th>fonction</th>
                            <th class="text-nowrap">secteur activite</th>
                            <th>periode</th>
                            <th>attestation</th>
                            <th>établissement </th>
                            <th>description</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($experiences as $experience)
                        <tr>
                        <td class="text-nowrap">{{ $experience->id }}</td>
                        <td class="text-nowrap">{{ $experience->candidat->nom  ?? 'Non défini'}}</td>
                        <td class="text-nowrap">{{ $experience->candidat->CIN ?? 'Non défini'}}</td>
                        <td class="text-nowrap">{{ $experience->fonction }}</td>
                        <td class="text-nowrap">{{ $experience->secteur_activite }}</td>
                        <td class="text-nowrap">{{ $experience->periode }}</td>
                        <td class="text-nowrap"><a href="{{ asset('storage/' . $experience->attestation) }}" target="_blank">scan bac+2</a></td>
                        <td class="text-nowrap">{{ $experience->etablissement}}</td>
                        <td class="text-nowrap">{{ $experience->description }}</td>                    
                        <td class="text-nowrap" class="text-center">
                                <a href="{{ route('experiences.show', $experiences->id) }}" class="btn btn-sm btn-outline-info me-1">Voir</a>
                                <a href="{{ route('experiences.edit', $experiences->id) }}" class="btn btn-sm btn-outline-warning me-1">Modifier</a>
                                <form action="{{ route('experiences.destroy', $experiences->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet experiences ?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
