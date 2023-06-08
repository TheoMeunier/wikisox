<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name'        => 'book create',
            ],
            [
                'name'        => 'book edit',
            ],
            [
                'name'        => 'book delete',
            ],
            [
                'name'        => 'chapter create',
            ],
            [
                'name'        => 'chapter edit',
            ],
            [
                'name'        => 'chapter delete',
            ],
            [
                'name'        => 'page create',
            ],
            [
                'name'        => 'page edit',
            ],
            [
                'name'        => 'page delete',
            ],
        ];

        foreach ($datas as $data) {
            Permission::create($data);
        }
    }
}
