@extends('layouts.app')

@section('content')
    <h1>Create Administrator</h1>
    <form action="{{ route('administrateurs.store') }}" method="POST">
        @csrf
        <input type="text" name="nom" placeholder="nom">
        <input type="text" name="prenom" placeholder="prenom">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="password">
        <button type="submit">Create</button>
    </form>
@endsection
