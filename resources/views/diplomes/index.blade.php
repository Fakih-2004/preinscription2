@extends('Layouts.app')

@section('title', 'Les diplômes')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 fw-bold text-primary">Liste des diplômes</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('diplomes.create') }}" class="btn btn-sm text-white" style="background-color:blue;">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un diplôme
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light text-nowrap text-center align-middle">
                        <tr>
                            <th>ID</th>
                            <th>Candidat</th>
                            <th>Type Bac+2</th>
                            <th>Année Bac+2</th>
                            <th>Filière Bac+2</th>
                            <th>Établissement Bac+2</th>
                            <th>Scan Bac+2</th>
                            <th>Type Bac+3</th>
                            <th>Année Bac+3</th>
                            <th>Filière Bac+3</th>
                            <th>Établissement Bac+3</th>
                            <th>Scan Bac+3</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody class="text-nowrap text-center align-middle">
                        @foreach ($diplomes as $diplome)
                        <tr>
                            <td>{{ $diplome->id }}</td>
                            <td>{{ $diplome->candidat->nom ?? 'Inconnu' }} {{ $diplome->candidat->prenom ?? '' }}</td>
                            <td>{{ $diplome->{'type_diplome_bac+2'} }}</td>
                            <td>{{ $diplome->{'anne_bac+2'} }}</td>
                            <td>{{ $diplome->{'filiere_bac+2'} }}</td>
                            <td>{{ $diplome->{'etalissement_bac+2'} }}</td>
                            <td>
                                @if ($diplome->{'scan_bac+2'})
                                    <a href="{{ asset('storage/' . $diplome->{'scan_bac+2'}) }}" target="_blank">Voir scan</a>
                                @else
                                    Aucun
                                @endif
                            </td>
                            <td>{{ $diplome->{'type_bac+3'} }}</td>
                            <td>{{ $diplome->{'annee_bac+3'} }}</td>
                            <td>{{ $diplome->{'filiere_bac+3'} }}</td>
                            <td>{{ $diplome->{'etablissement_bac+3'} }}</td>
                            <td>
                                @if ($diplome->{'scan_bac+3'})
                                    <a href="{{ asset('storage/' . $diplome->{'scan_bac+3'}) }}" target="_blank">Voir scan</a>
                                @else
                                    Aucun
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('diplomes.edit', $diplome->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('diplomes.destroy', $diplome->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce diplôme ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($diplomes->isEmpty())
                        <tr>
                            <td colspan="13" class="text-center text-muted py-4">Aucun diplôme trouvé.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
