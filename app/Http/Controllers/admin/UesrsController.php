<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UesrsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
     public function index(Request $request)
     {
         $search = $request->input('search');
         if($search !='')
         {
               // get user with posts count
            $users = User::withCount('posts')->where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->orderBy('posts_count', 'desc')->paginate(5);
            $users->appends(['search' => $search]);
         }
        else
        {

            $users = User::withCount('posts')->orderBy('posts_count', 'desc')->paginate(5);


        }
         return view('admin.users.index', compact('users', 'search'));
     }
     public function search(Request $request)
     {
         $search = $request->input('search');
        if($search !='')
         {
            $users = User::when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                             ->orWhere('email', 'like', '%' . $search . '%');
            })->paginate(5);
            $users->appends(['search' => $search]);
         }
        else
        {
            $users = User::paginate(5);
        }
         return view('admin.users.index', compact('users', 'search'));
     }
    public function create()
    {
        //
        return view('admin.users.create');
    }
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,author,subscriber',
            'password' => 'required|confirmed|min:8',
        ]);
        $request_data = $request->except(['password', 'password_confirmation']);
        $request_data['password'] = bcrypt($request->password);
        User::create($request_data);
        session()->flash('success', 'User Added Successfully');
        return redirect()->route('users.index');
    }
    public function show(User $user)
    {
        //
        $posts = $user->posts()->paginate(5);
        return view('admin.users.show', compact('user', 'posts'));
    }
    public function edit(User $user)
    {
        //
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        if ($request->has('admin')) {
             $user->admin = 1;
        }
        else
        {
            $user->admin = 0;
        }
        $user->save();
        session()->flash('success', 'User Updated Successfully');
        return redirect()->route('admin.users.index');
    }
    public function destroy(User $user)
    {
        //
        $user->delete();
        session()->flash('success', 'User Deleted Successfully');
        return redirect()->route('users.index');
    }
}
