<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Show book creation form
    public function create()
    {
        return view('books.create');
    }

    // Store book in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('home')->with('success', 'Book submitted for approval.');
    }

    // Show approved books
    public function index()
    {
        $books = Book::where('is_approved', true)->get();
        return view('books.index', compact('books'));
    }

    // Approve book (for admin)
    public function approve($id)
    {
        $book = Book::findOrFail($id);
        $book->update(['is_approved' => true]);

        return redirect()->route('admin.books')->with('success', 'Book approved.');
    }
}

