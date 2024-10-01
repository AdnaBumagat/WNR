<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Show admin dashboard
    public function dashboard()
    {

        // Fetch the total number of users
        $userCount = User::count();

        // Pass the count to the view
        return view('admin.dashboard', compact('userCount'));
    }

    
}
