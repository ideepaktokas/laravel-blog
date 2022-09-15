<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // protected $fillable = ['title', 'content'];
    protected $guarded = [];

    // composer require laravel/ui
    // php artisan ui bootstrap
    // php artisan ui:controllers
    // npm install
    // npm run dev
    // npm install resolve-url-loader@^5.0.0 --save-dev --legacy-peer-deps
    // npm run dev

    private $posts = [
        1 => [
            'title' => 'Intro to Laravel',
            'content' => 'This is short intro to laravel',
            'is_new' => true
        ],
        2 => [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to PHP',
            'is_new' => false
        ],
        3 => [
            'title' => 'Intro to GOLang',
            'content' => 'This is a short intro to GOLang',
            'is_new' => false
        ]
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', ['posts' => BlogPost::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(StorePost $request)
    {
        // dd($request);
        /* $request->validate([
            'title' => 'bail|required|min:5|max:100',
            'content' => 'required|min:10'
        ]); */
        $validated = $request->validated();
        
        $post = new BlogPost();
        // $post->title = $request->input('title');
        // $post->content = $request->input('content');
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        // $post = BlogPost::create($validated);
        //$post->fill(['key' => value]); //Here key is column name and val to be assigned
        $post->save();

        // $post2 = BlogPost::make(); 
        // $post2->save();

        $request->session()->flash('status', 'The blog post was created!');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort_if(!isset($this->posts[$id]), 404);
        return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // abort_if(!isset($this->posts[$id]), 404);
        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $validated = $request->validated();
        // dd($post->getAttributes());        
        // $post->fill($validated);
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();

        $request->session()->flash('status', 'Blog post was updated!');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $post = BlogPost::findOrFail($id);
        $post->delete();

        session()->flash('status', 'Blog post with id : '.$id.' was deleted!');

        return redirect()->route('posts.index');
    }
}
