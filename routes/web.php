<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\BorrowedItemController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\CollectionUpdateRequestController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:student'])->group(function () {
  
    Route::get('/student/home', [HomeController::class, 'index'])->name('student.dashboard');
    Route::get('/student/home/borrow/{id}/{category}', [BorrowedItemController::class, 'borrow'])->name('borrowedItems.borrow.s');
    Route::get('/student/home/history', [BorrowedItemController::class, 'history'])->name('borrowed.history.s');

});

Route::middleware(['auth', 'user-access:lecturer'])->group(function () {
  
    Route::get('/lecturer/home', [HomeController::class, 'index'])->name('lecturer.dashboard');
    Route::get('/lecturer/home/borrow/{id}/{category}', [BorrowedItemController::class, 'borrow'])->name('borrowedItems.borrow.l');
    Route::get('/lecturer/home/history', [BorrowedItemController::class, 'history'])->name('borrowed.history.l');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    // Admin Dashboard Route
    Route::get('/admin/home', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Librarian Create Route
    Route::get('/admin/librarians/create', [LibrarianController::class, 'create'])->name('librarian.create');
    Route::post('/admin/librarians/store', [LibrarianController::class, 'store'])->name('librarian.store');
    Route::delete('/admin/librarians/{id}', [LibrarianController::class, 'destroy'])->name('librarian.destroy');
    //Colletion Request
    Route::get('/collection/requests', [CollectionUpdateRequestController::class, 'index'])->name('collection.requests.index');
    Route::post('/collection/requests/{id}/approve', [CollectionUpdateRequestController::class, 'approve'])->name('collection.requests.approve');
    Route::post('/collection/requests/{id}/reject', [CollectionUpdateRequestController::class, 'reject'])->name('collection.requests.reject');
});

  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:librarian'])->group(function () {
  
    Route::get('/librarian/home', [LibrarianController::class, 'index'])->name('librarian.dashboard');
    Route::get('/catalogues/index', [CatalogueController::class, 'index'])->name('catalogues.index');
    Route::get('/catalogues/{id}/edit', [CatalogueController::class, 'edit'])->name('catalogues.edit');
    Route::put('/catalogues/{id}', [CatalogueController::class, 'update'])->name('catalogues.update');
    Route::post('/collection/update-request', [CollectionUpdateRequestController::class, 'store'])->name('collection.update-request.store');
});

Route::get('/unauthorized', function () {
    return response('Unauthorized', 403);
})->name('unauthorized');

Route::post('/notifications/{id}/mark-as-read', function ($id) {
    $notification = \App\Models\Notification::findOrFail($id);
    $notification->update(['is_read' => true]);

    return redirect()->back()->with('success', 'Notification marked as read.');
})->name('notifications.mark-as-read');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
