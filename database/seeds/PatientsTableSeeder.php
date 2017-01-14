<?php

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'pat_uname' => str_random(10),
            'pat_fname' => str_random(10),
            'pat_lname' => str_random(10),
            'weight' => 2,
            'height' => 2,
            'age' => 2,
            'sex' => str_random(1),
            'mother_name' => str_random(10),
            'address' => str_random(10),
            'pat_bdate' => date("Y-m-d"),
            'registration_date' => date("Y-m-d"),
            'pat_pass' => bcrypt('secret'),
        ]);
    }
}
