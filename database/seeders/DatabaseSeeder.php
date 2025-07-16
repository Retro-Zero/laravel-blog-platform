<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create additional users
        User::factory(5)->create();

        // Add real categories
        $categories = [
            'Technology',
            'Health',
            'Lifestyle',
            'Business',
            'Environment',
            'Psychology',
            'Marketing',
            'Travel',
            'Food',
            'Science',
            'Education',
            'Finance',
            'Art',
            'Sports',
            'Parenting',
            'Fashion',
            'Photography',
            'Books',
            'Movies',
            'Music',
        ];

        foreach ($categories as $categoryName) {
            Category::create(['name' => $categoryName]);
        }

        // Get all categories for use in posts
        $allCategories = Category::all();

        // Create posts with relationships
        Post::factory(20)
            ->published()
            ->create()
            ->each(function ($post) use ($allCategories) {
                $post->update([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'category_id' => $allCategories->random()->id,
                ]);
            });

        // Create some draft posts
        Post::factory(5)
            ->draft()
            ->create()
            ->each(function ($post) use ($allCategories) {
                $post->update([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'category_id' => $allCategories->random()->id,
                ]);
            });

        // Create some archived posts
        Post::factory(3)
            ->archived()
            ->create()
            ->each(function ($post) use ($allCategories) {
                $post->update([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'category_id' => $allCategories->random()->id,
                ]);
            });
    }
}
