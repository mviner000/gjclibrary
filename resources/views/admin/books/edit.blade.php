@extends('layouts.app', ['title' => 'GJCLibrary - Admin Book Edit'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Book</div>

                <div class="card-body">
                    <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ $book->description }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="borrowed_by">Borrowed By</label>
                            <select class="form-select" id="borrowed_by" name="borrowed_by" aria-label="Select borrower">
                                @foreach($borrowers as $borrower)
                                    <option value="{{ $borrower->id }}" {{ $book->borrowed_by == $borrower->id ? 'selected' : '' }}>{{ $borrower->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="returned_by">Returned By</label>
                            <select class="form-select" id="returned_by" name="returned_by" aria-label="Select returner">
                                @foreach($returners as $returner)
                                    <option value="{{ $returner->id }}" {{ $book->returned_by == $returner->id ? 'selected' : '' }}>{{ $returner->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mx-2">Update</button>
                            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
