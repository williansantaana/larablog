<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(['name' => 'Uncategorized'])->create();
        Category::factory(['name' => 'Routing'])->create();
        Category::factory(['name' => 'Middleware'])->create();
        Category::factory(['name' => 'Controllers'])->create();
        Category::factory(['name' => 'Views'])->create();
        Category::factory(['name' => 'Models'])->create();
        Category::factory(['name' => 'Eloquent ORM'])->create();
        Category::factory(['name' => 'Artisan Console'])->create();
        Category::factory(['name' => 'Security'])->create();
        Category::factory(['name' => 'Migrations'])->create();
        Category::factory(['name' => 'Form Validation'])->create();
        Category::factory(['name' => 'Queues'])->create();
        Category::factory(['name' => 'Broadcasting'])->create();
        Category::factory(['name' => 'Notifications'])->create();
        Category::factory(['name' => 'Testing'])->create();
        Category::factory(['name' => 'API Development'])->create();
    }
}
