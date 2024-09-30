<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show the user dashboard
    public function dashboard()
    {
        return view('dashboard'); // Create this view in resources/views/dashboard.blade.php
    }
}
