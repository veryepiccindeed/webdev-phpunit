<?php

namespace Database\Seeders;

use App\Models\FinalYearProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinalYearProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FinalYearProject::create([
            'title' => 'Design and Implementation of an E-commerce Website',
            'author' => 'John Doe',
            'publisher' => 'IMT University',
            'description' => 'This project involves the design and development of a fully functional e-commerce website that supports user authentication, product management, and online payment systems.',
            'stock' => 5,
            'datePublished' => '2023-10-15',
            'onlineLink' => 'https://example.com/project/e-commerce-website',
            'catalogue_type' => 'final year project',
        ]);

        FinalYearProject::create([
            'title' => 'Artificial Intelligence in Healthcare: Predictive Analytics',
            'author' => 'Jane Smith',
            'publisher' => 'IMT University',
            'description' => 'This project explores the application of artificial intelligence in healthcare for predictive analytics, focusing on disease detection and patient care optimization.',
            'stock' => 3,
            'datePublished' => '2022-06-20',
            'onlineLink' => 'https://example.com/project/ai-healthcare-predictive-analytics',
            'catalogue_type' => 'final year project',
        ]);

        FinalYearProject::create([
            'title' => 'Blockchain Technology in Supply Chain Management',
            'author' => 'Alice Johnson',
            'publisher' => 'IMT University',
            'description' => 'This project investigates the integration of blockchain technology in supply chain management, enhancing transparency, security, and efficiency.',
            'stock' => 4,
            'datePublished' => '2023-05-12',
            'onlineLink' => 'https://example.com/project/blockchain-supply-chain',
            'catalogue_type' => 'final year project',
        ]);
    }
}
