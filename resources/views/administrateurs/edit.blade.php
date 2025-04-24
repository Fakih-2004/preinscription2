@extends('layouts')
@section('title', 'Edit Administrator')

@section('content')
    <form action="{{ route('administrateurs.update', $administrateur->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $administrateur->nom }}" required>
        </div>
        <div class="form-group">
            <label for="prenom">prenom</label>
            <input type="prenom" name="prenom" class="form-control" value="{{ $administrateur->prenom }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $administrateur->email }}" required>
        </div>
        <div class="form-group">
            <label for="password">password</label>
            <input type="password" name="password" class="form-control" value="{{ $administrateur->password }}" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
