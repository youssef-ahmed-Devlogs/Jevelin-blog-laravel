<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Youssef',
            'last_name' => 'Ahmed',
            'username' => 'youssef',
            'phone' => '01154214028',
            'email' => 'youssef@gmail.com',
            'password' => Hash::make('123123123'),
        ]);

        $category1 = Category::create([
            'en' => [
                'title' => 'Design',
                'description' => 'Design',
            ],
            'ar' => [
                'title' => 'تصميم',
                'description' => 'تصميم',
            ],
        ]);

        $category2 = Category::create([
            'en' => [
                'title' => 'Travel',
                'description' => 'Travel',
            ],
            'ar' => [
                'title' => 'سفر',
                'description' => 'سفر',
            ],
        ]);

        $categories = [$category1->id, $category2->id];

        $article = Article::create([
            'user_id' => $user->id,
            'image' => 'images/empty.png',
            'en' => [
                'title' => 'Article in english',
                'content' => 'Article in english Article in english Article',
            ],
            'ar' => [
                'title' => 'مقالة عربية',
                'content' => 'مقالة عربية مقالة عربية مقالة عربية مقالة عربية مقالة عربية',
            ],
        ]);

        $article->categories()->attach($categories);
    }
}
