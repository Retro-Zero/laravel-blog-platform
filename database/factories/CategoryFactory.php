<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(rand(1, 3), true);
        
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(2),
            'color' => $this->faker->randomElement([
                '#3B82F6', // Blue
                '#10B981', // Green
                '#F59E0B', // Yellow
                '#EF4444', // Red
                '#8B5CF6', // Purple
                '#F97316', // Orange
                '#06B6D4', // Cyan
                '#84CC16', // Lime
            ]),
        ];
    }

    /**
     * Indicate that the category is popular.
     */
    public function popular(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $this->faker->randomElement([
                'Technology',
                'Programming',
                'Web Development',
                'Laravel',
                'PHP',
                'JavaScript',
                'React',
                'Vue.js',
            ]),
        ]);
    }

    /**
     * Indicate that the category is tech-related.
     */
    public function tech(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $this->faker->randomElement([
                'Artificial Intelligence',
                'Machine Learning',
                'Data Science',
                'Cybersecurity',
                'Cloud Computing',
                'DevOps',
                'Mobile Development',
                'UI/UX Design',
            ]),
            'color' => '#3B82F6',
        ]);
    }

    /**
     * Indicate that the category is lifestyle-related.
     */
    public function lifestyle(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $this->faker->randomElement([
                'Health & Fitness',
                'Travel',
                'Food & Cooking',
                'Personal Development',
                'Productivity',
                'Mindfulness',
                'Relationships',
                'Career Advice',
            ]),
            'color' => '#10B981',
        ]);
    }
} 