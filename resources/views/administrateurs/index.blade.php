@extends('Layouts.app') 
@section('title', 'les candidat') 

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
                            <th class="text-center">ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Mot de passe</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($administrateurs as $administrateur)
                        <tr>
                            <td class="text-center">{{ $administrateur->id }}</td>
                            <td>{{ $administrateur->nom }}</td>
                            <td>{{ $administrateur->prenom }}</td>
                            <td>{{ $administrateur->email }}</td>
                            <td>{{ $administrateur->password }}</td>
                            <td class="text-center">
                                <a href="{{ route('administrateurs.show', $administrateur->id) }}" class="btn btn-sm btn-outline-info me-1">Voir</a>
                                <a href="{{ route('administrateurs.edit', $administrateur->id) }}" class="btn btn-sm btn-outline-warning me-1">Modifier</a>
                                <form action="{{ route('administrateurs.destroy', $administrateur->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?')">Supprimer</button>
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
