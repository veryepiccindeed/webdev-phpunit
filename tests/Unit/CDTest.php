<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\CD;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class CDTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_cd()
    {
        // Arrange
        $data = [
            'title' => 'Greatest Hits',
            'author' => 'John Legend',
            'publisher' => 'Music Studio',
            'description' => 'A collection of the greatest hits by John Legend.',
            'price' => 250000,
            'stock' => 15,
            'datePublished' => '2023-08-10',
            'genre' => 'biography',
            'onlineLink' => 'https://example.com/greatest-hits',
            'catalogue_type' => 'CD',
        ];

        // Act
        $cd = CD::create($data);

        // Assert
        $this->assertInstanceOf(CD::class, $cd);
        $this->assertEquals('Greatest Hits', $cd->title);
        $this->assertEquals('John Legend', $cd->author);
        $this->assertEquals('Music Studio', $cd->publisher);
        $this->assertEquals('CD', $cd->catalogue_type);
    }

    #[Test]
    public function it_requires_mandatory_fields()
    {
        // Arrange
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Act
        CD::create([]);
    }

    #[Test]
    public function it_can_delete_a_cd()
    {
        // Arrange
        $data = [
            'title' => 'To Be Deleted',
            'author' => 'John Doe',
            'publisher' => 'Delete Studio',
            'description' => 'A test CD for deletion.',
            'price' => 100000,
            'stock' => 5,
            'datePublished' => '2024-01-01',
            'genre' => 'fiction',
            'onlineLink' => 'https://example.com/to-be-deleted',
            'catalogue_type' => 'CD',
        ];

        $cd = CD::create($data);

        // Act
        $cd->delete();

        // Assert
        $this->assertDatabaseMissing('c_d_s', $data);
    }
}
