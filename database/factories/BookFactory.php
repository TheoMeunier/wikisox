<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name;

        return [
            'name'        => $name,
            'slug'        => Str::slug($name),
            'description' => $this->faker->text,
            'image'       => 'https://picsum.photos/200/300',
        ];
    }
}
