<?php

use Illuminate\Database\Seeder;
use App\Teacher;
   
class CreateTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [[
            'name' => 'José',
            'lastname' => 'Olivera Alzamora',
        ],[
            'name' => 'Roxana',
            'lastname' => 'Escate Sarmiento',
        ],[
            'name' => 'Karen',
            'lastname' => 'Rocca Luque',
        ]];

        foreach ($array as $item)
            Teacher::create($item);
    }
}
