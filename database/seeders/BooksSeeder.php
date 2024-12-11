<?php

namespace Database\Seeders;

use App\Models\Books;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Books::create([
            'title' => 'A Hunger for More',
            'author' => 'Amy DiMarcangelo',
            'publisher' => 'Crossway',
            'description' => 'Many Christians—especially those who have grown up in the church—seem to have “good” lives, free from extreme hardship and scandalous sin. Yet even this good life leaves them longing. Regardless of our backgrounds and circumstances, all of us have a deep hunger that only Jesus can satisfy. In this book, Amy DiMarcangelo invites readers to feast at the table of grace, where they will find God’s vast glory and intimate care, his strength made perfect in weakness, and his gifts of joy and comfort. Even the most hungry Christians will be encouraged that they “may be filled with all the fullness of God” (Ephesians 3:19).',
            'datePublished' => '2022-01-10',
            'genre' => 'nonfiction',
            'price' => 100000,
            'stock' => 3,
            'onlineLink' => 'https://www.amazon.com/Hunger-More-Finding-Satisfaction-Coalition/dp/1433575108'
        ]);

        Books::create([
            'title' => 'Becoming',
            'author' => 'Michelle Obama',
            'publisher' => 'Crown Publishing Group',
            'description' => 'An intimate, powerful, and inspiring memoir by the former First Lady of the United States. In a life filled with meaning and accomplishment, Michelle Obama has emerged as one of the most iconic and compelling women of our era.',
            'datePublished' => '2018-11-13',
            'genre' => 'biography',
            'price' => 200000,
            'stock' => 4,
            'onlineLink' => 'https://www.amazon.com/Becoming-Michelle-Obama/dp/1524763136'
        ]);

        Books::create([
            'title' => 'The Midnight Library',
            'author' => 'Matt Haig',
            'publisher' => 'Canongate Books',
            'description' => 'Between life and death there is a library, and within that library, the shelves go on forever. Every book provides a chance to try another life you could have lived. To see how things would be if you had made other choices. Would you have done anything different, if you had the chance to undo your regrets?',
            'datePublished' => '2020-08-13',
            'genre' => 'fiction',
            'price' => 120000,
            'stock' => 6,
            'onlineLink' => 'https://www.amazon.com/Midnight-Library-Novel-Matt-Haig/dp/0525559477'
        ]);
    }
}
