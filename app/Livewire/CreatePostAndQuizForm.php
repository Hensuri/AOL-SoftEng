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

    public $title, $slug, $content, $image;
    public $questions = [];

    public function mount()
    {
        $this->addQuestion();
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
        // Validasi berita
        // dd([
        //     'title' => $this->title,
        //     'slug' => $this->slug,
        //     'content' => $this->content,
        //     'image' => $this->image,
        // ]);
        
        $validatedData = $this->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts,slug',
            'content' => 'required',
            'image' => 'image|max:20480',
        ]);
        // dd($validatedData);
        // Simpan gambar jika ada
        if ($this->image) {
            $validatedData['image'] = $this->image->store('post-images');
        }

        // Tambahkan data user & excerpt
        $validatedData['user_id'] = Auth::id();
        $validatedData['excerpt'] = Str::limit($this->content, 100, '...');

        // Simpan berita
        $post = Post::create($validatedData);

        foreach ($this->questions as $q) {
            if (!$q['question'] || !$q['a'] || !$q['b'] || !$q['c'] || !$q['d'] || !$q['correct']) {
                session()->flash('error', 'Semua kolom harus diisi.');
                return;
            }
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
    }

    public function render()
    {
        return view('livewire.create-post-and-quiz-form');
    }
}
