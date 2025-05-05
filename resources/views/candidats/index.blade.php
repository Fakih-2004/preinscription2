@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 fw-bold text-primary">Liste des Candidats</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('candidats.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un Candidat
        </a>
    </div>
    
    
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">            
            <div class="table-responsive">
                <table border="2" class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-nowrap text-center" colspan="21">Informations personnelles</th>
                            <th class="text-nowrap text-center" colspan="4">Pièces jointes</th>
                            <th class="text-nowrap text-center" colspan="3">Bac Info</th>
                            <th class="text-nowrap text-center" colspan="5">Diplôme Bac+2</th>
                            <th class="text-nowrap text-center" colspan="5">Diplôme Bac+3</th>
                            <th class="text-nowrap text-center" colspan="18">Stages</th>
                            <th class="text-nowrap text-center" colspan="15">Expériences</th>
                            <th class="text-nowrap text-center" colspan="9">Attestations</th>
                            <th class="text-nowrap text-center" colspan="1">Actions</th>
                        </tr>
            
            <tr class="column-headers">
                <th class="text-nowrap text-center">ID</th>
                <th class="text-nowrap text-center">Type Formation</th>
                <th class="text-nowrap text-center">Nom</th>
                <th class="text-nowrap text-center">Prénom</th>
                <th class="text-nowrap text-center">Nom AR</th>
                <th class="text-nowrap text-center">Prénom AR</th>
                <th class="text-nowrap text-center">CNE</th>
                <th class="text-nowrap text-center">CIN</th>
                <th class="text-nowrap text-center">Email</th>
                <th class="text-nowrap text-center">Date naissance</th>
                <th class="text-nowrap text-center">Ville naissance</th>
                <th class="text-nowrap text-center">Ville naissance AR</th>
                <th class="text-nowrap text-center">Province</th>
                <th class="text-nowrap text-center">Pays naissance</th>
                <th class="text-nowrap text-center">Nationalité</th>
                <th class="text-nowrap text-center">Sexe</th>
                <th class="text-nowrap text-center">Téléphone mobile</th>
                <th class="text-nowrap text-center">Téléphone fixe</th>
                <th class="text-nowrap text-center">Adresse</th>
                <th class="text-nowrap text-center">Ville</th>
                <th class="text-nowrap text-center">Pays</th>
                
                <!-- Attachments -->
                <th class="text-nowrap text-center">CV</th>
                <th class="text-nowrap text-center">Demonde</th>
                <th class="text-nowrap text-center">Carte Identité</th>
                <th class="text-nowrap text-center">Photo</th>
                
                <!-- Bac Info -->
                <th class="text-nowrap text-center">Bac Type</th>
                <th class="text-nowrap text-center">Bac Year</th>
                <th class="text-nowrap text-center">Bac Scan</th>
                
                <!-- Bac+2 -->
                <th class="text-nowrap text-center">Type Bac+2</th>
                <th class="text-nowrap text-center">Year Bac+2</th>
                <th class="text-nowrap text-center">Filière Bac+2</th>
                <th class="text-nowrap text-center">Establishment Bac+2</th>
                <th class="text-nowrap text-center">Bac+2 Scan</th>
                
                <!-- Bac+3 -->
                <th class="text-nowrap text-center">Type Bac+3</th>
                <th class="text-nowrap text-center">Year Bac+3</th>
                <th class="text-nowrap text-center">Filière Bac+3</th>
                <th class="text-nowrap text-center">Establishment Bac+3</th>
                <th class="text-nowrap text-center">Bac+3 Scan</th>
                
                <!-- Stages (3 stages) -->
                @for($i = 1; $i <= 3; $i++)
                    <th class="text-nowrap text-center">Stage {{$i}} Function</th>
                    <th class="text-nowrap text-center">Stage {{$i}} Period</th>
                    <th class="text-nowrap text-center">Stage {{$i}} Institution</th>
                    <th class="text-nowrap text-center">Stage {{$i}} Secteur d'activité</th>
                    <th class="text-nowrap text-center">Stage {{$i}} Attestation</th>
                    <th class="text-nowrap text-center">Stage {{$i}} Description</th>
                @endfor
                
                <!-- Experiences (3 experiences) -->
                @for($i = 1; $i <= 3; $i++)
                    <th class="text-nowrap text-center">Experience {{$i}} Function</th>
                    <th class="text-nowrap text-center">Experience {{$i}} Secteur d'activité</th>
                    <th class="text-nowrap text-center">Experience {{$i}} Period</th>
                    <th class="text-nowrap text-center">Experience {{$i}} Attestation</th>
                    <th class="text-nowrap text-center">Experience {{$i}} Description</th>
                @endfor
                
                <!-- Attestations (3 attestations) -->
                @for($i = 1; $i <= 3; $i++)
                    <th class="text-nowrap text-center">Attestation {{$i}} Type</th>
                    <th class="text-nowrap text-center">Attestation {{$i}} Attestation</th>
                    <th class="text-nowrap text-center">Attestation {{$i}} Description</th>
                @endfor
            </tr>
            
            <!-- Data Rows -->
            @foreach($candidats as $candidat)
            <tr>
                <!-- Personal Information -->
                <td class="text-nowrap text-center">{{ $candidat->id }}</td>
                <td>{{ $candidat->inscriptions->first()->formation->type_formation  ?? 'unkown' }}</td>
                <td class="text-nowrap text-center">{{ $candidat->nom }}</td>
                <td class="text-nowrap text-center">{{ $candidat->prenom }}</td>
                <td class="text-nowrap text-center">{{ $candidat->nom_ar }}</td>
                <td class="text-nowrap text-center">{{ $candidat->prenom_ar }}</td>
                <td class="text-nowrap text-center">{{ $candidat->CNE }}</td>
                <td class="text-nowrap text-center">{{ $candidat->CIN }}</td>
                <td class="text-nowrap text-center">
                    <a href="mailto:{{ $candidat->email }}">{{ $candidat->email }}</a>
                </td>
                <td class="text-nowrap text-center">{{ $candidat->date_naissance }}</td>
                <td class="text-nowrap text-center">{{ $candidat->ville_naissance }}</td>
                <td class="text-nowrap text-center">{{ $candidat->ville_naissance_ar }}</td>
                <td class="text-nowrap text-center">{{ $candidat->province }}</td>
                <td class="text-nowrap text-center">{{ $candidat->pay_naissance }}</td>
                <td class="text-nowrap text-center">{{ $candidat->nationalite }}</td>
                <td class="text-nowrap text-center">{{ $candidat->sexe }}</td>
                <td class="text-nowrap text-center">{{ $candidat->telephone_mob }}</td>
                <td class="text-nowrap text-center">{{ $candidat->telephone_fix }}</td>
                <td class="text-nowrap text-center">{{ $candidat->adresse }}</td>
                <td class="text-nowrap text-center">{{ $candidat->ville }}</td>
                <td class="text-nowrap text-center">{{ $candidat->pays }}</td>               
                <td class="text-nowrap text-center">
                    @if ($candidat->cv)
                    <a href="{{ asset('storage/cv/' . basename($candidat->cv)) }}" target="_blank">Voir cv</a>
                    @else
                        No CV
                    @endif
                </td>
                <td class="text-nowrap text-center">
                    @if ($candidat->demande)
                    <a href="{{ asset('storage/demande/' . basename($candidat->demande)) }}" target="_blank">Voir demande</a>
                    @else
                        No Demande
                    @endif
                </td>
                <td class="text-nowrap text-center">
                    @if ($candidat->scan_cartid)
                    <a href="{{ asset('storage/scan_cartids/' . basename($candidat->scan_cartid)) }}" target="_blank">Voir scan_cartid</a>
                    @else
                        No Carte Identité
                    @endif
                </td>
                <td class="text-nowrap text-center">
                    @if ($candidat->photo)
                    <a href="{{ asset('storage/photos/' . basename($candidat->photo)) }}" target="_blank">Voir photo</a>
                    @else
                        No Photo
                    @endif
                </td>
                            
                <!-- Bac Info -->
                <td class="text-nowrap text-center">{{ $candidat->serie_bac }}</td>
                <td class="text-nowrap text-center">{{ $candidat->annee_bac }}</td>
                <td class="text-nowrap text-center">
                    @if ($candidat->scan_bac)
                    <a href="{{ asset('storage/bac/' . basename($candidat->scan_bac)) }}" target="_blank">Voir scan_bac</a>
                    @else
                        No Scan Bac
                    @endif
                </td>
                
                <!-- Bac+2 -->
                @php $diplome = $candidat->diplomes->first(); @endphp

