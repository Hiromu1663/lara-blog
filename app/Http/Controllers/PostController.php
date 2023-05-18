<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    function index()
    {
        $posts = Post::all();
        // dd($posts);
        return view("posts.index", compact("posts"));
    }

    function create()
    {
        return view("posts.create");
    }

    function store(Request $request)
    {
        // dd($request);
        $post = new Post;
        $post -> title = $request -> title;
        $post -> body = $request -> body;
        $post -> user_id = Auth::id();
        $post -> save();
        return redirect()->route("posts.index");
    }

    function show($id)
    {
        // dd($id);
        $post = Post::find($id);

        return view("posts.show", compact("post"));
    }

    function edit($id)
    {
        $post = Post::find($id);
        return view("posts.edit", compact("post"));
    }

    function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post -> title = $request -> title;
        $post -> body = $request -> body;
        $post -> save();
        return view("posts.show", compact("post"));
    }

    function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route("posts.index");
    }

}
