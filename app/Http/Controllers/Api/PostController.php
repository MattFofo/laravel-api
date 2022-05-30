<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Psy\Util\Json;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $attributes = $request->all();

        if (array_key_exists('home', $attributes)) {

            return response()->json([
                'success'   => true,
                'response'  => [
                    'data'  => Post::inRandomOrder()->limit(3)->get()
                ],
            ]);

        }

        $posts = Post::whereRaw('1 = 1');

        if (array_key_exists('tags', $attributes)) {

            $tags = $attributes['tags'];

            foreach ($tags as $tag) {
                $post = $post->whereHas('tags', function ($query) use ($tag) {
                    $query->where('name', $tag);
                });
            }
        }

        $posts = Post::paginate(20);

        return response()->json([
            'success'   => true,
            'response'  => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    public function show($slug)
    {

        $post = Post::with(['category', 'user', 'tags'])->where('slug', $slug)->first();

        if ($post) {
            if ($post->image) {
                $post->image = asset('storage/' . $post->image);
            }
            return response()->json([
                'success'   => true,
                'response'  => [
                    'data'  => $post
                ],
            ]);
        } else {
            return response()->json([
                'success'   => false
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
