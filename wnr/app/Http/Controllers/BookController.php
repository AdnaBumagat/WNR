<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Show the form for creating a new book
    public function create()
    {
        return view('books.create');
    }

    // Store a newly created book in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
        ]);

        // Create the book and associate it with the logged-in user (author)
        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'genre' => $request->genre,
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    // List all books created by the authenticated user
    public function index()
    {
        // Fetch the books created by the logged-in user
        $books = Auth::user()->books; // Use the user's relationship to fetch their books

        // Pass the books to the view
        return view('books.index', compact('books'));
    }

    // Show a single book with its details and chapters
    public function show($id)
    {
        $book = Book::with('chapters')->findOrFail($id); // Load the book and its chapters
        return view('books.show', compact('book'));
    }

    // Show the form to edit a book
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        // Ensure the logged-in user is the owner of the book
        if (auth()->id() !== $book->user_id) {
            return redirect()->route('books.index')->withErrors('You are not authorized to edit this book.');
        }

        return view('books.edit', compact('book'));
    }

    // Update the book details
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        // Ensure the logged-in user is the owner of the book
        if (auth()->id() !== $book->user_id) {
            return redirect()->route('books.index')->withErrors('You are not authorized to update this book.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
        ]);

        // Update the book
        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'genre' => $request->genre,
        ]);

        return redirect()->route('books.show', $book->id)->with('success', 'Book updated successfully!');
    }

    // Delete a book
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Ensure the logged-in user is the owner of the book
        if (auth()->id() !== $book->user_id) {
            return redirect()->route('books.index')->withErrors('You are not authorized to delete this book.');
        }

        // Delete the book and its chapters
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }

    // Publish a book (called from the book detail page)
    public function publish($id)
    {
        $book = Book::findOrFail($id);

        // Ensure the logged-in user is the owner of the book
        if (auth()->id() !== $book->user_id) {
            return redirect()->route('books.index')->withErrors('You are not authorized to publish this book.');
        }

        // Mark the book as published (but not approved)
        $book->update(['is_published' => true]);

        return redirect()->route('books.show', $book->id)->with('success', 'Book has been published! It is awaiting admin approval.');
    }
}

