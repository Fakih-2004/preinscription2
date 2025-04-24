@extends('Layouts.app') 
@section('title', 'les formation') 

@section('content') 
    <div class="container mt-4">
        <h1 class="text-center mb-4">les formations</h1>

                         @php
                            $formations = \App\Models\Formation::all();
                        @endphp
        <div class="mb-3">
            <a href="{{ route('formations.create') }}" class="btn btn-primary">Add formation</a>
        </div>

        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>type formation</th>
                        <th>date debut</th>
                        <th>date fin</th>
                        <th> administratreur</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($formations as $formation)
                        <tr>



                            <td>{{ $formation->id }}</td>
                            <td>{{ $formation->type_formation }}</td>
                            <td>{{ $formation->date_debut }}</td>
                            <td>{{ $formation->date_fin }}</td>
                            <td>{{ $formation->administrateur->nom  ?? 'Non défini'}}</td>


                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('formations.edit', $formation->id) }}"
                                        class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('formations.destroy', $formation->id) }}" method="POST"
                                        onsubmit="confirmDelete(event, this)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
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


