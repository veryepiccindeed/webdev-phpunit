<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Models\Notification;
use App\Models\CollectionUpdateRequest;

class LibrarianController extends Controller
{
    public function create()
    {
        return view('librarian.create');  // Make sure this view exists
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new librarian
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'librarian',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Librarian created successfully.');
    }

    public function destroy($id)
    {
        $librarian = User::findOrFail($id);

        // Check if the user's role is 'librarian' before deleting
        if ($librarian->role !== 'librarian') {
            return redirect()->route('admin.dashboard')->with('error', 'Cannot delete this user.');
        }

        $librarian->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Librarian deleted successfully.');
    }

    public function index()
    {
        // Fetch the librarian's request history
        $requests = CollectionUpdateRequest::where('user_id', auth('web')->id())
                                           ->orderBy('created_at', 'desc')  // Sort by most recent
                                           ->get();

        // Return the view with the request data
        return view('librarian.dashboard', compact('requests'));
    }
    public function dashboard()
    {   
        // Correct way to access authenticated user's ID
        // $user = auth()->user(); // Get the currently authenticated user
        // $librarianId = $user->id; // Access the 'id' property

        $notifications = Notification::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

        return view('librarian.dashboard', compact('notifications'));
    }
}