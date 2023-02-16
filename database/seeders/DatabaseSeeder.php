<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Page;
use App\Models\User;
use Database\Factories\BookFactory;
use Database\Factories\ChapterFactory;
use Database\Factories\PageFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {

        User::factory()
            ->count(10)
            ->has(Book::factory()
                ->count(10)
                ->has(Chapter::factory()
                    ->count(5)
                    ->state(function (array $attributes, Book $book) {
                        return ['user_id' => $book->user->id];
                    })
                    ->has(Page::factory()
                        ->count(10)
                        ->state(function (array $attributes, Chapter $chapter) {
                            return ['user_id' => $chapter->user->id];
                        })
                    )
                )
            )
            ->create();

       /* $this->call([
            PermissionSystemSeeder::class,
            PermissionsResourcesSeed::class,
        ]);*/
    }
}
