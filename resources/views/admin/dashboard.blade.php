@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>

    <!-- Manage Librarians Section -->
    <h2>Manage Librarians</h2>
    <a href="{{ route('librarian.create') }}" class="btn btn-primary">Add Librarian</a>

    <h3>Existing Librarians</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($librarians as $librarian)
            <tr>
                <td>{{ $librarian->name }}</td>
                <td>{{ $librarian->email }}</td>
                <td>
                    <form action="{{ route('librarian.destroy', $librarian->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
     <!-- Manage Collection Requests Section -->
     <h2>Manage Collection Update Requests</h2>
     <a href="{{ route('collection.requests.index') }}" class="btn btn-info">View Collection Requests</a>
</div>
@endsection
