<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Book;

class ChapterController extends Controller
{
    public function create(Book $book)
    {
        return view('chapters.create', compact('book'));
    }

    public function store(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    // Create a new chapter associated with the book
    Chapter::create([
        'book_id' => $book->id,
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return redirect()->route('books.index')->with('success', 'Chapter added to book.');
}

}
