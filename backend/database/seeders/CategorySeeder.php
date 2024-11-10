<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::firstOrCreate([
            'name' => 'Freelance',
            'type' => 'income',
        ]);

        Category::firstOrCreate([
            'name' => 'Investimentos',
            'type' => 'income',
        ]);

        Category::firstOrCreate([
            'name' => 'Salário',
            'type' => 'income',
        ]);

        Category::firstOrCreate([
            'name' => 'Outros',
            'type' => 'income',
        ]);

        Category::firstOrCreate([
            'name' => 'Alimentação',
            'type' => 'expense',
        ]);

        Category::firstOrCreate([
            'name' => 'Educação',
            'type' => 'expense',
        ]);

        Category::firstOrCreate([
            'name' => 'Lazer',
            'type' => 'expense',
        ]);

        Category::firstOrCreate([
            'name' => 'Moradia',
            'type' => 'expense',
        ]);

        Category::firstOrCreate([
            'name' => 'Saúde',
            'type' => 'expense',
        ]);

        Category::firstOrCreate([
            'name' => 'Transporte',
            'type' => 'expense',
        ]);

        Category::firstOrCreate([
            'name' => 'Outros',
            'type' => 'expense',
        ]);
    }
}
