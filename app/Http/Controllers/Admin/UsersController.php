<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $roles = Role::all();
        $users = User::all();
        return view('admin.users.index')->with('users', $users)->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        if ($user == Auth::user()) {
            return view('admin/users/profil')->with('user', $user);
        } else {
            return view('admin/users/error');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function edit(User $user)
    {


        $roles = Role::all();
        $users = User::all();

        return view('admin.users.index')->with([
            'user' => $user,
            'users' => $users,
            'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != "") {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        /*  if(Gate::denies('delete-users')){

        return redirect(route('admin.users.index')) ;

        }*/
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')->withError('un utilisateur a été supprimé avec succes  :) ');

    }

    public function annuaire()
    {

        $roles = Role::all();
        $users = User::all();
        return view('admin.users.annuaire')->with('users', $users)->with('roles', $roles);
    }

    public function changeTel(Request $request)
    {
        $user = Auth::user();
        $user->tel = $request->tel;
        $user->save();
        return back()->withSuccess('Votre numero de téléphone a été changé avec succès :)');

    }

}
