<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create_post(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        // Sanitize input to prevent XSS attacks 
        $validatedData["title"] = strip_tags($validatedData["title"]);
        $validatedData["body"] = strip_tags($validatedData["body"]);
        $validatedData["user_id"] = auth()->id();
        // Create a new post associated with the authenticated user
        Post::create($validatedData);

        // Redirect to a specific page after creating the post
        return redirect('/');
    }

    public function delete_post($id)
    {
        // Find the post by ID and ensure it belongs to the authenticated user
        $post = Post::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete the post
        $post->delete();

        // Redirect to a specific page after deleting the post
        return redirect('/');
    }
}
