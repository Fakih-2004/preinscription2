@extends('Layouts.app') 
@section('title', 'les candidat') 

@section('content') 

<div class="container mt-5">
    <h1 class="text-center mb-5 fw-bold text-primary">Liste des candidats</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('candidats.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un candidats
        </a>
    </div>
    
    
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">ID</th>
                            <th  class="px-3 py-2">Nom</th>
            <th class="text-nowrap">Prénom</th>
            <th class="text-nowrap">Nom AR</th>
            <th  class="text-nowrap">Prénom AR</th>
            <th class="text-nowrap">CNE</th>
            <th class="text-nowrap">CIN</th>
            <th  class="text-nowrap">Date de naissance</th>
            <th  class="text-nowrap">Ville naissance</th>
            <th class="text-nowrap">Ville naissance AR</th>
            <th class="text-nowrap">Province</th>
            <th class="text-nowrap">Pays naissance</th>
            <th class="text-nowrap">Nationalité</th>
            <th class="text-nowrap">Sexe</th>
            <th class="text-nowrap">Téléphone mobile</th>
            <th class="text-nowrap">Téléphone fixe</th>
            <th class="text-nowrap">Adresse</th>
            <th class="text-nowrap">Email</th>
            <th class="text-nowrap">Ville</th>
            <th class="text-nowrap">Pays</th>
            <th class="text-nowrap">CV</th>
            <th class="text-nowrap">demande</th>
            <th class="text-nowrap">Carte d'identité</th>
            <th class="text-nowrap">Photo</th>
            <th class="text-nowrap">Série Bac</th>
            <th class="text-nowrap">Année Bac</th>
            <th class="text-nowrap">Scan Bac</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tbody>
            @foreach ($candidats as $candidat)
                <tr>

        <td class="text-nowrap">{{ $candidat->id }}</td>
        <td class="text-nowrap">{{ $candidat->nom }}</td>
        <td class="text-nowrap">{{ $candidat->prenom }}</td>
        <td class="text-nowrap">{{ $candidat->nom_ar }}</td>
        <td class="text-nowrap">{{ $candidat->prenom_ar }}</td>
        <td class="text-nowrap">{{ $candidat->CNE }}</td>
        <td class="text-nowrap">{{ $candidat->CIN }}</td>
        <td class="text-nowrap">{{ $candidat->date_naissance }}</td>
        <td class="text-nowrap">{{ $candidat->ville_naissance }}</td>
        <td class="text-nowrap">{{ $candidat->ville_naissance_ar }}</td>
        <td class="text-nowrap">{{ $candidat->province }}</td>
        <td class="text-nowrap">{{ $candidat->pay_naissance }}</td>
        <td class="text-nowrap">{{ $candidat->nationalite }}</td>
        <td class="text-nowrap">{{ $candidat->sexe }}</td>
        <td class="text-nowrap">{{ $candidat->telephone_mob }}</td>
        <td class="text-nowrap">{{ $candidat->telephone_fix }}</td>
        <td class="text-nowrap">{{ $candidat->adresse }}</td>
        <td class="text-nowrap">{{ $candidat->email }}</td>
        <td class="text-nowrap">{{ $candidat->ville }}</td>
        <td class="text-nowrap">{{ $candidat->pays }}</td>
        <td class="text-nowrap"><a href="{{ asset('storage/' . $candidat->cv) }}" target="_blank">Voir CV</a></td>
        <td class="text-nowrap"><a href="{{ asset('storage/' . $candidat->demande) }}" target="_blank">demande</a></td>
        <td class="text-nowrap"><a href="{{ asset('storage/' . $candidat->scan_cartid) }}" target="_blank">CIN</a></td>
        <td class="text-nowrap"><img src="{{ asset('storage/' . $candidat->photo) }}" width="50" /></td>
        <td class="text-nowrap">{{ $candidat->serie_bac }}</td>
        <td class="text-nowrap">{{ $candidat->annee_bac }}</td>
        <td class="text-nowrap"><a href="{{ asset('storage/' . $candidat->scan_bac) }}" target="_blank">Scan Bac</a></td>

        <td class="text-nowrap" class="text-center">
                                <a href="{{ route('candidats.show', $candidat->id) }}" class="btn btn-sm btn-outline-info me-1">Voir</a>
                                <a href="{{ route('candidats.edit', $candidat->id) }}" class="btn btn-sm btn-outline-warning me-1">Modifier</a>
                                <form action="{{ route('candidats.destroy', $candidat->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet candidat ?')">Supprimer</button>
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
