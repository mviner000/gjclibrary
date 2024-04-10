<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminBookController extends Controller
{
    // Display a listing of the books.
    public function index(Request $request)
    {
        $sortByType = $request->query('sort', 'Borrower'); // Default sorting type
        
        // Fetch books based on the sorting type
        $books = Book::orderBy($sortByType === 'Borrower' ? 'borrowed_date' : 'returned_date')
                    ->with($sortByType === 'Borrower' ? 'borrowedBy' : 'returnedBy')
                    ->get();
        
        return view('admin.books.index', compact('books', 'sortByType'));
    }


    // Show the form for creating a new book.
    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Add more validation rules as needed
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->slug = $this->generateUniqueSlug($request->title); // Generate unique slug based on title
        $book->borrowed_by = Auth::id(); // Associate the logged-in user with the created book
        $book->borrowed_date = now(); 
        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    // Display the specified book.
    public function show($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        return view('admin.books.show', compact('book'));
    }

    // Show the form for editing the specified book.
    public function edit(Book $book)
    {
        // Fetch all users who have returned books
        $returners = User::all(['id', 'name']);

        // Fetch all users who have borrowed books
        $borrowers = User::all(['id', 'name']);

        return view('admin.books.edit', compact('book', 'borrowers', 'returners'));
    }

// Update the specified book in storage.
public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        // Add more validation rules as needed
    ]);

    $bookData = $request->all();
    $bookData['slug'] = $this->generateUniqueSlug($request->title); // Generate unique slug based on new title

    // Update the borrowed_by field only if a borrower is selected
    if ($request->has('borrowed_by')) {
        $bookData['borrowed_by'] = $request->input('borrowed_by');
    }

    // Update the returned_by field only if a returner is selected
    if ($request->has('returned_by')) {
        $bookData['returned_by'] = $request->input('returned_by');
    }

    $book->update($bookData);

    return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
}


    // Remove the specified book from storage.
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }

    // Custom function to generate a unique slug based on the title
    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title); // Generate slug based on title

        // Check if the generated slug already exists
        $count = Book::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . uniqid(); // Append a unique identifier to ensure uniqueness
        }

        return $slug;
    }
}
