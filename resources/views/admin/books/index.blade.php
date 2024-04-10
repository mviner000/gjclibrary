@extends('layouts.app', ['title' => 'GJCLibrary - Dashboard'])

@section('content')
@php
    $borrowerNullDataMessage = 'This field is empty';
    $returnerNullDataMessage = 'Not Yet Returned';
    $sortByText = ($sortByType === 'Borrower') ? 'Borrowed Books' : 'Returned Books';
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Borrow a Book</a>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ $sortByText }}</span>
                    <div class="nav-item dropdown btn btn-primary">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $sortByText }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.books.index', ['sort' => 'Borrower']) }}">Borrower</a>
                            <a class="dropdown-item" href="{{ route('admin.books.index', ['sort' => 'Returner']) }}">Returner</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Book Title</th>
                                <th>{{ $sortByType === 'Borrower' ? 'Borrowed By' : 'Returned By' }}</th>
                                <th>{{ $sortByType === 'Borrower' ? 'Borrowed Date' : 'Returned Date' }}</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($books as $book)
                            <tr class="clickable-row" data-href="{{ route('admin.books.show', $book->slug) }}">
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('admin.books.show', $book->slug) }}" class="text-decoration-none">{{ $book->title }}</a></td>
                                <td>{{ $sortByType === 'Borrower' ? ($book->borrowedBy ? $book->borrowedBy->name : $borrowerNullDataMessage) : ($book->returnedBy ? $book->returnedBy->name : $returnerNullDataMessage) }}</td>
                                <td>{{ $sortByType === 'Borrower' ? ($book->borrowed_date ?: $borrowerNullDataMessage) : ($book->returned_date ?: $returnerNullDataMessage) }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-outline-success me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this book?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection