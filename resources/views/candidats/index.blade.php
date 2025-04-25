@extends('Layouts.app') 

@section('title', 'Les candidats') 

@section('content') 
<div class="container mt-5">
    <h1 class="text-center mb-5 fw-bold text-primary">Liste des candidats</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('candidats.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un candidat
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light text-nowrap text-center align-middle">
                        <tr>
                            <th>ID</th>
                            <th>Type formation</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Nom AR</th>
                            <th>Prénom AR</th>
                            <th>CNE</th>
                            <th>CIN</th>
                            <th>Email</th>
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
                            <th>Ville</th>
                            <th>Pays</th>
                            <th>CV</th>
                            <th>Demande</th>
                            <th>Carte d'identité</th>
                            <th>Photo</th>
                            <th>Série Bac</th>
                            <th>Année Bac</th>
                            <th>Scan Bac</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody class="text-nowrap">
                        @foreach ($candidats as $candidat)
                        <tr>
                            <td>{{ $candidat->id }}</td>
                            <td>{{ $candidat->inscriptions->first()->formation->type_formation ?? '—' }}</td>
                            <td>{{ $candidat->nom }}</td>
                            <td>{{ $candidat->prenom }}</td>
                            <td>{{ $candidat->nom_ar }}</td>
                            <td>{{ $candidat->prenom_ar }}</td>
                            <td>{{ $candidat->CNE }}</td>
                            <td>{{ $candidat->CIN }}</td>
                            <td>{{ $candidat->email }}</td>
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
                            <td>{{ $candidat->ville }}</td>
                            <td>{{ $candidat->pays }}</td>
                            <td>
                                @if ($candidat->cv)
                                    <a href="{{ asset(str_replace('public/', 'storage/', $candidat->cv)) }}" target="_blank">Voir CV</a>
                                @else
                                    No CV
                                @endif
                            </td>
                            
                            
                            <td>
                                @if ($candidat->demande)
                                    <a href="{{ asset(str_replace('public/', 'storage/', $candidat->demande)) }}" target="_blank">Voir demande</a>
                                @else
                                    No demande
                                @endif
                            </td>
                            
                            <td>
                                @if ($candidat->scan_cartid)
                                    <a href="{{ asset(str_replace('public/', 'storage/', $candidat->scan_cartid)) }}" target="_blank">Voir CIN</a>
                                @else
                                    No CIN
                                @endif
                            </td>
                            
                            
                            <td>
                                @if ($candidat->photo)
                                    <a href="{{ asset(str_replace('public/', 'storage/', $candidat->photo)) }}" target="_blank">Voir photo</a>
                                @else
                                    No photo
                                @endif
                            </td>
                            
                            <td>{{ $candidat->serie_bac }}</td>
                            <td>{{ $candidat->annee_bac }}</td>
                            <td>
                                @if ($candidat->scan_bac)
                                    <a href="{{ asset(str_replace('public/', 'storage/', $candidat->scan_bac)) }}" target="_blank">Voir Bac</a>
                                @else
                                    No Bac
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('candidats.edit', $candidat->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('candidats.destroy', $candidat->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce candidat ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($candidats->isEmpty())
                            <tr>
                                <td colspan="28" class="text-center text-muted py-4">Aucun candidat trouvé.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
