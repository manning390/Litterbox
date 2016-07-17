<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        User::create([
            'name' => "Neko-Chan",
            'email' => 'test@test.com',
            'password' => bcrypt('123456'),
        ]);
            // 'options' => json_encode([
            //     'color' => '#ccc',
            //     'syntax' => 'm',
            //     'nsfw' => true,
            //     'mentionsEmail' => true,
            //     'pmsEmail' => true
            // ])
    }
}