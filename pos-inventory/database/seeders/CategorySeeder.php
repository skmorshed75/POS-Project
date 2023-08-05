<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            "name" => "Italian Cuisine",
            "user_id"=>"01"
        ]);
        DB::table('categories')->insert([
            "name" => "Italian Cuisine",
            "user_id"=>"01"
        ]);
        DB::table('categories')->insert([
            "name" => "Mexican Food",
            "user_id"=>"01"
        ]);
        DB::table('categories')->insert([
            "name" => "Indian Dishes",
            "user_id"=>"01"
        ]);
        DB::table('categories')->insert([
            "name" => "Japanese Sushi",
            "user_id"=>"01"
        ]);
        DB::table('categories')->insert([
            "name" => "American BBQ",
            "user_id"=>"01"
        ]);
        DB::table('categories')->insert([
            "name" => "Thai Food",
            "user_id"=>"01"
        ]);
        DB::table('categories')->insert([
            "name" => "Bangla Food",
            "user_id"=>"01"
        ]);
        DB::table('categories')->insert([
            "name" => "Chinese Food",
            "user_id"=>"01"
        ]);
        DB::table('categories')->insert([
            "name" => "Indonesian Snacks",
            "user_id"=>"01"
        ]);        
    }
}
