<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            "name" => "John Doe",
            "email"=>"john@example.com",
            "mobile" => "0176463555",
            "user_id"=>"01"
        ]);
        DB::table('customers')->insert([
            "name" => "Jim Doe",
            "email"=>"jim@example.com",
            "mobile" => "440176463555",
            "user_id"=>"01"
        ]);
        DB::table('customers')->insert([
            "name" => "Jane Doe",
            "email"=>"jane@example.com",
            "mobile" => "65650176463555",
            "user_id"=>"01"
        ]);
        DB::table('customers')->insert([
            "name" => "Jimmy Doe",
            "email"=>"jimmy@example.com",
            "mobile" => "46576463555",
            "user_id"=>"01"
        ]);
        DB::table('customers')->insert([
            "name" => "Roksana Begum",
            "email"=>"roksana@example.com",
            "mobile" => "01675270634",
            "user_id"=>"01"
        ]);
        DB::table('customers')->insert([
            "name" => "Moonsana",
            "email"=>"moon@example.com",
            "mobile" => "440176463555",
            "user_id"=>"01"
        ]);
        DB::table('customers')->insert([
            "name" => "Pori",
            "email"=>"pori@example.com",
            "mobile" => "176463555",
            "user_id"=>"01"
        ]);
        DB::table('customers')->insert([
            "name" => "Seli Kamrun",
            "email"=>"selin@example.com",
            "mobile" => "0176463555",
            "user_id"=>"01"
        ]);
        DB::table('customers')->insert([
            "name" => "Ahsan Habin",
            "email"=>"habib@example.com",
            "mobile" => "0176463555",
            "user_id"=>"01"
        ]);
        DB::table('customers')->insert([
            "name" => "GM Tareq",
            "email"=>"tareq@example.com",
            "mobile" => "440176463555",
            "user_id"=>"01"
        ]);
        DB::table('customers')->insert([
            "name" => "Iftekhar Hossain",
            "email"=>"iftekhar@example.com",
            "mobile" => "440176463555",
            "user_id"=>"01"
        ]);
        DB::table('customers')->insert([
            "name" => "Sarwar uddin",
            "email"=>"jim@example.com",
            "mobile" => "440176463555",
            "user_id"=>"01"
        ]);
    }
}
