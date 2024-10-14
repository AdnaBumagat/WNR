<?php

namespace App\Http\Controllers;

use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch featured books
        $featuredBooks = Book::where('is_approved', true)
                             ->where('is_featured', true)
                             ->take(8)  // Limit to 8 for the carousel
                             ->get();

        // Fetch approved books that are not featured with pagination
        $approvedBooks = Book::where('is_approved', true)
                             ->where('is_featured', false)
                             ->paginate(8);  // Paginate approved books, 8 per page

        return view('landing', compact('featuredBooks', 'approvedBooks'));
    }
}
