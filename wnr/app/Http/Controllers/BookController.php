<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image upload validation
        ]);

        $imagePath = null;

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('book_images', 'public');
        }

        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'genre' => $request->genre,
            'image' => $imagePath, // Store the image path if uploaded
        ]);

        return redirect()->route('books.index')->with('success', 'Book submitted for approval.');
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

    public function toggleFeatured($id)
{
    $book = Book::findOrFail($id);
    $book->featured = !$book->featured;
    $book->save();

    return redirect()->back()->with('success', 'Book featured status updated.');
}

public function adminFeaturedBooks()
{
    // Get all approved books for the admin to choose which to feature
    $books = Book::where('is_approved', true)->get();
    return view('admin.featured-books', compact('books'));
}

public function landingPage()
{
    // Fetch featured books
    $featuredBooks = Book::where('is_approved', true)->where('featured', true)->get();

    return view('landing', compact('featuredBooks'));
}



}

