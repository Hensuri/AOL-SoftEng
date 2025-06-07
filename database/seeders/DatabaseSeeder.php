<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Post;
use App\Models\Question;
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

        // Game::create([
        //     "post_id" => 1,
        // ]);

        Post::create([
            "title"=> "Testing",
            "user_id" => "1",
            "slug"=> "testing",
            "content"=>"Hallooo",
            "excerpt"=>"Hallooo",
        ]);

        Question::create([
            "post_id" => "1",
            "question_text" => "Berapa Hasil 1 + 1",
            "correct_answer" => "a",
            "option_a" => "2",
            "option_b" => "3",
            "option_c" => "4",
            "option_d" => "5",
        ]);

        Question::create([
            "post_id" => "1",
            "question_text" => "Berapa Hasil 2 + 1",
            "correct_answer" => "b",
            "option_a" => "2",
            "option_b" => "3",
            "option_c" => "4",
            "option_d" => "5",
        ]);

        
    }
}
