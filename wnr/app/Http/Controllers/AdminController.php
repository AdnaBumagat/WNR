<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Support\Facades\Response;


class AdminController extends Controller
{
    // Show admin dashboard
    // Show admin dashboard
    public function dashboard()
    {
        // Fetch total users count
        $userCount = User::count();

        // Fetch the number of admins and regular users
        $adminCount = User::where('role', 'admin')->count();
        $regularUserCount = User::where('role', 'user')->count();

        // Fetch counts for approved and featured books
        $approvedBookCount = Book::where('is_approved', true)->count();
        $featuredBookCount = Book::where('is_featured', true)->count();

        // Fetch counts for approval requests
        $approvalRequestCount = Book::where('is_published', true)
                                     ->where('is_approved', false)
                                     ->count();

        // Pass the counts to the view
        return view('admin.dashboard', compact('userCount', 'adminCount', 'regularUserCount', 'approvedBookCount', 'featuredBookCount', 'approvalRequestCount'));
    }

    public function approvalRequests()
    {
        // Fetch all published books that haven't been approved yet with pagination (5 per page)
        $books = Book::where('is_published', true)
                     ->where('is_approved', false)
                     ->paginate(5); // Add pagination here
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

public function approvedBooks()
{
    // Fetch all books that have been approved by the admin with pagination (10 per page)
    $books = Book::where('is_approved', true)
                 ->paginate(4); // Add pagination here
    return view('admin.library.index', compact('books'));
}

    // Method to toggle the featured status of a book
    public function toggleFeatured($id)
    {
        $book = Book::findOrFail($id);

        // Toggle the is_featured status
        $book->is_featured = !$book->is_featured;
        $book->save();

        return redirect()->route('admin.library.index')->with('success', 'Book featured status updated successfully.');
    }

    // Export approved books to CSV
    public function exportApprovedBooksToCSV()
    {
        // Fetch approved books
        $books = Book::select('title', 'genre', 'user_id', 'is_featured', 'created_at')
                    ->where('is_approved', true)
                    ->with('user:name,id')
                    ->get();

        // Define the CSV filename
        $filename = "approved_books_" . now()->format('Y_m_d_H_i_s') . ".csv";

        // Create a file pointer
        $handle = fopen('php://output', 'w');

        // Set the headers for the CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        // Write the column headings to the CSV file
        fputcsv($handle, ['Title', 'Genre', 'Author', 'Featured', 'Created At']);

        // Write each approved book's data to the CSV file
        foreach ($books as $book) {
            fputcsv($handle, [
                $book->title,
                $book->genre,
                $book->user->name,
                $book->is_featured ? 'Yes' : 'No',
                $book->created_at->toDateString(),
            ]);
        }

        // Close the file pointer
        fclose($handle);

        // Send the response with the CSV data
        return Response::streamDownload(function () use ($handle) {
            // The file content will be streamed via 'php://output'
        }, $filename, $headers);
    }


        

    
}
