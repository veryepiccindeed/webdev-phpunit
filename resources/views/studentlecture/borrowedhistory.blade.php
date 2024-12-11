@extends('layouts.app')
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@section('content')
<div class="container">
    <h1 class="mt-4">Borrowing History</h1>

    @if($borrowedItems->isEmpty())
        <p>You have no borrowing history.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Borrowed Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Remaining/Overdue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowedItems as $item)
                    <tr>
                        <td>{{ $item->borrowable->title }}</td>
                        <td>{{ ucfirst(class_basename($item->borrowable_type)) }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->borrowed_at)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->due_date)->format('d M Y') }}</td>
                        <td>
                            @if($item->is_overdue)
                                <span class="badge badge-danger">Overdue</span>
                            @else
                                <span class="badge badge-success">On Time</span>
                            @endif
                        </td>
                        <td>
                            @if($item->is_overdue)
                                {{ ceil(abs($item->remaining_days)) }} days overdue
                            @else
                                {{ ceil($item->remaining_days) }} days remaining
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
