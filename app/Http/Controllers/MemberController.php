<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::SearchBy(request()->by ?? 'nama')->paginate(20);;
        $users = User::get();
        return view('dashboard.member.index',compact('members','users'));
    }
}
