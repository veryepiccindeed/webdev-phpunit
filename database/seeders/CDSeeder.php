<?php

namespace Database\Seeders;

use App\Models\CD;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CD::create([
            'title' => 'The Lion King Soundtrack',
            'author' => 'Hans Zimmer, Elton John, Tim Rice',
            'publisher' => 'Walt Disney Records',
            'description' => 'The soundtrack for the 1994 animated classic, featuring music by Hans Zimmer and iconic songs by Elton John and Tim Rice.',
            'price' => 200000,
            'stock' => 10,
            'datePublished' => '1994-05-31',
            'genre' => 'fiction',
            'onlineLink' => 'https://example.com/the-lion-king-soundtrack',
            'catalogue_type' => 'CD',
        ]);

        CD::create([
            'title' => 'Frozen',
            'author' => 'Kristen Anderson-Lopez, Robert Lopez',
            'publisher' => 'Walt Disney Records',
            'description' => 'The soundtrack for the animated hit film Frozen, featuring the Oscar-winning song "Let It Go."',
            'price' => 180000,
            'stock' => 8,
            'datePublished' => '2013-11-19',
            'genre' => 'fiction',
            'onlineLink' => 'https://example.com/frozen-soundtrack',
            'catalogue_type' => 'CD',
        ]);

        CD::create([
            'title' => 'Guardians of the Galaxy Awesome Mix Vol. 1',
            'author' => 'Various Artists',
            'publisher' => 'Marvel Music',
            'description' => 'The soundtrack album featuring classic songs from the 1970s and 1980s featured in the blockbuster film Guardians of the Galaxy.',
            'price' => 150000,
            'stock' => 12,
            'datePublished' => '2014-07-29',
            'genre' => 'fiction',
            'onlineLink' => 'https://example.com/guardians-of-the-galaxy-awesome-mix',
            'catalogue_type' => 'CD',
        ]);
    }
}
