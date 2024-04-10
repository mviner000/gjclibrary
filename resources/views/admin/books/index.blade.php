@extends('layouts.app', ['title' => 'GJCLibrary - Books List'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
    <div class="d-flex align-items-center mb-3">
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Borrow a Book</a>
    </div>
            <div class="card">
                
                <div class="card-header">Books</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Borrowed By</th>
                                <th>Borrowed Date</th>
                                <th>Returned By</th>
                                <th>Returned Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($books as $book)
                            <tr class="clickable-row" data-href="{{ route('admin.books.show', $book->slug) }}">
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('admin.books.show', $book->slug) }}" class="text-decoration-none">{{ $book->title }}</a></td>
                                <td>{{ $book->slug }}</td>
                                <td>{{ $book->description }}</td>
                                <td>{{ $book->borrowedBy->name }}</td>
                                <td>{{ $book->borrowed_date }}</td>
                                <td>{{ $book->returnedBy ? $book->returnedBy->name : 'null' }}</td>
                                <td>{{ $book->returned_date }}</td>
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