@if ($diplome)
    <td class="text-nowrap text-center">{{ $diplome->{'type_diplome_bac+2'} ?? '' }}</td>
    <td class="text-nowrap text-center">{{ $diplome->{'anne_bac+2'} ?? '' }}</td>
    <td class="text-nowrap text-center">{{ $diplome->{'filiere_bac+2'} ?? '' }}</td>
    <td class="text-nowrap text-center">
        @if ($diplome->{'scan_bac+2'})
            <a href="{{ asset('storage/bac_2/' . basename($diplome->{'scan_bac+2'})) }}" target="_blank">Voir scan bac+2</a>
        @else
            No scan_bac+2
        @endif
    </td>
    <td class="text-nowrap text-center">{{ $diplome->{'etalissement_bac+2'} ?? '' }}</td>

    <!-- Bac+3 -->
    <td class="text-nowrap text-center">{{ $diplome->{'type_bac+3'} ?? '' }}</td>
    <td class="text-nowrap text-center">{{ $diplome->{'annee_bac+3'} ?? '' }}</td>
    <td class="text-nowrap text-center">{{ $diplome->{'filiere_bac+3'} ?? '' }}</td>
    <td class="text-nowrap text-center">{{ $diplome->{'etablissement_bac+3'} ?? '' }}</td>
    <td class="text-nowrap text-center">
        @if ($diplome->{'scan_bac+3'})
            <a href="{{ asset('storage/bac+3/' . basename($diplome->{'scan_bac+3'})) }}" target="_blank">Voir scan bac+3</a>
        @else
            No scan_bac+3
        @endif
    </td>
