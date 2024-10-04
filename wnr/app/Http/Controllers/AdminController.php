<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Chapter;

class AdminController extends Controller
{
    // Show admin dashboard
    public function dashboard()
    {
        // Fetch total users count
        $userCount = User::count();

        // Fetch the number of admins and regular users
        $adminCount = User::where('role', 'admin')->count();
        $regularUserCount = User::where('role', 'user')->count();

        // Pass the counts to the view
        return view('admin.dashboard', compact('userCount', 'adminCount', 'regularUserCount'));
    }

        // Show a list of books awaiting approval
        public function approvalRequests()
        {
            // Fetch all published books that haven't been approved yet
            $books = Book::where('is_published', true)->where('is_approved', false)->get();
            return view('admin.approvals.index', compact('books'));
        }
    
        // Show the book content for admin to approve or reject
        public function showBook($id)
        {
            // Load the book along with its chapters
            $book = Book::with('chapters')->findOrFail($id);
            return view('admin.approvals.show', compact('book'));
        }
        
    
        // Approve the book
        public function approveBook($id)
        {
            $book = Book::findOrFail($id);
            $book->update(['is_approved' => true]);
            return redirect()->route('admin.approvals.index')->with('success', 'Book approved successfully.');
        }
    
        // Reject the book (deletes the book)
        public function rejectBook($id)
        {
            $book = Book::findOrFail($id);
            $book->delete();
            return redirect()->route('admin.approvals.index')->with('success', 'Book rejected and removed successfully.');
        }

        public function showChapter($id)
{
    $chapter = Chapter::findOrFail($id);
    return view('admin.approvals.showChapter', compact('chapter'));
}


        

    
}
