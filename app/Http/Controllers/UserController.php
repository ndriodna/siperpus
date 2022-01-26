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
        $users = User::SearchBy(request()->by ?? 'name')->paginate(20);
        return view('dashboard.user.index',compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
        $password = !empty($request->password) ? bcrypt($request->password) : $user->password;
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);
        return back()->with('toast_success','Berhasil update User');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('toast_success','Berhasil Menghapus User');
    }
}
