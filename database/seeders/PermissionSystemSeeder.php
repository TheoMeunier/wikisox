<?php

namespace Database\Seeders;

use App\Models\PermissionSystem;
use Illuminate\Database\Seeder;

class PermissionSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            'name' => 'access_dashbord',
            'description' => 'Acces au dashbord',
        ];

        PermissionSystem::create($data);
    }
}
