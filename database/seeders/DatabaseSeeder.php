<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        // \App\Models\User::factory(10)->create();
        $userData = [
            [
               'name'=>'Admin',
               'email'=>'admin@gmail.com',
                'is_super'=>'1',
               'password'=> bcrypt('admin@123'),
            ],
            [
               'name'=>'Shivam',
               'email'=>'shivam@gmail.com',
                'is_super'=>'0',
               'password'=> bcrypt('789456123'),
            ],
        ];
  
        foreach ($userData as $key => $val) {
            Admin::create($val);
        }
    }
}
