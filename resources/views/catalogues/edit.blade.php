@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-primary">Edit {{ ucfirst($category) }}</h1>
    <form action="{{ route('catalogues.update', $item->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                value="{{ $item->title }}" 
                class="form-control @error('title') is-invalid @enderror"
                required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Author:</label>
            <input 
                type="text" 
                name="author" 
                id="author" 
                value="{{ $item->author }}" 
                class="form-control @error('author') is-invalid @enderror">
            @error('author')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="publisher">Publisher:</label>
            <input 
                type="text" 
                name="publisher" 
                id="publisher" 
                value="{{ $item->publisher }}" 
                class="form-control @error('publisher') is-invalid @enderror">
            @error('publisher')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="datePublished">Published Date:</label>
            <input 
                type="date" 
                name="datePublished" 
                id="datePublished" 
                value="{{ $item->datePublished }}" 
                class="form-control @error('datePublished') is-invalid @enderror">
            @error('datePublished')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Price (Rp):</label>
            <input 
                type="number" 
                name="price" 
                id="price" 
                value="{{ $item->price }}" 
                class="form-control @error('price') is-invalid @enderror">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input 
                type="number" 
                name="stock" 
                id="stock" 
                value="{{ $item->stock }}" 
                class="form-control @error('stock') is-invalid @enderror">
            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="onlineLink">Online Link:</label>
            <input 
                type="url" 
                name="onlineLink" 
                id="onlineLink" 
                value="{{ $item->onlineLink }}" 
                class="form-control @error('onlineLink') is-invalid @enderror">
            @error('onlineLink')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <input type="hidden" name="category" value="{{ $category }}">

        <button type="submit" class="btn btn-success mt-3">Save Changes</button>
        <a href="{{ route('catalogues.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection
