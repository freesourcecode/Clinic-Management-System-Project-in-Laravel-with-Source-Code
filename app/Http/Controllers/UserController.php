<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        $roles = Role::get();
        //return $users;
        return view('users.index', compact('users', 'roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
       $this->validate($request, ['name' => 'required|string|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $request['password'] = bcrypt($request->password);
        // /return $request->all();
        User::create($request->all());
        return back()->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //return $request->all();
        $user = User::find($request->id);
        //return $user;
        $this->validate($request, ['name' => 'required|string|unique:users,name,'.$user->id,
	         'email' => 'required|string|email|max:255|unique:users,email,'.$user->id]);
        //return $request->all();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        if($request->password)
        {
            $this->validate($request , ['password' => 'required|string|min:6|confirmed']);
       		$data['password'] = bcrypt($request->password);
        }
        if($request->role_id)
        {
       		$data['role_id'] = $request->role_id;
        }
        //return $data;
        $user->update($data);
        return back()->with('success', 'User edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
      	// return $request->all();
       $user = User::find($request->id);
       if (count($user->invoices) || count($user->role) ) {
        return back()->with('error', 'User cannot deletd..');
        }
       $user->delete();
       return back()->with('success', 'User deleted successfully.');
    }

    public function changePassword(Request $request)

    {
    
       // return $request->all();
        $user = Auth::user();
       
        $this->validate($request, ['password'=> 'required|string|min:6|confirmed']);
        $data['password'] = bcrypt($request->password);
        $user->update($data);
        Auth::guard()->logout();
        return back()->with('success', 'Password Changed successfully..');
    }
}
