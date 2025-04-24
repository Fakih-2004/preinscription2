@extends('Layouts.app') 
@section('title', 'les Admins') 

@section('content') 
<div class="container mt-5">
    <h1 class="text-center mb-5 fw-bold text-primary">Liste des Administrateurs</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('administrateurs.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un administrateur
        </a>
    </div>
    
    
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-nowrap text-center">ID</th>
                            <th class="text-nowrap">Nom</th>
                            <th class="text-nowrap">Prénom</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Mot de passe</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($administrateurs as $administrateur)
                        <tr>
                            <td class="text-center">{{ $administrateur->id }}</td>
                            <td class="text-nowrap">{{ $administrateur->nom }}</td>
                            <td class="text-nowrap">{{ $administrateur->prenom }}</td>
                            <td class="text-nowrap">{{ $administrateur->email }}</td>
                            <td class="text-nowrap">{{ $administrateur->password }}</td>
                            <td class="text-nowrap text-center">
                
                                <a href="{{ route('administrateurs.edit', $administrateur->id) }}" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('administrateurs.destroy', $administrateur->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?')"><i class="bi bi-trash"></i></button>
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
