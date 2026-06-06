<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // 1. Création de tes quatre catégories officielles
    $categories = [
        ['name' => 'Traditions', 'slug' => 'traditions'],
        ['name' => 'Gastronomie', 'slug' => 'gastronomie'],
        ['name' => 'Histoire', 'slug' => 'histoire'],
        ['name' => 'Tourisme', 'slug' => 'tourisme'],
    ];

    foreach ($categories as $category) {
        \App\Models\Category::create($category);
    }

    // 2. Génération de 6 faux articles liés au hasard à tes nouvelles catégories
    \App\Models\Post::factory(6)->create();
}
}
