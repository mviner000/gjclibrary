@extends('layouts.app', ['title' => 'GJCLibrary - Quote'])

@if(Request::is('small-devices'))
    @include('components.navbar', ['navbarTitle' => config('app.name', 'GJCLibrary')])
@else
    @include('components.navbar', ['navbarTitle' => 'Library Admin Panel'])
@endif

@section('content')
@php
    $sortByText = 'Quotes List';
@endphp

<div class="container">
<nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item "><a href="{{ route('admin.books.index') }}">Admin Panel</a></li>
    <li class="breadcrumb-item active" aria-current="page">| Quotes</li>
  </ol>
</nav>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>{{ $sortByText }}</h1>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ $sortByText }}</span>
                    <!-- <div class="nav-item dropdown btn btn-primary">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $sortByText }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.quotes.index', ['sort' => 'Borrower']) }}">Borrower</a>
                            <a class="dropdown-item" href="{{ route('admin.quotes.index', ['sort' => 'Returner']) }}">Returner</a>
                        </div>
                    </div> -->
                    <a href="{{ route('admin.quotes.create') }}" class="btn btn-primary">Create a new Quote</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Created By</th>
                                <th>Content</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotes as $quote)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $quote->createdBy->name }}</td> <!-- Access the name of the createdBy user -->
                                <td>{{ mb_strimwidth($quote->content, 0, 10, '...') }}</td>

                                <td>
                                    <a href="{{ route('admin.quotes.edit', $quote) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('admin.quotes.destroy', $quote) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this book?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
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
