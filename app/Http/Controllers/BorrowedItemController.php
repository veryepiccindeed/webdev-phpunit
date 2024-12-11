<?php

// app/Http/Controllers/BorrowedItemController.php

namespace App\Http\Controllers;

use App\Models\BorrowedItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowedItemController extends Controller
{
    public function borrow($id, $category)
    {
        // Get the authenticated user
        $user = auth('web')->user();

        // Find the catalog item based on the category
        $item = null;
        switch ($category) {
            case 'book':
                $item = \App\Models\Books::findOrFail($id);
                break;
            case 'newspaper':
                $item = \App\Models\Newspaper::findOrFail($id);
                break;
            case 'cd':
                $item = \App\Models\Cd::findOrFail($id);
                break;
            case 'journal':
                $item = \App\Models\Journal::findOrFail($id);
                break;
            case 'final_year_project':
                $item = \App\Models\FinalYearProject::findOrFail($id);
                break;
            default:
                abort(404, 'Item not found.');
        }

        // Check if the item is available to borrow
        if ($item->stock <= 0) {
            if (auth('web')->user()->role === 'student') {
                return redirect()->route('student.dashboard')->with('error', 'Item is out of stock.');
            } elseif (auth('web')->user()->role === 'lecturer') {
                return redirect()->route('lecturer.dashboard')->with('error', 'Item is out of stock.');
            }
        }

        // Calculate the due date (based on rules for students or lecturers)
        $dueDate = Carbon::now()->addDays(5);  // Example: 5 days for students

        // Create a borrowed item record
        BorrowedItem::create([
            'borrower_id' => $user->id,
            'borrowable_id' => $item->id,
            // 'borrowable_type' => $item->catalogue_type,
            'borrowable_type' => get_class($item),
            'borrowed_at' => Carbon::now(),
            'due_date' => $dueDate = $user->role === 'student' ? Carbon::now()->addDays(5) : Carbon::now()->addDays(3),
        ]);

        // Reduce stock by 1
        $item->decrement('stock');
        if (auth('web')->user()->role === 'student') {
            return redirect()->route('student.dashboard')->with('success', 'Item borrowed successfully!');
        } else if (auth('web')->user()->role === 'lecturer') {
            return redirect()->route('lecturer.dashboard')->with('success', 'Item borrowed successfully!');
        }
    }

    public function history()
    {
        $user = auth('web')->user();

        // Fetch borrowed items with their associated catalog model
        $borrowedItems = BorrowedItem::with('borrowable')
            ->where('borrower_id', $user->id)
            ->get()
            ->map(function ($item) {
                $today = Carbon::now()->startOfDay();
                $dueDate = Carbon::parse($item->due_date)->startOfDay();
                        
                // Overdue jika hari ini lebih besar dari due date
                $item->is_overdue = $today->greaterThan($dueDate);
                        
                // Hitung remaining days (positif jika belum overdue, negatif jika overdue)
                $item->remaining_days = $today->diffInDays($dueDate, false);
                        
                return $item;
            });

        return view('studentlecture.borrowedhistory', compact('borrowedItems'));
    }
}