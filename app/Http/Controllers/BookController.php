<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
 
        // Return Json Response
        return response()->json([
            'results' => $books
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
