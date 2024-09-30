<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard'); // Create this view in the next step
    }
}
