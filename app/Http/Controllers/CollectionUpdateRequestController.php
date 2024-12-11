<?php
namespace App\Http\Controllers;

use App\Models\CollectionUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Books;
use App\Models\Journal;
use App\Models\CD;
use App\Models\FinalYearProject;
use App\Models\Newspaper;

class CollectionUpdateRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'catalogue_id' => 'required|integer',
            'catalogue_type' => 'required|string',
            'update_data' => 'required|array',
        ]);

        CollectionUpdateRequest::create([
            'catalogue_id' => $request->catalogue_id,
            'catalogue_type' => $request->catalogue_type,
            'librarian_id' => Auth::id(),
            'update_data' => $request->update_data,
        ]);

        return redirect()->back()->with('success', 'Update request submitted successfully!');
    }

    public function index()
    {
        $requests = CollectionUpdateRequest::with('librarian')->where('status', 'pending')->get();
        return view('admin.collection_requests.index', compact('requests'));
    }

    public function approve($id)
    {
        $request = CollectionUpdateRequest::findOrFail($id);

        // Update the corresponding catalogue item with the new values
        switch ($request->category) {
            case 'book':
                $item = Books::findOrFail($request->catalogue_id);
                break;
            case 'newspaper':
                $item = Newspaper::findOrFail($request->catalogue_id);
                break;
            case 'cd':
                $item = Cd::findOrFail($request->catalogue_id);
                break;
            case 'journal':
                $item = Journal::findOrFail($request->catalogue_id);
                break;
            case 'final year project':
                $item = FinalYearProject::findOrFail($request->catalogue_id);
                break;
            default:
                return redirect()->route('collection.requests.index')->with('error', 'Unknown category');
        }

        // Update the item with the new requested values
        $item->update([
            'title' => $request->new_title,
            'author' => $request->new_author,
            'publisher' => $request->new_publisher,
            'datePublished' => $request->new_datePublished,
            'price' => $request->new_price,
            'stock' => $request->new_stock,
            'onlineLink' => $request->new_onlineLink,
        ]);

        // Mark the request as approved
        $request->status = 'approved';
        $request->save();

        return redirect()->route('collection.requests.index')->with('success', 'Collection update request approved.');
    }

    public function reject($id)
    {
        $request = CollectionUpdateRequest::findOrFail($id);

        // Mark the request as rejected
        $request->status = 'rejected';
        $request->save();

        return redirect()->route('collection.requests.index')->with('success', 'Collection update request rejected.');
    }

}
