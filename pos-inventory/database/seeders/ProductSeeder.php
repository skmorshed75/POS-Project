<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void 
    {
        DB::table('products')->insert([
            "name" => "Italian Cuisine",
            "user_id"=>"01",
            "category_id"=>"01",
            "price" => "10.00",
            "unit" => "kg",
            "img_url" => "https://example........."
        ]);

        $table->string('name',100);
        $table->string('price',50);
        $table->string('unit',50);
        $table->string('img_url',100);


        
    }
}
