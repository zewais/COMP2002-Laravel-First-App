<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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
//We can install php namespaces resolver extension to import classes easily
//right click on the class name and select import class

Route::get('/', function () {
    // Fetch posts for the authenticated user, if any
    $posts = auth()->check() ? Post::where('user_id', auth()->id())->latest()->get() : [];
    return view('home', ["posts" => $posts]);
});

//User authentication routes
Route::post("/register", [UserController::class, "register"]);
Route::post("/logout", [UserController::class, "logout"]);
Route::post("/login", [UserController::class, "login"]);

//Blog post creation route
Route::post('/create-post', [PostController::class, 'create_post']);

// Blog post deletion route
Route::delete('/delete-post/{id}', [PostController::class, 'delete_post']);


?>