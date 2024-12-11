@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1 class="mt-4">Library Catalog</h1>
    {{-- <h5 class="text-primary">Alicia punya (0806022310002)</h5> --}}

    <!-- History Button -->
    <div class="mb-4">
        @if (auth()->user()->role == 'student')
            <a href="{{ route('borrowed.history.s') }}" class="btn btn-secondary">View Borrowing History</a>
        @elseif (auth()->user()->role == 'lecturer')
            <a href="{{ route('borrowed.history.l') }}" class="btn btn-secondary">View Borrowing History</a>
        @endif
        </div>

    <!-- Category Filter -->
    <form method="GET" action="{{ route(auth()->user()->role . '.dashboard') }}" class="mb-4">
        <label for="category">Select Category:</label>
        <select name="category" id="category" class="form-control w-50 d-inline-block" onchange="this.form.submit()">
            <option value="">All Categories</option>
            <option value="book" {{ request('category') == 'book' ? 'selected' : '' }}>Books</option>
            <option value="newspaper" {{ request('category') == 'newspaper' ? 'selected' : '' }}>Newspapers</option>
            <option value="cd" {{ request('category') == 'cd' ? 'selected' : '' }}>CDs</option>
            <option value="journal" {{ request('category') == 'journal' ? 'selected' : '' }}>Journals</option>
            <option value="final year project" {{ request('category') == 'final year project' ? 'selected' : '' }}>Final Year Projects</option>
        </select>
    </form>

    <!-- Display the table with catalog items -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Published Date</th>
                <th>Category</th>
                <th>Price (Rp)</th>
                <th>Stock</th>
                <th>Borrow</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paginatedItems as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->author }}</td>
                    <td>{{ $item->publisher }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->datePublished)->format('d M Y') }}</td> <!-- Format the date -->
                    <td>{{ $item->catalogue_type }}</td>
                    <td>{{ number_format($item->price ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        <!-- Borrow Button Logic -->
                        @if (auth()->user()->role == 'student' && $item->catalogue_type == 'book')
                            <a href="{{ route('borrowedItems.borrow.s',  ['id' => $item->id, 'category' => $item->catalogue_type]) }}" class="btn btn-primary">Borrow</a>
                        @elseif (auth()->user()->role == 'lecturer')
                            <a href="{{ route('borrowedItems.borrow.l',  ['id' => $item->id, 'category' => $item->catalogue_type]) }}" class="btn btn-primary">Borrow</a>
                        @else
                            <span class="text-muted">Not available for your role</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="pagination justify-content-center">
        {{ $paginatedItems->links() }}
    </div>
</div>
@endsection
