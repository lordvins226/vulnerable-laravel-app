<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            [
                'content' => 'Premier commentaire',
            ],
            [
                'content' => 'Deuxième commentaire',
            ],
            [
                'content' => 'Troisième commentaire',
            ],
        ]);
    }
}
