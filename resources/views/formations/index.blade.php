@extends('Layouts.app') 
@section('title', 'les formation') 

@section('content') 
    <div class="container mt-4">
        <h1 class="text-center mb-4">les formations</h1>

                         @php
                            $formations = \App\Models\Formation::all();
                        @endphp
                        <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('formations.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un formation
        </a>
    </div>

        
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                       
                        <th>type formation</th>
                        <th>Titre</th>
                        <th>date debut</th>
                        <th>date fin</th>
                        <th> administratreur</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($formations as $formation)
                        <tr>



                            
                            <td>{{ $formation->type_formation }}</td>
                            <td>{{ $formation->titre }}</td>
                            <td>{{ $formation->date_debut }}</td>
                            <td>{{ $formation->date_fin }}</td>
                            <td>{{ $formation->administrateur->nom  ?? 'Non défini'}}</td>


                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('formations.edit', $formation->id) }}"
                                        class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('formations.destroy', $formation->id) }}" method="POST"
                                        onsubmit="confirmDelete(event, this)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>
    @endsection


