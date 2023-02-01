<?php

namespace Database\Seeders;

use App\Models\PermissionResource;
use Illuminate\Database\Seeder;

class PermissionsResourcesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $datas = [
            [
                'name'        => 'book_create',
                'description' => 'Créer un livre',
            ],
            [
                'name'        => 'book_edit',
                'description' => 'Modifier un livre',
            ],
            [
                'name'        => 'book_delete',
                'description' => 'Supprimer un livre',
            ],
            [
                'name'        => 'book_like',
                'description' => 'Aimer un livre',
            ],
            [
                'name'        => 'chapter_create',
                'description' => 'Créer un chapitre',
            ],
            [
                'name'        => 'chapter_edit',
                'description' => 'Modifier un chapitre',
            ],
            [
                'name'        => 'chapter_delete',
                'description' => 'Supprimer un chapitre',
            ],
            [
                'name'        => 'chapter_like',
                'description' => 'Aimer un chapitre',
            ],
            [
                'name'        => 'page_create',
                'description' => 'Créer une page',
            ],
            [
                'name'        => 'page_edit',
                'description' => 'Modifier une page',
            ],
            [
                'name'        => 'page_delete',
                'description' => 'Supprimer une page',
            ],
            [
                'name'        => 'page_like',
                'description' => 'Aimer une page',
            ],
        ];

        foreach ($datas as $data) {
            PermissionResource::create($data);
        }
    }
}
