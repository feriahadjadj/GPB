@extends('layouts.poste')
@section('content')
<a href="{{ route('home') }}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>
<div class="container">


    <div class="row justify-content-center">


        <div  class="col-md-5" style=" margin-top: 50px;margin-bottom: 30px;margin-right: auto;margin-left: auto" >

            <form action="{{route('admin.natures.store')}}" method="POST" >
                {{csrf_field()}}
                <div class="row">
                        @include('natures.natureForm')
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary ">Ajouter</button>
                        </div>
              </div>
            </form>

        </div>
        <div class="col-md-12">
            <div class="card">




                <div class="card-header">
                    <h4 class="float-left" style="margin-top:8px;margin-left: 40px">Les natures des projets</h4> @can('edit-users')

                    @endcan
                </div>

                <div >

                    <table id="userTable" class="table table-borderless" style="width:100%">
                        <thead >
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Nom</th>

                                <th scope="col" style="text-align: center">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($natures as $u)



                            <tr>
                                <td></td>

                                <td> {{$u->name}}</td>


                                <td class="row justify-content-center">
                                    <div>

                                        <!--     only supeer admin    can edit               -->

                                        @can('edit-users')
                                        <a><button type="button" data-toggle="modal" data-target="#{{$u->id}}" class="btn btn-primary"><i class="fa fa-edit"></i></button></a>

                                        <!--Modifier Modal -->
                                        <div id="{{$u->id}}" class="modal " role="dialog" >
                                            <div class="modal-dialog" id="addUser">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Modifier </h4>
                                                    </div>
                                                    <div class="modal-body"  >

                                                        <form action="{{route('admin.natures.update',$u->id)}}" method="POST" style="padding: 20px;">
                                                            @csrf {{method_field('PUT')}}
                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">Nom </label>

                                                                <div class="col-md-6">
                                                                    <input id="{{ $u->name ?? ''}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $u->name ?? ''}}" required autofocus> @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                           </span> @enderror
                                                                </div>
                                                            </div>



                                                            <button type="submit" class="btn btn-primary float-right">valider</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @endcan
                                        <!--    only supeer admin     cannnnnnnnn delete               -->

                                        @can('delete-users')

                                        <form action="{{route('admin.natures.destroy',$u )}}" method="POST" class="float-left">
                                            @csrf {{method_field('DELETE')}}
                                            <button onclick="return confirm('Etes vous sur de vouloir supprimer la nature {{$u->name}} ?')" type="submit" class="btn delete " style="margin-right: 4px"><i class="fas fa-trash"></i></button>
                                        </form>
                                        @endcan
                                    </div>

                                </td>

                            </tr>


                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>



@endsection
