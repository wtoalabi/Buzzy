<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TermSeeder::class);
        $this->call(DescriptionSeeder::class);
        $this->call(SymbolSeeder::class);
    }
}
