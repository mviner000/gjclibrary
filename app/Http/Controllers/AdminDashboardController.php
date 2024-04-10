<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // Display a listing of the books.
    public function index()
    {
        $books = Book::all();
        return view('admin.dashboard.index', compact('books'));
    }
}
