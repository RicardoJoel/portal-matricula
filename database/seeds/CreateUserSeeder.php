<?php
  
use Illuminate\Database\Seeder;
use App\User;
   
class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [[
            'is_admin' => true,
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('RvMl2IG#'),
        ],[
            'name' => 'Ricardo',
            'lastname' => 'Béjar',
            'email' => 'ricardo.jbl2011@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('ToP%$YGy'),
        ],[
            'name' => 'Jorge',
            'lastname' => 'Bustamante',
            'email' => 'jbustamante@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('preciso2020'),
            'is_blocked' => true,
        ]];

        foreach ($array as $item)
            User::create($item);
    }
}
