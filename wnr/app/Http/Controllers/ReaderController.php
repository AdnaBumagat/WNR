<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    // Show reader (book details) along with its chapters
    public function show($id)
    {
        $book = Book::with('chapters')->findOrFail($id); // Load book with its chapters
        return view('readers.show', compact('book'));
    }

    // Show the content of a single chapter
    public function showChapter($bookId, $chapterId)
    {
        $book = Book::findOrFail($bookId);
        $chapter = Chapter::findOrFail($chapterId);

        // Ensure the chapter belongs to the book
        if ($chapter->book_id !== $book->id) {
            abort(404, 'Chapter not found in this book.');
        }

        return view('readers.showChapter', compact('book', 'chapter'));
    }
}
