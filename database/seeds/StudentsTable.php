<?php

use App\Student;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentsTable extends Seeder
{

    public function run()
    {
        $faker = Factory::create();

        Student::truncate();

        foreach (range(1,200)as $a){
            Student::create([
                'name'      =>  $faker->name,
                'nim'       =>  Str::random('10'),
                'address'   =>  $faker->address


            ]);
        }
    }
}
