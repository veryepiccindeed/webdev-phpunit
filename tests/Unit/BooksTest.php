<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Books;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class BooksTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_book()
    {
        // Arrange
        $data = [
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'publisher' => 'Scribner',
            'description' => 'A novel set in the Jazz Age exploring themes of wealth and society.',
            'price' => 150000,
            'stock' => 10,
            'datePublished' => '1925-04-10',
            'genre' => 'fiction',
            'onlineLink' => 'https://example.com/the-great-gatsby',
        ];

        // Act
        $book = Books::create($data);

        // Assert
        $this->assertInstanceOf(Books::class, $book);
        $this->assertEquals('The Great Gatsby', $book->title);
        $this->assertEquals('F. Scott Fitzgerald', $book->author);
        $this->assertEquals('Scribner', $book->publisher);
    }

    #[Test]
    public function it_requires_mandatory_fields()
    {
        // Arrange
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Act
        Books::create([]);
    }

    #[Test]
    public function it_can_delete_a_book()
    {
        // Arrange
        $data = [
            'title' => 'To Be Deleted',
            'author' => 'John Doe',
            'publisher' => 'Delete Publisher',
            'description' => 'A test book for deletion.',
            'price' => 200000,
            'stock' => 5,
            'datePublished' => '2024-01-01',
            'genre' => 'nonfiction',
            'onlineLink' => 'https://example.com/to-be-deleted',
        ];

        $book = Books::create($data);

        // Act
        $book->delete();

        // Assert
        $this->assertDatabaseMissing('books', $data);
    }
}
