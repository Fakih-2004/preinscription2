@extends('Layouts.app') 
 
@section('content') 
<div>
    <h2   class="text-center mb-4"> Statistiques des inscriptions</h2>

    @foreach($formations as $formation)
    @php
        $annee_debut = \Carbon\Carbon::parse($formation->date_debut)->format('Y');
        $annee_fin = \Carbon\Carbon::parse($formation->date_fin)->format('Y');
    @endphp

    <div style="border: 1px solid #ccc; margin-bottom: 20px; padding: 10px;">
        <h4>
            🧾 - {{ $annee_debut }}/{{ $annee_fin }}
            ({{ $formation->type_formation }})
        </h4>
        

        <p  > Nombre de candidats inscrits : <strong>{{ $formation->inscriptions->count() }}</strong></p>
        <form method="GET" action="{{ route('export.candidats') }}">
            <input type="hidden" name="formation_id" value="{{ $formation->id }}">
            <button type="submit" class="btn btn-success">📤 Exporter les Candidats</button>
        </form>
        
    </div>
    @endforeach

</div>
@endsection
