@extends('layouts')

@section('title', 'Create Administrator')

@section('content')
    <form action="{{ route('administrateurs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">nom</label>
            <input type="text" nom="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="prenom">prenom</label>
            <input type="text" prenom="prenom" class="form-control" required>
        </div><div class="form-group">
            <label for="password">password</label>
            <input type="text" password="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
@endsection
