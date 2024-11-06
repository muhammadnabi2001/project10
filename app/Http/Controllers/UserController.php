<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $users=User::orderBy('id','desc')->get();
        return view('users',['users'=>$users]);
    }
    public function create(Request $request)
    {
        //dd(123);
        $data = $request->validate([
            'name' => 'required|max:25',
            'email' => 'required|max:50|min:5|email|unique:users,email',
            'password' => 'required',
            'role' => 'required'
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return redirect()->back()->with('success', 'Ro\'yxatdan o\'tish muvaffaqiyatli yakunlandi!');

    }
    public function update(Request $request, int $id)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|max:25',
            'email' => 'required|max:50|min:5|email|unique:users,email,' . $id,
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);

        //dd($user);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = $request->password;

        $user->save();

         return redirect('/users')->with('success', "Ma'lumot muvvafaqiyatli yangilandi");
    }
    public function delete(int $id)
    {
        //dd($id);
        $user=User::findOrFail($id);
        $user->delete();
        return redirect('/users')->with('success', "Ma'lumot muvvafaqiyatli o'chirildi");
    }
}
