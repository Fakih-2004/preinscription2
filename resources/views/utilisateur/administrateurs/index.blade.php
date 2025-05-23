@extends('utilisateur.Layouts.app')
@section('title', 'Liste des Administrateurs')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="border-radius-lg pt-4 pb-3" style="background-color: #1a4b8c; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <h6 class="text-white text-capitalize ps-3">Liste Des Administrateurs</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="d-flex justify-content-end mx-3 mb-3">
                        <a href="{{ route('administrateurs.create') }}" class="btn btn-sm text-white" style="background-color: #1a4b8c;">
                            <i class="material-symbols-rounded me-1">add</i>
                            <span>Ajouter un administrateur</span>
                        </a>
                    </div>
                    @php
                        $placeholder = 'Rechercher un Administrateur...';
                    @endphp
                    <div class="table-responsive p-3">
                        <table id="searshTable" class="table align-items-center mb-0">
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
                                    <td class="align-center text-end pe-4">
                                        <a href="{{ route('administrateurs.edit', $administrateur->id) }}" class="text-secondary font-weight-bold text-xs me-2">
                                            <i class="material-symbols-rounded">edit</i>
                                        </a>
                                       <form id="delete-form-{{ $administrateur->id }}" 
                                            action="{{ route('administrateurs.destroy', $administrateur->id) }}" 
                                            method="POST" 
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    onclick="confirmDelete({{ $administrateur->id }}, this, 'cette administrateur')" 
                                                    class="btn btn-link text-danger p-0">
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
@endsection