@extends('layouts.app')

@section('content')
    <h1>Edit Administrator</h1>
    <form action="{{ route('administrateurs.update', $administrateur->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $administrateur->name }}" placeholder="Name">
        <input type="email" name="email" value="{{ $administrateur->email }}" placeholder="Email">
        <button type="submit">Update</button>
    </form>
@endsection
