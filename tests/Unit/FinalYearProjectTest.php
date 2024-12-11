<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\FinalYearProject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class FinalYearProjectTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_final_year_project()
    {
        // Arrange
        $data = [
            'title' => 'Artificial Intelligence in Healthcare',
            'author' => 'Alice Smith',
            'publisher' => 'University Press',
            'description' => 'A project exploring AI applications in the medical field.',
            'stock' => 10,
            'datePublished' => '2024-05-10',
            'onlineLink' => 'https://example.com/ai-healthcare',
            'catalogue_type' => 'final year project',
        ];

        // Act
        $project = FinalYearProject::create($data);

        // Assert
        $this->assertInstanceOf(FinalYearProject::class, $project);
        $this->assertEquals('Artificial Intelligence in Healthcare', $project->title);
        $this->assertEquals('Alice Smith', $project->author);
        $this->assertEquals('University Press', $project->publisher);
        $this->assertEquals('final year project', $project->catalogue_type);
    }

    #[Test]
    public function it_requires_mandatory_fields()
    {
        // Arrange
        $this->expectException(\Illuminate\Database\QueryException::class);

        // Act
        FinalYearProject::create([]);
    }

    #[Test]
    public function it_can_delete_a_final_year_project()
    {
        // Arrange
        $data = [
            'title' => 'Test Project for Deletion',
            'author' => 'Bob Johnson',
            'publisher' => 'Academic Publisher',
            'description' => 'A test final year project for deletion.',
            'stock' => 5,
            'datePublished' => '2024-06-01',
            'onlineLink' => 'https://example.com/test-project-deletion',
            'catalogue_type' => 'final year project',
        ];

        $project = FinalYearProject::create($data);

        // Act
        $project->delete();

        // Assert
        $this->assertDatabaseMissing('final_year_projects', $data);
    }
}
