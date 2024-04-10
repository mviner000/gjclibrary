@extends('layouts.app', ['title' => 'GJCLibrary - ' . $book->title])

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ $book->title }}</div>

        <div class="card-body">
            <p>Description: {{ $book->description }}</p>
            <!-- Add more book details as needed -->
            <a href="{{ route('admin.books.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection
