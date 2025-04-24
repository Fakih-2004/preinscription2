@extends('Layouts.app') 
@section('title', 'les candidat') 

@section('content') 
    <div class="container mt-4">
        <h1 class="text-center mb-4">les candidats</h1>

       

        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                    <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Nom AR</th>
            <th>Prénom AR</th>
            <th>CNE</th>
            <th>CIN</th>
            <th>Date de naissance</th>
            <th>Ville naissance</th>
            <th>Ville naissance AR</th>
            <th>Province</th>
            <th>Pays naissance</th>
            <th>Nationalité</th>
            <th>Sexe</th>
            <th>Téléphone mobile</th>
            <th>Téléphone fixe</th>
            <th>Adresse</th>
            <th>Email</th>
            <th>Ville</th>
            <th>Pays</th>
            <th>CV</th>
            <th>demande</th>
            <th>Carte d'identité</th>
            <th>Photo</th>
            <th>Série Bac</th>
            <th>Année Bac</th>
            <th>Scan Bac</th>
            <th>Actions</th>
        </tr>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidats as $candidat)
                        <tr>

                <td>{{ $candidat->id }}</td>
                <td>{{ $candidat->nom }}</td>
                <td>{{ $candidat->prenom }}</td>
                <td>{{ $candidat->nom_ar }}</td>
                <td>{{ $candidat->prenom_ar }}</td>
                <td>{{ $candidat->CNE }}</td>
                <td>{{ $candidat->CIN }}</td>
                <td>{{ $candidat->date_naissance }}</td>
                <td>{{ $candidat->ville_naissance }}</td>
                <td>{{ $candidat->ville_naissance_ar }}</td>
                <td>{{ $candidat->province }}</td>
                <td>{{ $candidat->pay_naissance }}</td>
                <td>{{ $candidat->nationalite }}</td>
                <td>{{ $candidat->sexe }}</td>
                <td>{{ $candidat->telephone_mob }}</td>
                <td>{{ $candidat->telephone_fix }}</td>
                <td>{{ $candidat->adresse }}</td>
                <td>{{ $candidat->email }}</td>
                <td>{{ $candidat->ville }}</td>
                <td>{{ $candidat->pays }}</td>
                <td><a href="{{ asset('storage/' . $candidat->cv) }}" target="_blank">Voir CV</a></td>
                <td><a href="{{ asset('storage/' . $candidat->demande) }}" target="_blank">demande</a></td>
                <td><a href="{{ asset('storage/' . $candidat->scan_cartid) }}" target="_blank">CIN</a></td>
                <td><img src="{{ asset('storage/' . $candidat->photo) }}" width="50" /></td>
                <td>{{ $candidat->serie_bac }}</td>
                <td>{{ $candidat->annee_bac }}</td>
                <td><a href="{{ asset('storage/' . $candidat->scan_bac) }}" target="_blank">Scan Bac</a></td>
    


                            <td>
                                <div class="d-flex gap-2">
                                    
                                    <form action="{{ route('candidats.destroy', $candidat->id) }}" method="POST"
                                        onsubmit="confirmDelete(event, this)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
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


