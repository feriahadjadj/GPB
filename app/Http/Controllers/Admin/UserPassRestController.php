<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserPassRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // auth


     public function __construct(){
         $this->middleware('auth');
     }


    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */







    public function edit(User $user)
    {
        //dd($user);


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user =Auth::user();

        if(Hash::check($request->current_password, auth()->user()->password)){
            $user->password = Hash::make($request->new_password);
        }
        else{
            return back()->withError('Le mot de passe est incorrect ,essaye encore une fois :)');
        }

        $user->save();
      //  return  view('admin/users/profil')->with('user',$user);

      return back()->withSuccess('Le chengement a été fait avec succès :)');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {


    }


    public function profil(User $user){
        //dd($user);
        return view('admin.users.profil')->with('user',$user);
    }





}
