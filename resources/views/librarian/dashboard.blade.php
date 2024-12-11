@extends('layouts.app')
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    .section-space {
        margin-top: 20px; /* Add top margin */
        margin-bottom: 10px; /* Add bottom margin */
    }
</style>
@section('content')
<div class="container">
    <h1>Librarian Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>

    <!-- Collection Management Section -->
    <h2>Collection Management</h2>
    <a href="{{ route('catalogues.index') }}" class="btn btn-primary">Manage Catalogues</a>
    {{-- <a href="{{ route('journals.index') }}" class="btn btn-primary">Manage Journals</a>
    <a href="{{ route('cds.index') }}" class="btn btn-primary">Manage CDs/DVDs</a> --}}
    <!-- Request History Section -->
    <h2 class="section-space">Request History</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th class="bg-primary text-white font-weight-bold">Category</th>
                <th class="bg-primary text-white font-weight-bold">Requested Changes</th>
                <th class="bg-primary text-white font-weight-bold">Status</th>
                <th class="bg-primary text-white font-weight-bold">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ ucfirst($request->category) }}</td>
                    <td>
                        <ul>
                            <li><strong>Title:</strong> {{ $request->new_title }}</li>
                            <li><strong>Author:</strong> {{ $request->new_author }}</li>
                            <li><strong>Publisher:</strong> {{ $request->new_publisher }}</li>
                            <li><strong>Price:</strong> {{ number_format($request->new_price, 2) }}</li>
                            <li><strong>Stock:</strong> {{ $request->new_stock }}</li>
                        </ul>
                    </td>
                    <td>
                        @if($request->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($request->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                        @elseif($request->status == 'rejected')
                            <span class="badge badge-danger">Rejected</span>
                        @else
                            <span class="badge badge-secondary">Unknown</span>
                        @endif
                    </td>
                    <td>{{ $request->created_at->format('d M Y H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <h3>Notifications</h3>
    @if ($notifications->isEmpty())
        <p>No notifications available.</p>
    @else
        <ul>
            @foreach ($notifications as $notification)
            <li>
                {{ $notification->message }}
                <small>{{ $notification->created_at->diffForHumans() }}</small>
            </li>
            @endforeach
        </ul>
    @endif

    <li>
        {{ $notification->message }}
        <small>{{ $notification->created_at->diffForHumans() }}</small>
        @if (!$notification->is_read)
            <form action="{{ route('notifications.mark-as-read', $notification->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-secondary">Mark as Read</button>
            </form>
        @endif
    </li> --}}
    

</div>
@endsection
