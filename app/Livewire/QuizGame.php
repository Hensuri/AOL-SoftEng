<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\GameResult;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuizGame extends Component
{
    public $post;
    public $currentIndex = 0;
    public $currentQuestion;
    public $score = 0;
    public $showResult = false;

    public function mount($post)
    {
        $this->post = $post;

        $hasPlayed = GameResult::where('post_id', $this->post->id)
                        ->where('user_id', Auth::id())
                        ->exists();

        if ($hasPlayed) {
            $this->showResult = true;
            $this->score = GameResult::where('post_id', $this->post->id)
                            ->where('user_id', Auth::id())
                            ->value('score');
            return;
        }

        $this->currentQuestion = $this->post->question[$this->currentIndex];
    }

    public function answer($option)
    {
        // 
        if ($option == $this->currentQuestion->correct_answer) {
            $this->score++;
        }

        $this->currentIndex++;

        if ($this->currentIndex < $this->post->question->count()) {
            $this->currentQuestion = $this->post->question[$this->currentIndex];
        } else {
            $this->showResult = true;
            GameResult::create(['post_id' => $this->post->id, 'user_id' => Auth::user()->id, 'score' => $this->score]);
        }
    }

    public function render()
    {
        return view('livewire.quiz-game');
    }
}
