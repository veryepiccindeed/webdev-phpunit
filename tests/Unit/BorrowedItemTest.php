<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\BorrowedItem;
use App\Models\User;
use App\Models\Books;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class BorrowedItemTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_borrowed_item()
    {
        // Arrange: Create a user and a book to be borrowed
        $user = User::factory()->create();  // Assuming you have a User factory
        $book = Books::factory()->create();  // Assuming you have a Book factory

        $data = [
            'borrower_id' => $user->id,
            'borrowable_id' => $book->id,
            'borrowable_type' => Books::class,
            'borrowed_at' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
        ];

        // Act: Create the borrowed item
        $borrowedItem = BorrowedItem::create($data);

        // Assert: Check if the borrowed item was created correctly
        $this->assertInstanceOf(BorrowedItem::class, $borrowedItem);
        $this->assertEquals($user->id, $borrowedItem->borrower_id);
        $this->assertEquals($book->id, $borrowedItem->borrowable_id);
        $this->assertEquals(Books::class, $borrowedItem->borrowable_type);
    }

    #[Test]
    public function it_requires_mandatory_fields()
    {
        // Arrange: Expecting a query exception when mandatory fields are missing
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Act: Try creating a borrowed item without required fields
        BorrowedItem::create([]);
    }

    #[Test]
    public function it_can_delete_a_borrowed_item()
    {
        // Arrange: Create a user and a book, then borrow the book
        $user = User::factory()->create();
        $book = Books::factory()->create();

        $borrowedItem = BorrowedItem::create([
            'borrower_id' => $user->id,
            'borrowable_id' => $book->id,
            'borrowable_type' => Books::class,
            'borrowed_at' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
        ]);

        // Act: Delete the borrowed item
        $borrowedItem->delete();

        // Assert: Check that the borrowed item is deleted
        $this->assertDatabaseMissing('borrowed_items', [
            'borrower_id' => $user->id,
            'borrowable_id' => $book->id,
        ]);
    }
}
