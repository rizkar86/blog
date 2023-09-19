<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function index(Request $request)
    {
        $query = $request->q;
        if($query)
            $posts = Post::where('title', 'like', "%$query%")->orWhere('short_content', 'like', "%$query%")->simplePaginate(5);
        else
            $posts = Post::where('published', 1)->orderBy('created_at', 'desc')->simplePaginate(5);

        return view('blog.index', compact('posts'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('blog.posts.add', compact( 'categories'));
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
        // create slug form title
        $slug= Str::slug($request->title);
        // add slug to request
        $request->merge(['slug' => $slug]);
        $content = nl2br($request->input('content'));
        $request->merge(['content' => $content]);
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

        return redirect()->route('posts.show', $post->slug)->with('success', 'Post updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('blog.posts.show', compact('post'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        //
        $post = Post::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return view('blog.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts,title,' . $post->id,
            'content' => 'required',
            'categories' => 'required',
        ]);
        // create slug form title
        $slug= Str::slug($request->title);
        // add slug to request
        $request->merge(['slug' => $slug]);
        $content = nl2br($request->input('content'));
        $request->merge(['content' => $content]);
        $post->update($request->all());
        if($post)
        {
            foreach($request->categories as $category)
            {
                $post->categories()->attach($category);
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
        // redirect to post show
        return redirect()->route('posts.show', $post->slug)->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        //
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->delete();
        return redirect()->route('posts.myPosts')->with('success', 'Post deleted successfully');
    }

    public function myPosts()
    {
        $user = User::find(Auth::user()->id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->simplePaginate(5);
        return view('blog.posts.myPosts', compact('posts'));
    }
    function fetchData(Request $request)
    {
        if($request->ajax())
        {
            $posts = Post::orderBy('created_at', 'desc')->simplePaginate(5);
            return view('blog.data', compact('posts'))->render();
        }
    }
    function fetchCategoriesData(Request $request)
    {
        if($request->ajax())
        {
            $category = Category::find($request->id);
            $posts = $category->posts()->orderBy('created_at', 'desc')->simplePaginate(5);
            return view('blog.data', compact( 'posts'))->render();;
        }
    }
    function fetchAuthorsData(Request $request)
    {
        if($request->ajax())
        {
            $author = User::find($request->id);
            $posts = $author->posts()->orderBy('created_at', 'desc')->simplePaginate(2);
            return view('blog.data', compact('author', 'posts'))->render();
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Add your search logic here.
        // You can use the $query to search for posts in your database.

        $posts = Post::where('title', 'like', "%$query%")
                     ->orWhere('short_content', 'like', "%$query%")
                     ->simplePaginate(5);

        return view('blog.index', compact('posts', 'query'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function author($slug)
    {
        //
        $author = User::where('slug', $slug)->firstOrFail();
        $posts = $author->posts()->orderBy('created_at', 'desc')->simplePaginate(2);
        return view('blog.author', compact('author', 'posts'));
    }
    public function category($slug)
    {
        //
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->orderBy('created_at', 'desc')->simplePaginate(5);

        return view('blog.category', compact('category', 'posts'));
    }
}
