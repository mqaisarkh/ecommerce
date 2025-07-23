<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure there are users and categories first
        $users = User::all();
        $categories = Category::all();

        if ($users->count() === 0 || $categories->count() === 0) {
            $this->command->info('Please seed users and categories before running BlogSeeder.');
            return;
        }

        // Create fake blog posts
        for ($i = 0; $i < 20; $i++) {
            $title = fake()->sentence;

            Blog::create([
                'category_id' => $categories->random()->id,
                'author_id' => $users->random()->id,
                'title' => $title,
                'slug' => Str::slug($title) . '-' . Str::random(5),
                'body' => fake()->paragraphs(5, true),
                'featured' => fake()->boolean(30), // 30% chance of being featured
                'image' => fake()->optional()->imageUrl(800, 600, 'blog', true, 'Fake Blog'),
            ]);
        }
    }
}
