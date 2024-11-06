<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Talaba;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // for ($i=1; $i <=10 ; $i++) { 
        //     Talaba::create(['name'=>'name'.$i,'age'=>rand(18,30),'adress'=>'adress'.$i]);
        // }
        for ($i=1; $i <=10 ; $i++) { 
            Post::create(['title'=>'title'.$i,'description'=>'description'.$i,'text'=>'text'.$i,'img'=>'img'.$i]);
        }
    }
}
