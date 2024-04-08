<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define category data
        $categories = [
            [
                'title' => 'Technology',
                'description' => 'Articles related to technology and gadgets.',
            ],
            [
                'title' => 'Travel',
                'description' => 'Posts about travel destinations and experiences.',
            ],
            [
                'title' => 'Food',
                'description' => 'Recipes, restaurant reviews, and food-related content.',
            ],
            [
                'title' => 'Fitness',
                'description' => 'Fitness tips, workout routines, and health advice.',
            ],
            [
                'title' => 'Fashion',
                'description' => 'Fashion trends, style guides, and clothing reviews.',
            ],
        ];


         // Insert categories into the database
         foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
}
