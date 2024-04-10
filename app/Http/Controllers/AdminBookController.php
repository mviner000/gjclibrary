<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminBookController extends Controller
{
    // Display a listing of the books.
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
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
        return view('admin.books.edit', compact('book'));
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
        $bookData['borrowed_by'] = Auth::id(); // Associate the logged-in user with the updated book

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
