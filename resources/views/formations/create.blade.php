@extends('Layouts.app')

@section('title', 'Ajouter un formation')

@section('content')


<div class="container mt-5">
    <h1 class="mb-4 text-primary text-center">Ajouter un nouveau formation</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('formations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            
            <div class="mb-3">
                <label>type formation</label>
                <input type="text" name="type formation" required>
            </div>

            <div class="mb-3">
                <label>date debut</label>
                <input type="date" name="date debut" class="form-control" required>
            </div>

            <div class=" mb-3">
                <label>date fin</label>
                <input type="date" name="date fin" class="form-control" required>
            </div>

            <div class="mb-3">
         <label>Administrateur</label>
        <select name="administrateur_id" class="form-control" required>
            <option value="">-- Choisir --</option>
            @foreach ($administrateurs as $administrateur)
                <option value="{{ $administrateur->id }}">
                    {{ $administrateur->prenom }} {{ $administrateur->nom }}
                </option>
            @endforeach
        </select>
    </div>


          

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
