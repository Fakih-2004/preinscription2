@extends('utilisateur.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Liste des Candidats</h6>
                        <div class="d-flex justify-content-end me-3">
                            <a href="{{ route('candidats.create') }}" class="btn btn-sm bg-gradient-info">
                                <i class="material-symbols-rounded me-1">add</i>
                                Ajouter un Candidat
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-3">
                        <table id="candidatsTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Candidat</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type Formation</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Documents</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Formation</th>
                                    <th class="text-secondary opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($candidats as $candidat)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                @if ($candidat->photo)
                                                    <img src="{{ asset('storage/photos/' . basename($candidat->photo)) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="{{ $candidat->prenom }}">
                                                @else
                                                    <img src="{{ asset('assets/img/team-2.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="default-avatar">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $candidat->prenom }} {{ $candidat->nom }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $candidat->CIN }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $candidat->inscriptions->first()->formation->type_formation ?? 'N/A' }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $candidat->telephone_mob }}</p>
                                        <p class="text-xs text-secondary mb-0">{{ $candidat->email }}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            @if ($candidat->cv)
                                                <a href="{{ asset('storage/cv/' . basename($candidat->cv)) }}" target="_blank" class="badge badge-sm bg-gradient-info me-1 mb-1">CV</a>
                                            @endif
                                            @if ($candidat->scan_bac)
                                                <a href="{{ asset('storage/bac/' . basename($candidat->scan_bac)) }}" target="_blank" class="badge badge-sm bg-gradient-success me-1 mb-1">Bac</a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @php $diplome = $candidat->diplomes->first(); @endphp
                                        @if ($diplome)
                                            <p class="text-xs font-weight-bold mb-0">{{ $diplome->{'filiere_bac+2'} ?? '' }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ $diplome->{'etablissement_bac+2'} ?? '' }}</p>
                                        @else
                                            <p class="text-xs text-secondary mb-0">Aucun diplôme</p>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('candidats.edit', $candidat->id) }}" class="text-secondary font-weight-bold text-xs me-2" data-toggle="tooltip" title="Modifier">
                                            <i class="material-symbols-rounded">edit</i>
                                        </a>
                                        <form id="delete-form-{{ $candidat->id }}" action="{{ route('candidats.destroy', $candidat->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" class="text-danger font-weight-bold text-xs" onclick="confirmDelete({{ $candidat->id }})" data-toggle="tooltip" title="Supprimer">
                                                <i class="material-symbols-rounded">delete</i>
                                            </a>
                                        </form>
                                        <a href="{{ route('candidats.show', $candidat->id) }}" class="text-info font-weight-bold text-xs ms-2" data-toggle="tooltip" title="Détails">
                                            <i class="material-symbols-rounded">visibility</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce candidat ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn bg-gradient-danger" id="confirmDeleteButton">Supprimer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
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

    function confirmDelete(id) {
        $('#confirmDeleteModal').modal('show');
        $('#confirmDeleteButton').off('click').on('click', function() {
            $('#delete-form-'+id).submit();
        });
    }
</script>
@endsection