@extends('layouts.app')

@section('content')
    <h1>Administrators</h1>
    <a href="{{ route('administrateurs.create') }}">Create New Administrator</a>
    <ul>
        @foreach ($administrateurs as $administrateur)
            <li>{{ $administrateur->name }} - <a href="{{ route('administrateurs.show', $administrateur->id) }}">View</a></li>
        @endforeach
    </ul>
@endsection
