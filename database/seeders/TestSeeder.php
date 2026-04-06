<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('images')->insert([
            ['user_id' => 3,'image_path' => 'all_images/image1.jpg','description' => 'imagen 1 de alex'],
            ['user_id' => 3,'image_path' => 'all_images/image2.jpg','description' => 'imagen 2 de alex'],
            ['user_id' => 4,'image_path' => 'all_images/image3.jpg','description' => 'imagen 3 de marty'],
            ['user_id' => 4,'image_path' => 'all_images/image4.jpg','description' => 'imagen 4 de marty'],
            ['user_id' => 5,'image_path' => 'all_images/image5.jpg','description' => 'imagen 5 de gloria'],
        ]);

        DB::table('comments')->insert([
            ['user_id' => 4,'image_id' => 1,'content' => 'soy marty y me gusta esta imagen de alex'],
            ['user_id' => 5,'image_id' => 1,'content' => 'soy gloria y esta imagen es muy bonita de alex',],
            ['user_id' => 2,'image_id' => 3,'content' => 'soy alex y me gusta esta imagen de marty',]
        ]);

        DB::table('likes')->insert([
            ['user_id' => 4, 'image_id' => 1],
            ['user_id' => 5, 'image_id' => 1],
            ['user_id' => 3, 'image_id' => 3],
            ['user_id' => 5, 'image_id' => 2],
            ['user_id' => 4, 'image_id' => 4],
        ]);
    }
}