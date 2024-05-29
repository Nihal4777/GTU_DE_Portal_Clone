<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user=auth()->user();
        return view('admin.profile',['user'=>$user]);
    }
    public function store(Request $request)
    {
        $user=User::find(auth()->user()->id);
        if(!empty($user))
        {
            $user->name=$request->name;
            $user->mobile=$request->mobile;
            $user->gender=$request->gender;
            $user->save();
            return view('admin.profile',['user'=>$user]);
        }
    }
}
