<?php

namespace Database\Seeders;

use App\Models\Journal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Journal::create([
            'title' => 'Journal of Medical Research',
            'author' => 'Dr. Michael Johnson',
            'publisher' => 'Medical Research Society',
            'description' => 'A journal dedicated to publishing new and innovative research in medical science and health.',
            'price' => 100000,
            'stock' => 15,
            'datePublished' => '2023-10-10',
            'volume' => 45,
            'series' => 7,
            'number' => 2,
            'onlineLink' => 'https://example.com/journal/medical-research',
        ]);

        Journal::create([
            'title' => 'Environmental Studies Journal',
            'author' => 'Emily Clark',
            'publisher' => 'Environment Press',
            'description' => 'A journal that focuses on environmental studies, sustainability, and conservation efforts.',
            'price' => 180000,
            'stock' => 20,
            'datePublished' => '2023-07-22',
            'volume' => 18,
            'series' => 1,
            'number' => 4,
            'onlineLink' => 'https://example.com/journal/environmental-studies',
        ]);

        Journal::create([
            'title' => 'Journal of Arts and Culture',
            'author' => 'Prof. Linda Brown',
            'publisher' => 'Culture Publishing House',
            'description' => 'A journal exploring new research, trends, and articles on art, culture, and society.',
            'price' => 120000,
            'stock' => 8,
            'datePublished' => '2023-06-30',
            'volume' => 5,
            'series' => 2,
            'number' => 6,
            'onlineLink' => 'https://example.com/journal/arts-culture',
        ]);
    }
}
