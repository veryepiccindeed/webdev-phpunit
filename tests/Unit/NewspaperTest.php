<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Newspaper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class NewspaperTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_newspaper()
    {
        // Arrange
        $data = [
            'title' => 'Daily News',
            'author' => 'Jane Doe',
            'publisher' => 'News Media Group',
            'description' => 'Breaking news updates and stories.',
            'price' => 10000,
            'stock' => 50,
            'datePublished' => '2023-12-01',
            'onlineLink' => 'https://example.com/daily-news',
            'catalogue_type' => 'newspaper',
        ];

        // Act
        $newspaper = Newspaper::create($data);

        // Assert
        $this->assertInstanceOf(Newspaper::class, $newspaper);
        $this->assertEquals('Daily News', $newspaper->title);
        $this->assertEquals('Jane Doe', $newspaper->author);
        $this->assertEquals('News Media Group', $newspaper->publisher);
        $this->assertEquals('newspaper', $newspaper->catalogue_type);
    }

    #[Test]
    public function it_requires_mandatory_fields()
    {
        // Arrange
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Act
        Newspaper::create([]);
    }

    #[Test]
    public function it_can_delete_a_newspaper()
    {
        // Arrange
        $data = [
            'title' => 'To Be Deleted Newspaper',
            'author' => 'John Doe',
            'publisher' => 'Delete Media Group',
            'description' => 'A test newspaper for deletion.',
            'price' => 5000,
            'stock' => 30,
            'datePublished' => '2024-01-01',
            'onlineLink' => 'https://example.com/to-be-deleted-newspaper',
            'catalogue_type' => 'newspaper',
        ];

        $newspaper = Newspaper::create($data);

        // Act
        $newspaper->delete();

        // Assert
        $this->assertDatabaseMissing('newspapers', $data);
    }
}
