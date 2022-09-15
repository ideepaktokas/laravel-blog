<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home.index', []);
// })->name('home.index');

// Route::get('/contact', function(){
//     return view('home.contact');
// })->name('home.contact');

// Route::view('/', 'home.index')->name('home.index');
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/single', AboutController::class);
Route::resource('/posts', PostsController::class);
// Route::resource('/posts', PostsController::class)->only(['index', 'show']);
// Route::resource('/posts', PostsController::class)->except(['index', 'show']);

$posts = [
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

/* Route::get('/posts', function(Request $request) use($posts){
    // It will give access to query parameters and not route params
    // dd(request()->all());

    //We can access individual item using input function along with default input value
    // all and input have access to all possible inputs
    
    // dd((int)request()->input('page', 1));

    // we can use query function to fetch from query params
    // dd((int)request()->query('page', 1));
    // $request->all();

    $request->only(['username', 'password']);
    $request->except(['credit_card']);
    $request->has('name');
    $request->hasAny(['name', 'email']);
    $request->filled('name');
    $request->whenFilled('name', function($input) {});
    $request->whenHas('name', function($input) {});

    return view('posts.index', ['posts' => $posts]);
});
 */
// Route::get('/post/{id}', function($id) use($posts){ 

//     abort_if(!isset($posts[$id]), 404);
//     return view('posts.show', ['post' => $posts[$id]]);
// })->where([
//     'id' => '[0-9]+'
// ])->name('posts.show');

Route::get('/fun/responses', function() use($posts) {
    return response($posts, 201)
        ->header('Content-Type', 'application/json')
        ->cookie('MY_COOKIE', 'David', 3600);
});

Route::get('/fun/redirect', function() {
    return redirect('/contact');
});

Route::get('/fun/back', function() {
    // Will redirect to last address and useful for one time action
    return back(); 
});

Route::get('/fun/named-route', function() {
    // Will redirect to last address and useful for one time action
    return redirect()->route('posts.show', ['id' => 1]); 
});

Route::get('/fun/away', function() {
    // Will redirect to last address and useful for one time action
    return redirect()->away('https://google.com'); 
});

Route::prefix('/fun')->name('fun.')->group(function () use($posts) {
    Route::get('/json', function() use($posts) {
        // Will redirect to last address and useful for one time action
        return response()->json($posts); 
    })->name('json');
    
    Route::get('/download', function() use($posts) {
        // Will redirect to last address and useful for one time action
        return response()->download(public_path('abc.jpg', 'face.jpg', [])); 
    })->name('download');
});