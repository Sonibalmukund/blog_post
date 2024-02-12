<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user=User::factory()->create([
            'name'=>'Ajay'
        ]);
        Post::factory(5)->create([
            'user_id'=>$user->id
        ]);
//        $user=User::create([
//            'name'=>'abc',
//            'email'=>'tsauer@example.net',
//            'password'=>'password'
//        ]);
//        $personal=Category::create([
//            'name'=>'Personal',
//            'slug'=>'personal'
//        ]);
//        $family=Category::create([
//            'name'=>'Family',
//            'slug'=>'family'
//        ]);
//        $work=Category::create([
//            'name'=>'Work',
//            'slug'=>'work'
//        ]);
//
//        Post::create([
//        'user_id'=>$user->id,
//         'category_id'=>$family->id,
//         'title'=>'My Family Post',
//         'slug'=>'my-family-post',
//          'expert'=>'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>',
//          'body'=>'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit</p>'
//        ]);
//        Post::create([
//            'user_id'=>$user->id,
//            'category_id'=>$personal->id,
//            'title'=>'My Personal Post',
//            'slug'=>'my-personal-post',
//            'expert'=>'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>',
//            'body'=>'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit</p>'
//        ]);
//        Post::create([
//            'user_id'=>$user->id,
//            'category_id'=>$work->id,
//            'title'=>'My Work Post',
//            'slug'=>'my-$work-post',
//            'expert'=>'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>',
//            'body'=>'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit</p>'
//        ]);
    }
}
