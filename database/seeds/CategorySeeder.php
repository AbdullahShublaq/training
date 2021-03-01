<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            ['name' => 'category1'],
            ['name' => 'category2'],
        ];
        foreach ($categories as $category){
            \App\Category::create($category);
        }
    }
}
