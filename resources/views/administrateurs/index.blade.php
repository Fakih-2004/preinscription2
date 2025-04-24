@extends('layouts')

@section('title', 'Administrators')

@section('content')
    <a href="{{ route('administrateurs.create') }}" class="btn btn-success mb-2">Create Administrator</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>nom</th>
                <th>prenom</th>
                <th>Email</th>
                <th>password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($administrateurs as $administrateur)
                <tr>
                    <td>{{ $administrateur->nom }}</td>
                    <td>{{ $administrateur->prenom }}</td>
                    <td>{{ $administrateur->email }}</td>
                    <td>{{ $administrateur->password }}</td>

                    <td>
                        <a href="{{ route('administrateurs.show', $administrateur->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('administrateurs.edit', $administrateur->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('administrateurs.destroy', $administrateur->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
