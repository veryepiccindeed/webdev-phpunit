<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Newspaper;
use App\Models\Cd;
use App\Models\Journal;
use App\Models\FinalYearProject;
use App\Models\BorrowedItem;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\CollectionUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CatalogueController extends Controller
{
    // Display a paginated list of all catalog items (books, newspapers, CDs, journals, FYP)

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

        return view('catalogues.index', compact('paginatedItems', 'category'));
    }

    public function edit($id, Request $request)
    {
        $category = $request->get('category');

        switch ($category) {
            case 'book':
                $item = Books::findOrFail($id);
                break;
            case 'newspaper':
                $item = Newspaper::findOrFail($id);
                break;
            case 'cd':
                $item = Cd::findOrFail($id);
                break;
            case 'journal':
                $item = Journal::findOrFail($id);
                break;
            case 'final year project':
                $item = FinalYearProject::findOrFail($id);
                break;
            default:
                abort(404, 'Category not found.');
        }

        return view('catalogues.edit', compact('item', 'category'));
    }

    public function update(Request $request, $id)
    {
        $category = $request->get('category');

        switch ($category) {
            case 'book':
                $item = Books::findOrFail($id);
                break;
            case 'newspaper':
                $item = Newspaper::findOrFail($id);
                break;
            case 'cd':
                $item = Cd::findOrFail($id);
                break;
            case 'journal':
                $item = Journal::findOrFail($id);
                break;
            case 'final year project':
                $item = FinalYearProject::findOrFail($id);
                break;
            default:
                abort(404, 'Category not found.');
        }

        // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'nullable|string|max:255',
        'publisher' => 'nullable|string|max:255',
        'datePublished' => 'nullable|date',
        'price' => 'nullable|numeric',
        'stock' => 'nullable|integer',
        'onlineLink' => 'nullable|url',
    ]);
    
    $this->middleware('auth');

    // Store the requested update in the collection_update_requests table
    $updateRequest = new CollectionUpdateRequest();
    $updateRequest->user_id = auth('web')->id(); // The librarian making the request
    $updateRequest->category = $category;
    $updateRequest->catalogue_id = $id;
    
    // Store the new values
    $updateRequest->new_title = $request->get('title');
    $updateRequest->new_author = $request->get('author');
    $updateRequest->new_publisher = $request->get('publisher');
    $updateRequest->new_datePublished = $request->get('datePublished');
    $updateRequest->new_price = $request->get('price');
    $updateRequest->new_stock = $request->get('stock');
    $updateRequest->new_onlineLink = $request->get('onlineLink');
    
    $updateRequest->save();

    // Redirect the user with a success message
    return redirect()->route('catalogues.index')->with('success', 'Catalogue update request submitted. Awaiting admin approval.');
    }
}

