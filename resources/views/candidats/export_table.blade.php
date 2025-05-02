<!-- resources/views/candidats/export_table.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Candidats List</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered" id="candidats-table">
            <!-- Group Headers Row -->
            <tr class="group-header">
                <th colspan="21">Informations personnelles</th>
                <th colspan="4">Pièces jointes</th>
                <th colspan="3">Bac Info</th>
                <th colspan="4">Diplôme Bac+2</th>
                <th colspan="4">Diplôme Bac+3</th>
                <th colspan="15">Stages</th>
                <th colspan="12">Expériences</th>
                <th colspan="6">Attestations</th>
            </tr>
            
            <!-- Column Headers Row -->
            <tr class="column-headers">
                <!-- Personal Information -->
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nom AR</th>
                <th>Prénom AR</th>
                <th>CNE</th>
                <th>CIN</th>
                <th>Email</th>
                <th>Date naissance</th>
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
                
                <!-- Attachments -->
                <th>CV</th>
                <th>Demande</th>
                <th>Carte Identité</th>
                <th>Photo</th>
                
                <!-- Bac Info -->
                <th>Bac Type</th>
                <th>Bac Year</th>
                <th>Bac Scan</th>
                
                <!-- Bac+2 -->
                <th>Type Bac+2</th>
                <th>Year Bac+2</th>
                <th>Filière Bac+2</th>
                <th>Establishment Bac+2</th>
                
                <!-- Bac+3 -->
                <th>Type Bac+3</th>
                <th>Year Bac+3</th>
                <th>Filière Bac+3</th>
                <th>Establishment Bac+3</th>
                
                <!-- Stages (3 stages) -->
                @for($i = 1; $i <= 3; $i++)
                    <th>Stage {{$i}} Function</th>
                    <th>Stage {{$i}} Period</th>
                    <th>Stage {{$i}} Institution</th>
                    <th>Stage {{$i}} Sector</th>
                    <th>Stage {{$i}} Description</th>
                @endfor
                
                <!-- Experiences (3 experiences) -->
                @for($i = 1; $i <= 3; $i++)
                    <th>Experience {{$i}} Function</th>
                    <th>Experience {{$i}} Sector</th>
                    <th>Experience {{$i}} Period</th>
                    <th>Experience {{$i}} Institution</th>
                @endfor
                
                <!-- Attestations (3 attestations) -->
                @for($i = 1; $i <= 3; $i++)
                    <th>Attestation {{$i}} Type</th>
                    <th>Attestation {{$i}} Description</th>
                @endfor
            </tr>
            
            <!-- Data Rows -->
            @foreach($candidats as $candidat)
            <tr>
                <!-- Personal Information -->
                <td>{{ $candidat->id }}</td>
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
                
                <!-- Attachments -->
                <td>
                    @if($candidat->cv)
                        <a href="{{ Storage::url($candidat->cv) }}" target="_blank">View CV</a>
                    @endif
                </td>
                <td>
                    @if($candidat->demande)
                        <a href="{{ Storage::url($candidat->demande) }}" target="_blank">View Demande</a>
                    @endif
                </td>
                <td>
                    @if($candidat->scan_cartid)
                        <a href="{{ Storage::url($candidat->scan_cartid) }}" target="_blank">View CIN</a>
                    @endif
                </td>
                <td>
                    @if($candidat->photo)
                        <a href="{{ Storage::url($candidat->photo) }}" target="_blank">View Photo</a>
                    @endif
                </td>
                
                <!-- Bac Info -->
                <td>{{ $candidat->serie_bac }}</td>
                <td>{{ $candidat->annee_bac }}</td>
                <td>
                    @if($candidat->scan_bac)
                        <a href="{{ Storage::url($candidat->scan_bac) }}" target="_blank">View Bac</a>
                    @endif
                </td>
                
                <!-- Bac+2 -->
                @php $diplome = $candidat->diplomes->first() @endphp
                <td>{{ $diplome->{'type_diplome_bac+2'} ?? '' }}</td>
                <td>{{ $diplome->{'anne_bac+2'} ?? '' }}</td>
                <td>{{ $diplome->filiere_bac+2 ?? '' }}</td>
                <td>{{ $diplome->etalissement_bac+2 ?? '' }}</td>
                
                <!-- Bac+3 -->
                <td>{{ $diplome->type_bac+3 ?? '' }}</td>
                <td>{{ $diplome->annee_bac+3 ?? '' }}</td>
                <td>{{ $diplome->filiere_bac+3 ?? '' }}</td>
                <td>{{ $diplome->etablissement_bac+3 ?? '' }}</td>
                
                <!-- Stages (3 stages) -->
                @php $stages = $candidat->stages->take(3) @endphp
                @for($i = 0; $i < 3; $i++)
                    @if(isset($stages[$i]))
                        <td>{{ $stages[$i]->fonction }}</td>
                        <td>{{ $stages[$i]->periode }}</td>
                        <td>{{ $stages[$i]->etablissement }}</td>
                        <td>{{ $stages[$i]->secteur_activite }}</td>
                        <td>{{ $stages[$i]->discription }}</td>
                    @else
                        <td></td><td></td><td></td><td></td><td></td>
                    @endif
                @endfor
                
                <!-- Experiences (3 experiences) -->
                @php $experiences = $candidat->experiences->take(3) @endphp
                @for($i = 0; $i < 3; $i++)
                    @if(isset($experiences[$i]))
                        <td>{{ $experiences[$i]->fonction }}</td>
                        <td>{{ $experiences[$i]->secteur_activite }}</td>
                        <td>{{ $experiences[$i]->periode }}</td>
                        <td>{{ $experiences[$i]->etablissement }}</td>
                    @else
                        <td></td><td></td><td></td><td></td>
                    @endif
                @endfor
                
                <!-- Attestations (3 attestations) -->
                @php $attestations = $candidat->attestations->take(3) @endphp
                @for($i = 0; $i < 3; $i++)
                    @if(isset($attestations[$i]))
                        <td>{{ $attestations[$i]->type_attestation }}</td>
                        <td>{{ $attestations[$i]->discription }}</td>
                    @else
                        <td></td><td></td>
                    @endif
                @endfor
            </tr>
            @endforeach
        </table>
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