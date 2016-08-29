<?php

class UserArchive extends \Eloquent {

    protected $connection = 'cl_archive';
    protected $table = 'users';

}

class UserArchiveTableSeeder extends Seeder {
    public function run(){
        $userData = UserArchive::all();
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table('users')->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        Eloquent::unguard();
        foreach ($userData as $userSingle){
            User::create([
                'id'    => $userSingle->id
                'username'  => $userSingle->username
                'password'  => $userSingle->
                'email'     => $userSingle->
                'points'    => $userSingle->
                'profile'   => $userSingle->
                'login_at'  => $userSingle->

            ]);
        }
    }
}