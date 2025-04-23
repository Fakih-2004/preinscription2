@extends('layouts.app')

@section('content')
    <h1>{{ $administrateur->name }}</h1>
    <p>Email: {{ $administrateur->email }}</p>
    <a href="{{ route('administrateurs.edit', $administrateur->id) }}">Edit</a>
@endsection
