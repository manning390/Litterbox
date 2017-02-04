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
        if(env('DB_CONNECTION') === 'mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        else if(env('DB_CONNECTION') === 'sqlite')
            DB::statement('PRAGMA foreign_keys = OFF');

        // Dev seeders
        $this->call(UsersSeeder::class);
        $this->call(AclSeeder::class);
        $this->call(BadgesSeeder::class);
        $this->call(ThreadSeeder::class);
        $this->call(FlavorSeeder::class);

        // Archive Seeders
        if(App::environment() === 'migration'){
            $this->call(UserArchiveTableSeeder::class);
        }

        if(env('DB_CONNECTION') === 'mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        else if(env('DB_CONNECTION') === 'sqlite')
            DB::statement('PRAGMA foreign_keys = ON');
    }
}
