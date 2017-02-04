<?php

use Illuminate\Database\Seeder;

class FlavorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flavors')->truncate();
        DB::table('flavors')->insert([
            ['name'=>'I want to be a boat.'],
            ['name'=>'I like your face.'],
            ['name'=>'Why is up not down.'],
            ['name'=>'Banana banana banana teracotta banana teracotta teracotta pie.'],
            ['name'=>'Stick of death!'],
            ['name'=>'Who are you again?'],
            ['name'=>'You only YOLO once'],
            ['name'=>'Are you still here?']
        ]);
    }
}
