<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Newspaper;
use App\Models\Cd;
use App\Models\Journal;
use App\Models\FinalYearProject;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
// use App\Models\CollectionUpdateRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  
    // Show dashboard for both student and lecturer
    // public function index()
    // {
    //     return view('studentlecture.dashboard');
    // } 

    public function index(Request $request)
    {
        $category = $request->get('category', null); // Default to null if no category is selected

        // Fetch the catalog items
        $books = Books::query();
        $newspapers = Newspaper::query();
        $cds = Cd::query();
        $journals = Journal::query();
        $fyp = FinalYearProject::query();

        if ($category) {
            $books->where('catalogue_type', $category);
            $newspapers->where('catalogue_type', $category);
            $cds->where('catalogue_type', $category);
            $journals->where('catalogue_type', $category);
            $fyp->where('catalogue_type', $category);
        }

        // Get paginated results
        $books = $books->paginate(10);
        $newspapers = $newspapers->paginate(10);
        $cds = $cds->paginate(10);
        $journals = $journals->paginate(10);
        $fyp = $fyp->paginate(10);

        // Merge paginated items into a single collection
        $allItems = collect($books->items())
            ->merge($newspapers->items())
            ->merge($cds->items())
            ->merge($journals->items())
            ->merge($fyp->items());

        // Manually paginate the merged collection
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;
        $itemsForCurrentPage = $allItems->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedItems = new LengthAwarePaginator(
            $itemsForCurrentPage,
            $allItems->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('studentlecture.dashboard', compact('paginatedItems', 'category'));
    }

    // Handle the borrowing of a catalog item
    // public function borrow(Request $request, $id)
    // {
    //     // Get the currently authenticated user
    //     $user = auth()->user();

    //     // Find the catalogue item
    //     $catalogue = Catalogue::findOrFail($id);

    //     // Handle the borrowing logic (e.g., create a borrowing record)
    //     // Example: Adding a record to a 'borrowed_items' table
    //     $user->borrowedItems()->attach($catalogue);  // Assuming there's a many-to-many relationship

    //     return redirect()->route('dashboard')->with('success', 'You have borrowed the item successfully.');
    // }
}