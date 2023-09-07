<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
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
    public function author(string $id)
    {
        //
        $author = User::find($id);
        $posts = $author->posts()->orderBy('created_at', 'desc')->simplePaginate(2);
        return view('blog.author', compact('author', 'posts'));
    }


    public function post(string $id)
    {
        $post = Post::find($id);
        return view('blog.post', compact('post'));
    }
    public function category(string $id)
    {
        //

        $category = Category::find($id);
        $posts = $category->posts()->orderBy('created_at', 'desc')->simplePaginate(5);
        return view('blog.category', compact('category', 'posts'));
    }



}
