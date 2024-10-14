<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    // Show the user dashboard
    public function dashboard()
    {
        return view('dashboard'); // Create this view in resources/views/dashboard.blade.php
    }

    // Display all users in the admin dashboard
    public function index(Request $request)
    {
        
        // Get the search input
        $search = $request->input('search');

        // Modify the query to include search functionality, then paginate
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('id', 'like', '%' . $search . '%');
        })->paginate(10);

        // Pass the users and search term to the view
        return view('admin.users', compact('users', 'search'));
    }
    

    // Update user role (admin or user)
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    // Block or unblock a user
    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = !$user->is_blocked; // Toggle block status
        $user->save();

        return redirect()->back()->with('success', 'User block status updated.');
    }

    // Delete a user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Perform soft delete

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    // Export users to CSV
    public function exportUsersToCSV()
    {
        // Fetch all users
        $users = User::select('name', 'email', 'created_at')->get();

        // Define the CSV filename
        $filename = "users_" . now()->format('Y_m_d_H_i_s') . ".csv";

        // Create a file pointer
        $handle = fopen('php://output', 'w');

        // Set the headers for the CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        // Write the column headings to the CSV file
        fputcsv($handle, ['Name', 'Email', 'Created At']);

        // Write each user's data to the CSV file
        foreach ($users as $user) {
            fputcsv($handle, [
                $user->name,
                $user->email,
                $user->created_at->toDateString(),
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
