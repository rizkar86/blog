<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('users', 'categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //
        $this->validate($request, [
            'title' => 'required|unique:posts',
            'content' => 'required',

        ]);

        $post = Post::create($request->all());
        if($post)
        {
            foreach($request->categories as $category)
            {
                $post->categories()->attach($category);
            }
            foreach($request->users as $user)
            {
                $post->users()->attach($user);
            }
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

        return redirect()->route('posts.index')->with('success', 'Post created successfully');

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return view('admin.posts.show', compact('post'));

    }
    public function edit(string $id)
    {
        $post = Post::find($id);
        $users = User::all();
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'users', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'users' => 'required',
            'title' => 'required|unique:posts,title,' . $id,
            'content' => 'required',

        ]);

        $post = Post::find($id);
        $post->update($request->all());
        if($post)
        {
            $post->categories()->detach();
            foreach($request->categories as $category)
            {
                $post->categories()->attach($category);
            }
            $post->users()->detach();
            foreach($request->users as $user)
            {
                $post->users()->attach($user);
            }
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

      // redirect to posts.edit
        return redirect()->route('posts.edit', $post->id)->with('success', 'Post updated successfully');


    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::find($id);
        $post->delete();
        $post->categories()->detach();
        $post->users()->detach();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');

    }
    public function deletePost(string $id)
    {
        //
        $post = Post::find($id);
        $post->delete();
    // return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        return response()->json(['success' => 'Post deleted successfully']);

    }


    public function filterByCategory($id)
    {
        $categories = Category::all();
        // get posts and theirs cateories  by category id
        if($id == 0)
        {
            $posts = Post::with('categories')->get();
        }
        else
        {
            $posts = Post::whereHas('categories', function ($query) use ($id) {
                $query->where('category_id', $id);
            })->with('users')->with('categories')->get();
        }

      // Return the filtered posts as JSON
        return response()->json($posts);
    }
    public function filterByAuthor($id)
    {
        $authors = User::all();
        // get posts and theirs cateories  by category id
        if($id == 0)
        {
            $posts = Post::with('users')->get();
        }
        else
        {
            $posts = Post::whereHas('users', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->with('users')->with('categories')->get();
        }

      // Return the filtered posts as JSON
        return response()->json($posts);

    }

}
