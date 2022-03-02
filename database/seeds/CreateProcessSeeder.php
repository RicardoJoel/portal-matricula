<?php
  
use Illuminate\Database\Seeder;
use App\Process;
   
class CreateProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [[
            'code' => '2020-1',
            'start_at' => '2020-03-01',
            'end_at' => '2020-03-07',
        ]];

        foreach ($array as $item)
            Process::create($item);
    }
}
