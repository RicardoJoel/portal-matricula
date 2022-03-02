<?php
  
use Illuminate\Database\Seeder;
use App\Course;
   
class CreateCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [[
            'code' => 'MAT001',
            'name' => 'Matematica Básica',
            'hours' => 20
        ],[
            'code' => 'MAT002',
            'name' => 'Cálculo numérico',
            'hours' => 40
        ],[
            'code' => 'FIS001',
            'name' => 'Física 1',
            'hours' => 60
        ],[
            'code' => 'LEN002',
            'name' => 'Lenguaje y redacción',
            'hours' => 80
        ],[
            'code' => 'INF456',
            'name' => 'Diseño de Experimentos en SI',
            'hours' => 50
        ],[
            'code' => 'INF123',
            'name' => 'Soluciones Móviles y Cloud',
            'hours' => 40
        ]];

        foreach ($array as $item)
            Course::create($item);
    }
}
