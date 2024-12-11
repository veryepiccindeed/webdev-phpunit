@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Collection Update Requests</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Librarian</th>
                <th>Category</th>
                <th>Requested Changes</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
            <tr>
                <td>
                    @if($request->librarian)  <!-- Ensure librarian is loaded -->
                        {{ $request->librarian->name }}  <!-- Display the librarian's name -->
                    @else
                        <em>Unknown Librarian</em>  <!-- Handle case where librarian is not found -->
                    @endif
                </td>
                <td>{{ $request->category }}</td>
                <td>
                    <ul>
                        <li><strong>Title:</strong> {{ $request->new_title }}</li>
                        <li><strong>Author:</strong> {{ $request->new_author }}</li>
                        <li><strong>Publisher:</strong> {{ $request->new_publisher }}</li>
                        <li><strong>Price:</strong> {{ number_format($request->new_price, 2) }}</li>
                        <li><strong>Stock:</strong> {{ $request->new_stock }}</li>
                    </ul>
                </td>
                <td>{{ ucfirst($request->status) }}</td>
                <td>
                    <form action="{{ route('collection.requests.approve', $request->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <form action="{{ route('collection.requests.reject', $request->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
