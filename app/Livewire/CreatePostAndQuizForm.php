<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CreatePostAndQuizForm extends Component
{
    use WithFileUploads;

    public $title, $slug, $content, $image, $post, $excerpt, $old_slug, $id;
    public $questions = [];

    public function mount($post)
    {
        $this->post = $post;
        $this->id = $post->id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->content = $post->content;
        $this->image = $post->image;
        $this->excerpt = $post->excerpt;
        $this->old_slug = $post->slug;
        // $hasQuiz = Question::where('post_id', $this->post->id)
        //                 ->where('user_id', Auth::id())
        //                 ->exists();
        $dbQuestions = Question::where('post_id', $this->id)->get();

        // Jika ada, masukkan ke dalam $this->questions
        if ($dbQuestions->isNotEmpty()) {
            foreach ($dbQuestions as $q) {
                $this->questions[] = [
                    'question' => $q->question_text,
                    'a' => $q->option_a,
                    'b' => $q->option_b,
                    'c' => $q->option_c,
                    'd' => $q->option_d,
                    'correct' => $q->correct_answer,
                ];
            }
        }
        else{
            $this->addQuestion();
        }
        
    }

    public function addQuestion()
    {
        $this->questions[] = [
            'question' => '',
            'a' => '',
            'b' => '',
            'c' => '',
            'd' => '',
            'correct' => '',
        ];
    }

    public function deleteQuestion(int $index){
        unset($this->questions[$index]);
    }

    public function generateSlug(){
        $this->slug = SlugService::createSlug(Post::class, 'slug', $this->title);
    }


    public function save()
    {
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'required',
        ];
        
        if($this->slug != $this->old_slug){
            $rules['slug'] = 'required|unique:posts';
        }
        $validatedData = $this->validate($rules);

        $validatedData['user_id'] = Auth::id();

        $post = Post::updateOrCreate(
            ['id' => $this->id], 
            $validatedData
        );

        foreach ($this->questions as $q) {
            Question::create([
                'post_id' => $post->id,
                'question_text' => $q['question'],
                'option_a' => $q['a'],
                'option_b' => $q['b'],
                'option_c' => $q['c'],
                'option_d' => $q['d'],
                'correct_answer' => $q['correct'],
            ]);
        }

        $this->questions = [];
        $this->addQuestion();

        session()->flash('success', 'Pertanyaan berhasil disimpan.');
        return redirect('/admindashboard');
    }

    public function render()
    {
        // dd($this->post);
        return view('livewire.create-post-and-quiz-form', [
            'post' => $this->post
        ]);
    }
}
