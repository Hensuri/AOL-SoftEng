<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

        return view("admin.admindashboard",["posts" => Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'title'=> 'required|max:255',
            'slug'=>'required|max:255|unique:posts',
            'image'=> 'required|image|file',
            'excerpt' => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = Auth::user()->id;

        Post::create($validatedData);
        return redirect('/admindashboard')->with('success', 'Berhasil membuat berita');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.edit', [
            'post'=> $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        Post::where('id', $id)->update(['published' => 1, 'date_published'=>  Carbon::now()->toDateTimeString()]);
        return redirect('/admindashboard')->with('success','Berhasil Publish Berita');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('/admindashboard')->with('success', 'Berhasil menghapus berita');
    }

    public function createSlug(Request $request){
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
