<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Nature;
use App\Role;
use Gate;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class NaturesController extends Controller
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
        //USERS GET
        $natures=Nature::all();
       // dd($natures);

        return view('natures.index')->with('natures',$natures);
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



        $data=$request->except('_token','_method');
        $nature= Nature::create($data);
        $nature->save();
        $natures=Nature::all();



      return redirect()->route('admin.natures.index') ;
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function show(Nature $nature)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nature  $nature
     * @return \Illuminate\Http\Response
     */







    public function edit(Nature $nature)
    {
        //dd($nature);

        $natures=Nature::all();


        return view('admin.natures.index')->with([
            'natures'=>$natures,
            'nature'=>$nature
            ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $data=$request->except('_token','_method');
        $f=Nature::find($id);
      //  dd($data['name']);
        $f->name= $data['name'];
        $f->save();
        $natures=Nature::all();

        return view('natures.index')->with('natures',$natures);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nature  $nature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nature $nature)
    {



        $nature->delete();

        return redirect()->route('admin.natures.index')->withError( 'un type de financement a été supprimé avec succes  :) ');

    }










}
