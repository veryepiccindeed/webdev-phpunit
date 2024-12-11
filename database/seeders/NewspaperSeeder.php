<?php

namespace Database\Seeders;

use App\Models\Newspaper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewspaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Newspaper::create([
            'title' => 'Global News Weekly',
            'author' => 'Alice Johnson',
            'publisher' => 'Global Publishing Group',
            'description' => 'A weekly newspaper featuring in-depth analysis of world events, politics, and economic trends.',
            'price' => 10000,
            'stock' => 150,
            'datePublished' => '2023-09-20',
            'onlineLink' => 'https://example.com/newspaper/global-news-weekly',
            'catalogue_type' => 'newspaper',
        ]);

        Newspaper::create([
            'title' => 'Tech Today',
            'author' => 'Michael Brown',
            'publisher' => 'Tech Media',
            'description' => 'A specialized newspaper focused on the latest trends in technology, startups, and innovation.',
            'price' => 6000,
            'stock' => 50,
            'datePublished' => '2023-11-01',
            'onlineLink' => 'https://example.com/newspaper/tech-today',
            'catalogue_type' => 'newspaper',
        ]);

        Newspaper::create([
            'title' => 'Sports World',
            'author' => 'Sarah Davis',
            'publisher' => 'Sports Media Group',
            'description' => 'A daily sports newspaper covering all major sporting events, player updates, and analysis.',
            'price' => 4000,
            'stock' => 120,
            'datePublished' => '2023-10-15',
            'onlineLink' => 'https://example.com/newspaper/sports-world',
            'catalogue_type' => 'newspaper',
        ]);
    }
}
