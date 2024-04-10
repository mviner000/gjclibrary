@extends('layouts.app', ['title' => 'GJCLibrary - Add Quote'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Quote</div>

                <div class="card-body">
                    <form action="{{ route('admin.quotes.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="content">Quote of the Day - <small class="fst-italic text-info text-opacity-75">Max 255 Characters</small></label>
                            <textarea class="form-control" id="content" name="content" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="author">Author<small class="fst-italic text-info text-opacity-75"> (Optional) Insert the true author</small></label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">Go Back</a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
