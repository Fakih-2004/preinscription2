@extends('Layouts.app') 
@section('title', 'les inscription') 

@section('content') 
    <div class="container mt-4">
        <h1 class="text-center mb-4">les inscriptions</h1>

       
                        @php
                            $candidats = \App\Models\Candidat::all();
                        @endphp
                        @php
                            $formations = \App\Models\Formation::all();
                        @endphp
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
            <th>ID</th>
            <th></th>
            <th>Année de bac+2</th>
            <th>Filier de bac+2</th>
            <th>scan de bac+2</th>
            <th>établissement (bac+2)</th>
            <th>type de inscription bac+3</th>
            <th>Année de bac+3</th>
            <th>filier de bac+3</th>
            <th>établissement (bac+3)</th>
            <th>scan de bac+3</th>
            <th>Actions</th>
        </tr>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($inscriptions as $inscription)
                        <tr>

                <td>{{ $inscription->id }}</td>
                <td>{{ $inscription->candidat->nom  ?? 'Non défini'}}</td>
                <td>{{ $inscription->type_inscription_bac+2 }}</td>
                <td>{{ $inscription->annee_bac+2 }}</td>
                <td>{{ $inscription->filier_bac+2 }}</td>
                <td><a href="{{ asset('storage/' . $inscription->scan_bac+2) }}" target="_blank">scan bac+2</a></td>
                <td>{{ $inscription->etablissement}}</td>
                <td>{{ $inscription->type_inscription_bac+3 }}</td>
                <td>{{ $inscription->annee_bac+3 }}</td>
                <td>{{ $inscription->filier_bac+3 }}</td>
                <td><a href="{{ asset('storage/' . $inscription->scan_bac+3) }}" target="_blank">scan bac+3</a></td>
                <td>{{ $inscription->etablissement}}</td>
             
                            <td>
                                <div class="d-flex gap-2">
                                    
                                    <form action="{{ route('inscriptions.destroy', $inscription->id) }}" method="POST"
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


