<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

    
}
