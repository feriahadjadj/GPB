<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Finance;
use App\Role;
use Gate;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class FinancesController extends Controller
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
        //Finances GET
        $finances = Finance::orderBy('name', 'DESC')->get();


        return view('finances.index')->with('finances',$finances);
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
        $data['name'] = strtoupper( $data['name']);
        $finance= Finance::create($data);
        $finance->save();

      return redirect()->route('admin.finances.index') ;
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function show(Finance $finance)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */







    public function edit(Finance $finance)
    {
        //dd($finance);

        // $finances=Finance::all();


        // return view('admin.finances.index')->with([
        //     'finances'=>$finances,
        //     'finance'=>$finance
        //     ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $data=$request->except('_token','_method');
        $f=Finance::find($id);
      //  dd($data['name']);

        $f->name= strtoupper( $data['name']);
        $f->save();
        $finances = Finance::orderBy('name', 'DESC')->get();

        return view('finances.index')->with('finances',$finances);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finance $finance)
    {



        $finance->delete();

        return redirect()->route('admin.finances.index')->withError( 'un type de financement a été supprimé avec succes  :) ');

    }










}
