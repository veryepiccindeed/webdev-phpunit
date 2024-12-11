<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $librarians = User::where('role', 'librarian')->get();

        // Pass the librarians data to the view
        return view('admin.dashboard', compact('librarians'));
    }
}
