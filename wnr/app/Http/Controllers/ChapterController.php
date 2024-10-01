<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    // Show the form to add a new chapter to a book
    public function create($bookId)
    {
        $book = Book::findOrFail($bookId);

        // Ensure the logged-in user is the owner of the book
        if (auth()->id() !== $book->user_id) {
            return redirect()->route('books.index')->withErrors('You are not authorized to add chapters to this book.');
        }

        return view('chapters.create', compact('book'));
    }

    // Store a new chapter in the database
    public function store(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);

        // Ensure the logged-in user is the owner of the book
        if (auth()->id() !== $book->user_id) {
            return redirect()->route('books.index')->withErrors('You are not authorized to add chapters to this book.');
        }

        // Validate the chapter input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create the chapter for the book
        Chapter::create([
            'book_id' => $book->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('books.show', $book->id)->with('success', 'Chapter added successfully!');
    }

    // Show the form to edit a chapter
    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);
        $book = $chapter->book;

        // Ensure the logged-in user is the owner of the book
        if (auth()->id() !== $book->user_id) {
            return redirect()->route('books.index')->withErrors('You are not authorized to edit this chapter.');
        }

        return view('chapters.edit', compact('chapter', 'book'));
    }

    // Update the chapter
    public function update(Request $request, $id)
    {
        $chapter = Chapter::findOrFail($id);
        $book = $chapter->book;

        // Ensure the logged-in user is the owner of the book
        if (auth()->id() !== $book->user_id) {
            return redirect()->route('books.index')->withErrors('You are not authorized to update this chapter.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Update the chapter
        $chapter->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('books.show', $book->id)->with('success', 'Chapter updated successfully!');
    }

    // Delete a chapter
    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $book = $chapter->book;

        // Ensure the logged-in user is the owner of the book
        if (auth()->id() !== $book->user_id) {
            return redirect()->route('books.index')->withErrors('You are not authorized to delete this chapter.');
        }

        // Delete the chapter
        $chapter->delete();

        return redirect()->route('books.show', $book->id)->with('success', 'Chapter deleted successfully!');
    }

    // Show the full content of the chapter
    public function show($id)
    {
        $chapter = Chapter::findOrFail($id);  // Find the chapter by its ID
        return view('chapters.show', compact('chapter'));
    }
}
