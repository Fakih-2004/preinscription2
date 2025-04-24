@extends('layouts')

@section('title', 'Show Administrator')

@section('content')
    <h3>nom{{ $administrateur->nom }}</h3>
    <h3>prenom{{ $administrateur->prenom }}</h3>
    <p>Email: {{ $administrateur->email }}</p>
    <a href="{{ route('administrateurs.edit', $administrateur->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('administrateurs.destroy', $administrateur->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
