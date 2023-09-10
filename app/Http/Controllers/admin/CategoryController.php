<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if($search !='')
        {
           $categories = Category::when($search, function ($query, $search) {
               return $query->where('name', 'like', '%' . $search . '%');
           })->paginate(5);
           $categories->appends(['search' => $search]);
        }
       else
       {
           $categories = Category::paginate(5);
       }
        return view('admin.categories.index', compact('categories', 'search'));
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        if($search !='')
        {
           $categories = Category::when($search, function ($query, $search) {
               return $query->where('name', 'like', '%' . $search . '%');
           })->paginate(5);
           $categories->appends(['search' => $search]);
        }
       else
       {
           $categories = Category::paginate(5);
       }

        return view('admin.categories.index', compact('categories', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:categories'
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
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
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:categories,name'
        ]);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
