<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\CollectionUpdateRequest;
use App\Models\User;
use App\Models\Books;  // Assuming you also have a Book model
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class CollectionUpdateRequestTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_collection_update_request()
    {
        // Arrange: Create a user and a book (catalog item)
        $user = User::factory()->create();  // Assuming you have a User factory
        $book = Books::factory()->create();  // Assuming you have a Book factory

        $data = [
            'user_id' => $user->id,
            'category' => 'book',
            'catalogue_id' => $book->id,
            'new_title' => 'New Book Title',
            'new_author' => 'New Author Name',
            'new_publisher' => 'New Publisher Name',
            'new_datePublished' => now()->toDateString(),
            'new_price' => 20.99,
            'new_stock' => 50,
            'new_onlineLink' => 'https://example.com/new-book',
            'status' => 'pending',
        ];

        // Act: Create the collection update request
        $updateRequest = CollectionUpdateRequest::create($data);

        // Assert: Check if the update request was created correctly
        $this->assertInstanceOf(CollectionUpdateRequest::class, $updateRequest);
        $this->assertEquals($user->id, $updateRequest->user_id);
        $this->assertEquals('book', $updateRequest->category);
        $this->assertEquals($book->id, $updateRequest->catalogue_id);
        $this->assertEquals('New Book Title', $updateRequest->new_title);
        $this->assertEquals(20.99, $updateRequest->new_price);
        $this->assertEquals('pending', $updateRequest->status);
    }

    #[Test]
    public function it_requires_mandatory_fields()
    {
        // Arrange: Expecting a query exception when mandatory fields are missing
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Act: Try creating a collection update request without required fields
        CollectionUpdateRequest::create([]);
    }

    #[Test]
    public function it_can_update_request_status()
    {
        // Arrange: Create a user and a book, then create a collection update request
        $user = User::factory()->create();
        $book = Books::factory()->create();

        $updateRequest = CollectionUpdateRequest::create([
            'user_id' => $user->id,
            'category' => 'book',
            'catalogue_id' => $book->id,
            'status' => 'pending',
        ]);

        // Act: Change the request status to 'approved'
        $updateRequest->status = 'approved';
        $updateRequest->save();

        // Assert: Check that the status was updated correctly
        $this->assertEquals('approved', $updateRequest->status);
    }

    #[Test]
    public function it_can_delete_a_collection_update_request()
    {
        // Arrange: Create a user and a book, then create a collection update request
        $user = User::factory()->create();
        $book = Books::factory()->create();

        $updateRequest = CollectionUpdateRequest::create([
            'user_id' => $user->id,
            'category' => 'book',
            'catalogue_id' => $book->id,
            'status' => 'pending',
        ]);

        // Act: Delete the collection update request
        $updateRequest->delete();

        // Assert: Check that the update request is deleted
        $this->assertDatabaseMissing('collection_update_requests', [
            'user_id' => $user->id,
            'catalogue_id' => $book->id,
        ]);
    }
}
