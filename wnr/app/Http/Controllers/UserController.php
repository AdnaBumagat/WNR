<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}
