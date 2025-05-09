@extends('utilisateur.Layouts.app')
@section('title', 'Liste des Administrateurs')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Liste Des Administrateurs</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="d-flex justify-content-end mx-3 mb-3">
                        <a href="{{ route('administrateurs.create') }}" class="btn btn-sm bg-gradient-info">
                            <i class="material-symbols-rounded me-1 text-white">add</i>
                            <span class="text-white">Ajouter un administrateur</span>
                        </a>
                    </div>
                    
                    <div class="table-responsive p-3">
                        <table id="adminTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Nom</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Prénom</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Email</th>
                                    <th class="text-secondary opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($administrateurs as $administrateur)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $administrateur->id }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $administrateur->nom }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $administrateur->prenom }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $administrateur->email }}</p>
                                    </td>
                                    <td class="align-middle text-end pe-4">
                                        <a href="{{ route('administrateurs.edit', $administrateur->id) }}" class="text-secondary font-weight-bold text-xs me-2">
                                            <i class="material-symbols-rounded">edit</i>
                                        </a>
                                        <form id="delete-form-{{ $administrateur->id }}" action="{{ route('administrateurs.destroy', $administrateur->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-link text-danger font-weight-bold text-xs p-0" onclick="confirmDelete({{ $administrateur->id }})">
                                                <i class="material-symbols-rounded">delete</i>
                                            </button>
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
    </div>
</div>

{{-- DataTables & SweetAlert --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Confirmation suppression
    function confirmDelete(id) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Activation DataTable
    $(document).ready(function () {
        $('#adminTable').DataTable({
            language: {
                search: "",
                searchPlaceholder: "Rechercher un administrateur..."
            },
            dom: '<"d-flex justify-content-start"f>t',
        });

        // Style champ recherche
        $('.dataTables_filter input').addClass('form-control border ps-3').css('width', '300px');
        $('.dataTables_filter label').addClass('me-2');
    });
</script>
@endsection
