<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->search, function ($query) use ($request) {
            $query->where('first_name', 'LIKE', '%' . $request->search . '%');
            $query->orWhere('last_name', 'LIKE', '%' . $request->search . '%');
            $query->orWhere('email', 'LIKE', '%' . $request->search . '%');
        })->where('user_type', 'User')->paginate(15);

        $searchParams =  $_GET ?? '';

        return view('admin.user.index', compact('users', 'searchParams'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('message', 'Delete Successfully');
    }
}
