<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Game;
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

    public function mount()
    {
        $this->post = Post::with('games','games.questions')->get();
        $this->currentQuestion = $this->post[0]->games[0]->questions[$this->currentIndex];
    }

    public function answer($option)
    {
        // dd($option);
        if ($option == $this->currentQuestion->correct_answer) {
            $this->score++;
        }

        $this->currentIndex++;

        if ($this->currentIndex < $this->post[0]->games[0]->questions->count()) {
            $this->currentQuestion = $this->post[0]->games[0]->questions[$this->currentIndex];
        } else {
            $this->showResult = true;
            GameResult::create(['game_id' => $this->post[0]->games[0]->id, 'user_id' => Auth::user()->id, 'score' => $this->score]);
        }
    }

    public function render()
    {
        return view('livewire.quiz-game');
    }
}
