<!-- resources/views/candidats/export_table.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Candidats List</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered" id="candidats-table">
            <!-- Group Headers Row -->
            <tr class="group-header">
                <th class="text-nowrap text-center" colspan="21">Informations personnelles</th>
                <th class="text-nowrap text-center" colspan="4">Pièces jointes</th>
                <th class="text-nowrap text-center" colspan="3">Bac Info</th>
                <th class="text-nowrap text-center" colspan="4">Diplôme Bac+2</th>
                <th class="text-nowrap text-center" colspan="4">Diplôme Bac+3</th>
                <th class="text-nowrap text-center" colspan="15">Stages</th>
                <th class="text-nowrap text-center" colspan="12">Expériences</th>
                <th class="text-nowrap text-center" colspan="6">Attestations</th>
            </tr>
            
            <!-- Column Headers Row -->
            <tr class="column-headers">
                <!-- Personal Information -->
                <th class="text-nowrap text-center">ID</th>
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
                <th class="text-nowrap text-center">cv</th>
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
                
                <!-- Bac+3 -->
                <th class="text-nowrap text-center">Type Bac+3</th>
                <th class="text-nowrap text-center">Year Bac+3</th>
                <th class="text-nowrap text-center">Filière Bac+3</th>
                <th class="text-nowrap text-center">Establishment Bac+3</th>
                
                <!-- Stages (3 stages) -->
                @for($i = 1; $i <= 3; $i++)
                    <th class="text-nowrap text-center">Stage {{$i}} Function</th>
                    <th class="text-nowrap text-center">Stage {{$i}} Period</th>
                    <th class="text-nowrap text-center">Stage {{$i}} Institution</th>
                    <th class="text-nowrap text-center">Stage {{$i}} Sector</th>
                    <th class="text-nowrap text-center">Stage {{$i}} Description</th>
                @endfor
                
                <!-- Experiences (3 experiences) -->
                @for($i = 1; $i <= 3; $i++)
                    <th class="text-nowrap text-center">Experience {{$i}} Function</th>
                    <th class="text-nowrap text-center">Experience {{$i}} Sector</th>
                    <th class="text-nowrap text-center">Experience {{$i}} Period</th>
                    <th class="text-nowrap text-center">Experience {{$i}} Institution</th>
                @endfor
                
                <!-- Attestations (3 attestations) -->
                @for($i = 1; $i <= 3; $i++)
                    <th class="text-nowrap text-center">Attestation {{$i}} Type</th>
                    <th class="text-nowrap text-center">Attestation {{$i}} Description</th>
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
                

                <td>
                    @if ($candidat->cv)
                        <a href="{{ asset(str_replace('public/', 'storage/', $candidat->cv)) }}" target="_blank">Voir cv</a>
                    @else
                        No cv
                    @endif
               
                    <td>
                        @if ($candidat->demande)
                            <a href="{{ asset(str_replace('public/', 'storage/', $candidat->demande)) }}" target="_blank">Voir demande</a>
                        @else
                            No demande
                        @endif
                    </td>
         <td>
            @if ($candidat->scan_cartid)
                <a href="{{ asset(str_replace('public/', 'storage/', $candidat->scan_cartid)) }}" target="_blank">Voir scan_cartid</a>
            @else
                No scan_cartid
            @endif
           </td>
<td>
    @if ($candidat->photo)
        <a href="{{ asset(str_replace('public/', 'storage/', $candidat->photo)) }}" target="_blank">Voir photo</a>
    @else
        No photo
    @endif
           </td>
                
                <!-- Bac Info -->
                <td>{{ $candidat->serie_bac }}</td>
                <td>{{ $candidat->annee_bac }}</td>
                <td>
                    @if ($candidat->scan_bac)
                        <a href="{{ asset(str_replace('public/', 'storage/', $candidat->scan_bac)) }}" target="_blank">Voir scan_bac</a>
                    @else
                        No scan_bac
                    @endif
                </td>
                
                <!-- Bac+2 -->
                @php $diplome = $candidat->diplomes->first() @endphp
                <td>{{ $diplome->{'type_diplome_bac+2'} ?? '' }}</td>
                <td>{{ $diplome->{'anne_bac+2'} ?? '' }}</td>
                <td>{{ $diplome->{'filiere_bac+2'} ?? '' }}</td>
                <td>{{ $diplome->{'etalissement_bac+2'} ?? '' }}</td>
                
                <!-- Bac+3 -->
                <td>{{ $diplome->{'type_bac+3'} ?? '' }}</td>
                <td>{{ $diplome->{'annee_bac+3'} ?? '' }}</td>
                <td>{{ $diplome->{'filiere_bac+3'} ?? '' }}</td>
                <td>{{ $diplome->{'etablissement_bac+3'} ?? '' }}</td>
                
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