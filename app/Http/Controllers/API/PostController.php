<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // all posts
    public function index()
    {
        $posts = Post::all()->toArray();
        return array_reverse($posts);
    }

    // add post
    public function add(Request $request)
    {
        $post = new Post([
            'title' => $request->title,
            'content' => $request->content
        ]);
        $post->save();

        return response()->json('The post successfully added');
    }

    // edit post
    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    // update post
    public function update($id, Request $request)
    {
        $post = Post::find($id);
        $post->update($request->all());

        return response()->json('The post successfully updated');
    }

    // delete post
    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json('The post successfully deleted');
    }
}
