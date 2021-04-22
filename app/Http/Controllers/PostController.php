<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostResource::collection(Post::paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required',
        'body' => 'required',
        ]);
         
        return  new PostResource(Post::create([
            'title' => $request->title,
            'body'  => $request->body,
            'user_id' => auth()->user()->id
        ])); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, string $id)
    {
        return new PostResource($post::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $id
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, string $id)
    {
        $post = $post::findOrFail($id);
        $post->update($request->all());

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, string $id)
    {
        return $post::destroy($id);
    }
}
