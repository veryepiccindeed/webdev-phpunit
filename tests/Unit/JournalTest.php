<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Journal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class JournalTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_journal()
    {
        // Arrange
        $data = [
            'title' => 'Journal of Computer Science',
            'author' => 'Dr. John Doe',
            'publisher' => 'Tech Publications',
            'description' => 'A journal on the latest trends in computer science.',
            'price' => 25000,
            'stock' => 30,
            'datePublished' => '2024-01-15',
            'volume' => 12,
            'series' => 4,
            'number' => 2,
            'onlineLink' => 'https://example.com/journal-of-computer-science',
        ];

        // Act
        $journal = Journal::create($data);

        // Assert
        $this->assertInstanceOf(Journal::class, $journal);
        $this->assertEquals('Journal of Computer Science', $journal->title);
        $this->assertEquals('Dr. John Doe', $journal->author);
        $this->assertEquals('Tech Publications', $journal->publisher);
        $this->assertEquals(12, $journal->volume);
        $this->assertEquals(4, $journal->series);
        $this->assertEquals(2, $journal->number);
    }

    #[Test]
    public function it_requires_mandatory_fields()
    {
        // Arrange
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Act
        Journal::create([]);
    }

    #[Test]
    public function it_can_delete_a_journal()
    {
        // Arrange
        $data = [
            'title' => 'Test Journal for Deletion',
            'author' => 'Alice Johnson',
            'publisher' => 'Academic Publisher',
            'description' => 'A journal test entry to be deleted.',
            'price' => 15000,
            'stock' => 10,
            'datePublished' => '2024-02-10',
            'volume' => 5,
            'series' => 2,
            'number' => 1,
            'onlineLink' => 'https://example.com/test-journal-deletion',
        ];

        $journal = Journal::create($data);

        // Act
        $journal->delete();

        // Assert
        $this->assertDatabaseMissing('journals', $data);
    }
}
