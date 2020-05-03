<?php

use VotablesSeederTable;
use FavoritesTableSeeder;
use Illuminate\Database\Seeder;
use UsersQuestionsAnswersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersQuestionsAnswersTableSeeder::class,
            FavoritesTableSeeder::class,
            VotablesSeederTable::class,
        ]);
    }
}
