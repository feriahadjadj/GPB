<?php

namespace App\Http\Controllers;
use App\Projet;
use App\Image;
use App\User;
use Storage;
use Illuminate\Http\Request;
use File;
use Auth;
use App\Notifications\userNotification;



class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//dd(request()->has('id'));
$id=request()->input('id');
$user = Projet::find($id)->user;
//dd($user);
if ($user != Auth::user() && Auth::user()->roles->contains('name', 'user')) {
    return view('admin/users/error');

}else{
    $projet=Projet::find($id);
    $images=$projet->images()->get();
    return view('projet.images')->with(['id'=>$id,'images'=>$images]);
}


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
     //   dd($request->has('id'));
        $a = Image::saveImages($request->input('id'),Collect($request->file('image')),$request->input('observation'));
        $p=Projet::find($request->input('id'));
        $user=$p->user;

        $text = 'L\'UPW '.$user->name.' a ajouté des photos au projet '. $p->designation.'. ';
        $users=User::all();
        foreach ($users as $u) {

            if ($u->roles->contains('name', 'superA') && $u->email != 'djemmal@namane.dz') { // compte super admin masequer

                $u->notify(new userNotification($user, $p, 'Ajout de photos', $text));

            }
        }

        return redirect()->back()->with('success','Les photos ont été ajoutées avec succès :)');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        dd('show');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd('update');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $img=Image::find($id);

        File::delete('storage/'.$img->src);
        $img->delete();

        return redirect()->back()->with('error','La photo a été suprimée avec succès :)');
    }

}
