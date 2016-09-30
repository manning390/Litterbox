<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Don't run seeders in production
        if (App::environment() === 'production') exit();

        // Disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Dev seeders
        // $this->call(UsersSeeder::class);
        // $this->call(AclSeeder::class);
        // $this->call(BadgesSeeder::class);
        // $this->call(ThreadSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Archive Seeders
        $this->call(UserArchiveTableSeeder::class);

    }
}
