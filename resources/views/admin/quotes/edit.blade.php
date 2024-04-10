@extends('layouts.app', ['title' => 'GJCLibrary - Edit Quote'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Quote</div>

                <div class="card-body">
                    <form action="{{ route('admin.quotes.update', $quote) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ $quote->author }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content" name="content" required>{{ $quote->content }}</textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