@else
    <td class="text-nowrap text-center" colspan="10">Aucun diplôme disponible</td>
@endif

                <!-- Stages (3 stages) -->
                @php $stages = $candidat->stages->take(3) @endphp
                @for($i = 0; $i < 3; $i++)
                    @if(isset($stages[$i]))
                        <td class="text-nowrap text-center">{{ $stages[$i]->fonction }}</td>
                        <td class="text-nowrap text-center">{{ $stages[$i]->periode }}</td>
                        <td class="text-nowrap text-center">{{ $stages[$i]->etablissement }}</td>
                        <td class="text-nowrap text-center">{{ $stages[$i]->secteur_activite }}</td>
                        <td class="text-nowrap text-center">
                            @if ($stages[$i]->attestation)
                            <a href="{{ asset('storage/stages/' . basename($stages[$i]->attestation)) }}" target="_blank">Voir stage attestation</a>
                            @else
                                No stage attestation
                            @endif
                        </td>
                        <td class="text-nowrap text-center">{{ $stages[$i]->discription }}</td>
                    @else
                        <td class="text-nowrap text-center"></td><td class="text-nowrap text-center"></td><td class="text-nowrap text-center"></td><td class="text-nowrap text-center"></td><td class="text-nowrap text-center"></td><td class="text-nowrap text-center"></td>
                    @endif
                @endfor
                
                <!-- Experiences (3 experiences) -->
                @php $experiences = $candidat->experiences->take(3) @endphp
                @for($i = 0; $i < 3; $i++)
                    @if(isset($experiences[$i]))
                        <td class="text-nowrap text-center">{{ $experiences[$i]->fonction }}</td>
                        <td class="text-nowrap text-center">{{ $experiences[$i]->secteur_activite }}</td>
                        <td class="text-nowrap text-center">{{ $experiences[$i]->periode }}</td>
                        <td class="text-nowrap text-center">{{ $experiences[$i]->etablissement }}</td>
                        <td class="text-nowrap text-center">
                            @if ($experiences[$i]->attestation)
                            <a href="{{ asset('storage/experiences/' . basename($experiences[$i]->attestation)) }}" target="_blank">Voir Experience Attestation</a>
                            @else
                                No Experience Attestation
                            @endif
                        </td>
                        
                        <td class="text-nowrap text-center">{{ $experiences[$i]->discription }}</td>
                    @else
                    <td class="text-nowrap text-center"></td><td class="text-nowrap text-center"></td><td class="text-nowrap text-center"></td><td class="text-nowrap text-center"></td><td class="text-nowrap text-center"></td>
                    @endif
                @endfor
                
                <!-- Attestations (3 attestations) -->
                @php $attestations = $candidat->attestations->take(3) @endphp
                @for($i = 0; $i < 3; $i++)
                    @if(isset($attestations[$i]))
                        <td class="text-nowrap text-center">{{ $attestations[$i]->type_attestation }}</td>
                        <td>
                            @if ($attestations[$i]->attestation)
                                <a href="{{ asset('storage/attestations/' . basename($attestations[$i]->attestation)) }}" target="_blank">Voir Attestation</a>
                            @else
                                No Attestation
                            @endif
                        </td>
                        <td class="text-nowrap text-center">{{ $attestations[$i]->discription }}</td>
                            @else
                                <td class="text-nowrap text-center"></td>
                                <td class="text-nowrap text-center"></td>
                                <td class="text-nowrap text-center"></td>
                            @endif
                        @endfor
                <td class="text-nowrap text-center">
                
                    <a href="{{ route('candidats.edit', $candidat->id) }}" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('candidats.destroy', $candidat->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet candidat ?')"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
</div>
</div>
    </div>
</div>
@endsection


@section('styles')
<style>
    #candidats-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    #candidats-table th, 
    #candidats-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    
    .group-header th {
        background-color: #3490dc;
        color: white;
        text-align: center;
        font-weight: bold;
    }
    
    .column-headers th {
        background-color: #f8f9fa;
        font-weight: bold;
    }
    
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    
    tr:hover {
        background-color: #e9ecef;
    }
    
    a {
        color: #3490dc;
        text-decoration: none;
    }
    
    a:hover {
        text-decoration: underline;
    }
</style>
@endsection