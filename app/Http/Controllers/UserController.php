<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::when(request()->q, function($users){
            $users = $users->where('name','like', '%'. request()->q .'%');
        })->paginate(20);
        return view('dashboard.user.index',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return back();
    }
}
