<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //dev
        if (config('app.env') === 'dev') {
            User::factory()
                ->count(10)
                ->has(
                    Book::factory()
                        ->count(10)
                        ->has(
                            Chapter::factory()
                                ->count(5)
                                ->state(function (array $attributes, Book $book) {
                                    return ['user_id' => $book->user->id];
                                })
                                ->has(
                                    Page::factory()
                                        ->count(10)
                                        ->state(function (array $attributes, Chapter $chapter) {
                                            return ['user_id' => $chapter->user->id];
                                        })
                                )
                        )
                )
                ->create();
        }

        //prod
        $this->call([
            PermissionsSeed::class,
        ]);

        $role = Role::create(['name' => 'admin']);
        $permissions = Permission::all();

        $role->syncPermissions($permissions);

        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@wikisox.fr',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole($role);
    }
}
