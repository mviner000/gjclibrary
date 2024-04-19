<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['borrowedBy', 'returnedBy'])->get();
        
        // Transform the data to include borrower and returner names
        $transformedBooks = $books->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'slug' => $book->slug,
                'borrowed_by' => $book->borrowedBy ? $book->borrowedBy->name : null,
                'returned_by' => $book->returnedBy ? $book->returnedBy->name : null,
                'borrowed_date' => $book->borrowed_date,
                'returned_date' => $book->returned_date,
                'created_at' => $book->created_at,
                'updated_at' => $book->updated_at,
            ];
        });
        
        // Return Json Response with transformed data
        return response()->json([
            'results' => $transformedBooks
        ], 200);
    }

    public function destroy($id)
    {
        // Detail 
        $books = Book::find($id);
        if (!$books) {
            return response()->json([
                'message' => 'Book Not Found.'
            ], 404);
        }
 
        // Delete Book
        $books->delete();
 
        // Return Json Response
        return response()->json([
            'message' => "Book successfully deleted."
        ], 200);
    }
 
}
