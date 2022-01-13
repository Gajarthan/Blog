<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Gajarthan',
            'email' => 'gajarthan@gmail.com',
            'password' => Hash::make('Maithily0112'),
        ]);
        DB::table('categories')->insert([
            'name' => 'Category 1',
            'slug' => 'category-1',
            'description' => 'This is a category description',
            'imagePath' => '',
            'userId' => 1,
        ]);
        DB::table('categories')->insert([
            'name' => 'Category 2',
            'slug' => 'category-2',
            'description' => 'This is a category description',
            'imagePath' => '',
            'userId' => 1,
        ]);
        DB::table('posts')->insert([
            'title' => 'Post 1',
            'slug' => 'post-1',
            'description' => 'This is a Post 1 description',
            'imagePath' => '',
            'published' => 0,
            'userId' => 1,
            'categoryId' => 1,
        ]);
        DB::table('posts')->insert([
            'title' => 'Post 2',
            'slug' => 'post-2',
            'description' => 'This is a Post 2 description',
            'imagePath' => '',
            'published' => 0,
            'userId' => 1,
            'categoryId' => 2,
        ]);
    }
}
