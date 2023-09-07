<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('blog.addPost', compact( 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts',
            'content' => 'required',
            'categories' => 'required',
        ]);

        $post = Post::create($request->all());
        if($post)
        {
            foreach($request->categories as $category)
            {
                $post->categories()->attach($category);
            }
            $user = User::find(Auth::user()->id);

            $post->users()->attach($user);

        }
        if($request->hasFile('image'))
        {

            $image = $request->file('image');
            $name = $post->id . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('\img');

            $image->move($destinationPath, $name);

            $post->image = $name;
            $post->save();
        }

        return redirect()->route('blog.storePost')->with('success', 'Post created successfully');
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
    public function edit(string $id)
    {
        //
        $post = Post::find($id);
        $categories = Category::all();
        return view('blog.editPost', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'categories' => 'required',
        ]);

        $post = Post::find($id);
        $post->update($request->all());
        if($post)
        {
            foreach($request->categories as $category)
            {
                $post->categories()->attach($category);
            }
            $user = User::find(Auth::user()->id);

            $post->users()->attach($user);

        }
        if($request->hasFile('image'))
        {

            $image = $request->file('image');
            $name = $post->id . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('\img');

            $image->move($destinationPath, $name);

            $post->image = $name;
            $post->save();
        }

        return redirect()->route('blog.storePost')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('blog.storePost')->with('success', 'Post deleted successfully');

    }

    public function myPosts()
    {
        //

        $user = User::find(Auth::user()->id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->simplePaginate(5);
        return view('blog.myPosts', compact('posts'));



    }
}
