<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'user_id' => 1,
                'title' => 'Premier post',
                'content' => 'Contenu du premier post.',
            ],
            [
                'user_id' => 2,
                'title' => 'Deuxième post',
                'content' => 'Contenu du deuxième post.',
            ],
            [
                'user_id' => 3,
                'title' => 'Troisième post',
                'content' => 'Contenu du troisième post.',
            ],
        ]);
    }
}
