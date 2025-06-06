<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    //
    public function index(){
        $post = Post::latest();

        return view("home", [
            "posts" => $post->with(["user"])->get(),
        ]);
    }

    public function create()
    {
        return view("admin.upload");
    }


    // public function store(Request $request){
    //     $validatedData = $request->validate([
    //         'title'=> 'required|max:255',
    //         'slug'=>'required|max:255|unique:posts',
    //         'image'=> 'image|file',
    //         'content'=> 'required',
    //     ]);

    //     if($request->file('image')){
    //         $validatedData['image'] = $request->file('image')->store('post-images');
    //     }

    //     $validatedData['user_id'] = Auth::user()->id;
    //     $validatedData['excerpt'] = Str::limit($request->content, 100, '...');

    //     Post::create($validatedData);
    //     return redirect('/upload')->with('success', 'Berhasil membuat berita');
    // }

    public function show(Post $post){
        $post->load('user');
        return view("post", [
            "post" => $post,
        ]);
    }

    // public function createSlug(Request $request){
    //     $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
    //     return response()->json(['slug' => $slug]);
    // }

    // public function destroy(Post $post){
        

    //     Post::destroy($post->id);
    //     return redirect('/upload')->with('success', 'Berhasil menghapus berita');
    // }
}
