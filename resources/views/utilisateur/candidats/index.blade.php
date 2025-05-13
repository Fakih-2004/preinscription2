@extends('utilisateur.layouts.app')

@section('content')
<div class="container-fluid py-4" >
    <div class="row" >
        <div class="col-12" >
           <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="border-radius-lg pt-4 pb-3" style="background-color: #1a4b8c; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <h6 class="text-white text-capitalize ps-3">Liste des Candidats</h6>                        
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="d-flex justify-content-end mx-3 mb-3">
                        <a href="{{ route('candidats.create') }}" class="btn btn-sm text-white" style="background-color: #1a4b8c;">
                            <i class="material-symbols-rounded me-1 text-white">add</i>
                            <span class="text-white">Ajouter un Candidat</span>
                        </a>
                    </div>
                
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-3">
                        <table id="candidatsTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-items-center">Photo & Info</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-items-center">Formation</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CIN & Naissance</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Documents</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bac</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bac+2</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bac+3</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 ">Stages</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Expériences</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Attestations</th>
                                    <th class="text-secondary opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($candidats as $candidat)
                                @php
                                    $diplome = $candidat->diplomes->first();
                                    $stages = $candidat->stages->take(3);
                                    $experiences = $candidat->experiences->take(3);
                                    $attestations = $candidat->attestations->take(3);
                                @endphp
                                <tr>
                                    <!-- Photo & Info -->
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                @if ($candidat->photo)
                                                <a href="{{ asset('storage/photos/' . basename($candidat->photo)) }}" target="_blank">
                                                    <img src="{{ asset('storage/photos/' . basename($candidat->photo)) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="photo">
                                                </a>
                                                @else
                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="default">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"> {{ $candidat->nom }}{{ $candidat->prenom }}</h6>
                                                <h6 class="mb-0 text-sm"> {{ $candidat->nom_ar }}{{ $candidat->prenom_ar }}</h6>
                                                <p class="text-xs text-secondary mb-0">CNE: {{ $candidat->CNE }}</p>
                                                <p class="text-xs text-secondary mb-0">CIN: {{ $candidat->CIN }}</p>
                                                <p class="text-xs text-secondary mb-0">Sexe: {{ $candidat->sexe }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Formation -->
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $candidat->inscriptions->first()->formation->type_formation ?? 'Unknown' }}</h6>
                                            <p class="text-xs font-weight-bold mb-0">{{ $candidat->inscriptions->first()->formation->titre ?? '' }}</p>
                                        </div>
                                    </td>
                                    
                                    <!-- Contact -->
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Mobile:{{ $candidat->telephone_mob }}</p>
                                        <p class="text-xs text-secondary mb-0">Fix:{{ $candidat->telephone_fix }}</p>
                                        <p class="text-xs text-secondary mb-0">Email:{{ $candidat->email }}</p>
                                        <p class="text-xs text-secondary mb-0">Address:{{ $candidat->adresse }}</p>
                                        <p class="text-xs text-secondary mb-0">Province:{{ $candidat->province }}</p>
                                        <p class="text-xs text-secondary mb-0">Ville{{ $candidat->ville }}</p>
                                        <p class="text-xs text-secondary mb-0">Pays {{ $candidat->pays }}</p>
                                    </td>
                                    
                                    <!-- CIN & Naissance -->
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">                                              
                                            
                                            <p class="mb-0 text-sm">Né(e) le: {{ $candidat->date_naissance }}</p>
                                            <p class="text-xs text-secondary mb-0">À: {{ $candidat->ville_naissance }}  {{ $candidat->ville_naissance_ar }}</p>
                                            <p class="text-xs text-secondary mb-0">Nationalité: {{ $candidat->nationalite }}</p>
                                            @if ($candidat->scan_cartid)
                                            <a href="{{ asset('storage/cin/' . basename($candidat->scan_cartid)) }}" target="_blank" class="badge badge-sm text-white" style="background-color: #1a4b8c; border: none;  width: 100px; border-radius: 6px;">Voir CIN</a>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <!-- Documents -->
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            @if ($candidat->cv)
                                            <a href="{{ asset('storage/cv/' . basename($candidat->cv)) }}" target="_blank" class="badge badge-sm text-white" style="background-color: #1a4b8c; border: none; margin-bottom: 10px;  width: 100px; border-radius: 6px;">CV</a>
                                            @endif
                                            @if ($candidat->demande)
                                            <a href="{{ asset('storage/demande/' . basename($candidat->demande)) }}" target="_blank" class="badge badge-sm text-white" style="background-color: #1a4b8c; border: none;  width: 100px; border-radius: 6px;">Demande</a>
                                            @endif
                                            
                                        </div>
                                    </td>
                                    
                                    <!-- Bac -->
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Type: {{ $candidat->serie_bac }}</p>
                                        <p class="text-xs text-secondary mb-0">Année: {{ $candidat->annee_bac }}</p>
                                        @if ($candidat->scan_bac)
                                        <a href="{{ asset('storage/bac/' . basename($candidat->scan_bac)) }}" target="_blank" class="badge badge-sm text-white" style="background-color: #1a4b8c; border: none;  width: 100px; border-radius: 6px;">Voir Bac</a>
                                        @endif
                                    </td>
                                    
                                    <!-- Bac+2 -->
                                    <td>
                                        @if ($diplome)
                                        <p class="text-xs font-weight-bold mb-0">Type: {{ $diplome->{'type_diplome_bac+2'} ?? '' }}</p>
                                        <p class="text-xs text-secondary mb-0">Filière: {{ $diplome->{'filiere_bac+2'} ?? '' }}</p>
                                        <p class="text-xs text-secondary mb-0">Étab: {{ $diplome->{'etalissement_bac+2'} ?? '' }}</p>
                                        <p class="text-xs text-secondary mb-0">Année: {{ $diplome->{'anne_bac+2'} ?? '' }}</p>
                                        @if ($diplome->{'scan_bac+2'})
                                        <a href="{{ asset('storage/bac_2/' . basename($diplome->{'scan_bac+2'})) }}" target="_blank" class="badge badge-sm text-white" style="background-color: #1a4b8c; border: none;  width: 100px; border-radius: 6px;">Voir</a>
                                        @endif
                                        @else
                                        <p class="text-xs text-secondary mb-0">Aucun diplôme</p>
                                        @endif
                                    </td>
                                    
                                    <!-- Bac+3 -->
                                    <td>
                                        @if ($diplome)
                                        <p class="text-xs font-weight-bold mb-0">Type: {{ $diplome->{'type_bac+3'} ?? '' }}</p>
                                        <p class="text-xs text-secondary mb-0">Filière: {{ $diplome->{'filiere_bac+3'} ?? '' }}</p>
                                        <p class="text-xs text-secondary mb-0">Étab: {{ $diplome->{'etablissement_bac+3'} ?? '' }}</p>
                                        <p class="text-xs text-secondary mb-0">Année: {{ $diplome->{'annee_bac+3'} ?? '' }}</p>
                                        @if ($diplome->{'scan_bac+3'})
                                        <a href="{{ asset('storage/bac+3/' . basename($diplome->{'scan_bac+3'})) }}" target="_blank" class="badge badge-sm text-white" style="background-color: #1a4b8c; border: none;  width: 100px; border-radius: 6px;">Voir</a>
                                        @endif
                                        @else
                                        <p class="text-xs text-secondary mb-0">Aucun diplôme</p>
                                        @endif
                                    </td>
                                    
                                    <!-- Stages -->
                                    <td>
                                        @foreach($stages as $stage)
                                        <div class="d-inline-block me-2" style="width: 150px; vertical-align: top;">
                                            <p class="text-xs font-weight-bold mb-0">{{ $stage->fonction }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ $stage->etablissement }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ $stage->periode }}</p>
                                            <p class="text-xs text-secondary mb-0 text-truncate" style="max-width: 150px;" title="{{ $stage->discription }}">
                                                {{ Str::limit($stage->discription, 20) }}
                                            </p>
                                            @if ($stage->attestation)
                                            <a href="{{ asset('storage/stages/' . basename($stage->attestation)) }}" target="_blank" class="badge badge-sm text-white" style="background-color: #1a4b8c; border: none;  width: 100px; border-radius: 6px;">Attestation</a>
                                            @endif
                                            
                                        </div>
                                        @endforeach
                                    </td>

                                    <!-- Experiences -->
                                    <td>
                                        @foreach($experiences as $experience)
                                        <div class="d-inline-block me-2" style="width: 150px; vertical-align: top;">
                                            <p class="text-xs font-weight-bold mb-0">{{ $experience->fonction }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ $experience->etablissement }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ $experience->periode }}</p>
                                            <p class="text-xs text-secondary mb-0 text-truncate" style="max-width: 150px;" title="{{ $experience->discription }}">
                                                {{ Str::limit($experience->discription, 20) }}
                                            </p>
                                            @if ($experience->attestation)
                                            <a href="{{ asset('storage/experiences/' . basename($experience->attestation)) }}" target="_blank" class="badge badge-sm text-white" style="background-color: #1a4b8c; border: none;  width: 100px; border-radius: 6px;">Attestation</a>
                                            @endif
                                        </div>
                                        @endforeach
                                    </td>

                                    <!-- Attestations -->
                                    <td>
                                        @foreach($attestations as $attestation)
                                        <div class="d-inline-block me-2" style="width: 150px; vertical-align: top;">
                                            <p class="text-xs font-weight-bold mb-0">{{ $attestation->type_attestation }}</p>
                                            <p class="text-xs text-secondary mb-0 text-truncate" style="max-width: 150px;" title="{{ $attestation->discription }}">
                                                {{ Str::limit($attestation->discription, 20) }}
                                            </p>
                                            @if ($attestation->attestation)
                                            <a href="{{ asset('storage/attestations/' . basename($attestation->attestation)) }}" target="_blank" class="badge badge-sm text-white" style="background-color: #1a4b8c; border: none;  width: 100px; border-radius: 6px;">Voir</a>
                                            @endif
                                        </div>
                                        @endforeach
                                    </td>
                                    <!-- Actions -->
                                 <td class="align-middle">
                                    <div class="d-flex">       
                                        <form action="{{ route('candidats.destroy', $candidat->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                         class="btn btn-link text-danger font-weight-bold text-xs p-0 border-0 bg-transparent" 
                                                         onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet candidat ?')">
                                                         <i class="material-symbols-rounded">delete</i>
                                                        </button>
                                                    </form>
                                    </div>
                                </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@section('scripts')

 

<!-- DataTables Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
       


    // Add this at the top of your scripts section





    $(document).ready(function() {
        $('#candidatsTable').DataTable({
            language: {
                search: "",
                searchPlaceholder: "Rechercher un candidat...",
                paginate: {
                    previous: '<i class="material-symbols-rounded">chevron_left</i>',
                    next: '<i class="material-symbols-rounded">chevron_right</i>'
                }
            },
            dom: '<"d-flex justify-content-between"lf>rt<"d-flex justify-content-between"ip>'
        });

        // Style the search bar
        $('.dataTables_filter input').addClass('form-control');
        $('.dataTables_filter label').addClass('search-container');
    });

  
</script>
@endsection

@endsection