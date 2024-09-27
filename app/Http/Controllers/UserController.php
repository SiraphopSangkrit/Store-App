<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserIndex()
    {
        $users = User::with('roles')->get();
        return Inertia::render(
            'Users/Users',[
                'users' => $users
            ]
            );
    }

    public function UserStore(Request $request)
    {
        $users = new User;
        $users->username= $request->input('username');
        $users->firstname= $request->input('firstname');
        $users->middlename= $request->input('middlename');
        $users->lastname= $request->input('lastname');
        $users->email= $request->input('email');
        $users->tel= $request->input('tel');
        $users->password= Hash::make($request->input('tel'));
        $users->assignRole('admin');
        $users->save();
        return back();
    }
}
