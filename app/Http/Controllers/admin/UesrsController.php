<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UesrsController extends Controller
{


     public function index(Request $request)
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
     public function search(Request $request)
     {
         $search = $request->input('search');

            $users = User::when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                             ->orWhere('email', 'like', '%' . $search . '%');
            })->paginate(2);
            $users->appends(['search' => $search]);




         return view('admin.users.index', compact('users', 'search'));
     }
}
