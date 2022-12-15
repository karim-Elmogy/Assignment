<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name'=>'SERVICE',
            'email'=>'service@gmail.com',
            'password'=>bcrypt('12345678'),
        ]);
    }
}
