<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $validationRules = [
        'title'         => 'required|max:100',
        'slug'          => 'required|unique:posts|max:100',
        'content'       => 'required',
        'category_id'   => 'required|exists:Category,id',
        'tag'           => 'exists:Tag,id',
        'image'         => 'nullable|image'
    ];

    private function getValidators($model) {
        return [
            'title'         => 'required|max:100',
            'slug'          => [
                'required',
                Rule::unique('posts')->ignore($model),
                'max:100'
            ],
            'category_id'   => 'required|exists:App\Category,id',
            'content'       => 'required',
            'tags'          => 'exists:App\Tag,id',
            'image'         => 'nullable|image'
        ];
    }

    public function myindex() {
        $posts = Post::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }



    public function index()
    {
        $posts = Post::paginate(15);

        return view('admin.posts.index', compact('posts'));
    }



    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', [
            'categories'    => $categories,
            'tags'          => $tags
        ]);
    }



    public function store(Request $request)
    {

        $request->validate($this->getValidators(null));  //TODO: blocca l'esecuzione se la slug non è unica prima che il metodo validateSlug() possa cambiarla

        $formData = $request->all();


        $img_path = null;

        if (array_key_exists('image', $formData)) {
            $img_path = Storage::put('uploads', $formData['image']);
        } else {
            $img_path = null;
        }

        $postData = [
            'user_id' => Auth::id(),
            'image'   => $img_path
        ] + $formData;

        $postData['slug'] = Post::validateSlug($postData['slug']);

        $post = Post::create($postData);
        $post->tags()->attach($postData['tags']);

        return redirect()->route('admin.posts.show', $post);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', [
            'post'              => $post,
            'categories'        => $categories,
            'tags'              => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $request->validate($this->getValidators($post));

        $postData = $request->all();

        $postData['slug'] = Post::validateSlug($postData['slug']);

        $post->update($postData);

        return redirect()->route('admin.posts.show', $post)->with('status', "Post: $post->id edited succesfully");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->tags()->detach();
        $post->delete();

        return redirect(route('admin.home'))->with('status', "Post: $post->title deleted");
    }

}
