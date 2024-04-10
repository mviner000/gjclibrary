<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class AdminQuoteController extends Controller
{
    // Display a listing of the quotes
    public function index()
    {
        $quotes = Quote::with('createdBy')->get(); // Eager load the createdBy relationship
        return view('admin.quotes.index', compact('quotes'));
    }

    // Show the form for creating a new quote
    public function create()
    {
        return view('admin.quotes.create');
    }

    // Store a newly created quote in storage
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255', // Adjust max characters as needed
            'author' => 'nullable|string|max:255', // Add validation for author field
        ]);

        Quote::create([
            'content' => $request->content,
            'author' => $request->author, // Add author field to the create method
            // Assuming you have authentication set up, you can set the created_by attribute to the currently authenticated user's id
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.quotes.index')->with('success', 'Quote created successfully.');
    }

    // Show the form for editing the specified quote
    public function edit(Quote $quote)
    {
        return view('admin.quotes.edit', compact('quote'));
    }

    // Update the specified quote in storage
    public function update(Request $request, Quote $quote)
    {
        $request->validate([
            'content' => 'required|string|max:255', // Adjust max characters as needed
            'author' => 'nullable|string|max:255', // Add validation for author field
        ]);

        $quote->update([
            'content' => $request->content,
            'author' => $request->author, // Update author field
        ]);

        return redirect()->route('admin.quotes.index')->with('success', 'Quote updated successfully.');
    }


    // Remove the specified quote from storage
    public function destroy(Quote $quote)
    {
        $quote->delete();

        return redirect()->route('admin.quotes.index')->with('success', 'Quote deleted successfully.');
    }
}
