@extends('layouts.poste')
@section('content')
<a href="{{ route('home') }}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>
<div class="container">
    @if ($message = Session::get('error'))
    <div class="row justify-content-center">
        <div class="alert alert-danger alert-block col-md-8 ">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    </div>
    @elseif ($message = Session::get('success'))
    <div class="row justify-content-center">
        <div class="alert alert-success alert-block col-md-8  ">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Le changement à été fait avec succès </strong>
        </div>
    </div>


    @endif
    <div class="row justify-content-center">

        <div class="col-md-8" style="margin-top:30px;border-radius:15px 15px 15px 15px">
            <div class="card" style="border-radius:15px 15px 15px 15px">
                <div class="card-header" style="border-radius:15px 15px 0 0 ; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">Information du compte </div>

                <ul class="list-group" >
                    <li class="list-group-item" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23)color ;">
                      <label class="col-md-6 text-md-center title-yellow"><strong>Nom</strong></label>

                        <label class="col-md-4 text-md-left">{{$user->name}}</label>
                    </li>
                    <li class="list-group-item" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
                        <label class="col-md-6 text-md-center title-yellow"><strong>E-mail</strong></label>

                        <label class="col-md-4 text-md-left">{{$user->email}}</label>
                    </li>
                    <li class="list-group-item" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">

                        <label class="col-md-6 text-md-center title-yellow"><strong>Tel</strong></label>

                        <label class="col-md-4 text-md-left"id="changerMotP" style="color:#025da6 "><strong><a data-toggle="modal" data-target="#modifieTel">{{$user->tel ?? 'Ajouter votre numero'}}</a></strong></label>
                    </li>

                    <li class="list-group-item" style="border-radius: 0 0 15px 15px ;box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0,0,0,0.23); ">
                        <label class="col-md-6 text-md-center title-yellow"><strong>Mot de passe </strong></label>

                        <label class="col-md-4 text-md-left" id="changerMotP" style="color:#025da6 "><strong><a data-toggle="modal" data-target="#modifiePassMod">changer mot de passe</a></strong></label>

                    </li>

                </ul>

            </div>
        </div>

    </div>
</div>
</div>



<!--Ajouter Modal -->
<div id="modifieTel" class="modal " role="dialog">
    <div class="modal-dialog" id="addUser">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Changer Numero tel</h4>
            </div>
            <div class="modal-body">


                <div class="container">



                                <div class="card-body">
                                    <form method="POST" action="{{ route('changeTel') }}">
                                        @csrf





                                        <div class="form-group row">
                                        <label for="tel" class="col-md-4 col-form-label text-md-right" ><strong>Numero tel</strong></label>

                                            <div class="col-md-6">
                                                <input id="tel" type="tel" class="form-control" name="tel" value="{{$user->tel}}" required>
                                            </div>

                                        </div>



                                        <div class="form-group row">
                                            <div class="col-md-10">
                                                <button type="submit" class="btn btn-primary float-right" style="margin-top: 20px">
                                                   Valider
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                </div>

            </div>

        </div>
    </div>
</div>


<!--modifie Modal -->
<div id="modifiePassMod" class="modal " role="dialog">
    <div class="modal-dialog" id="addUser">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Changer le mot de passe</h4>
            </div>
            <div class="modal-body">


                <div class="container">



                                <div class="card-body">
                                    <form method="POST" action="{{ route('user.changePassword') }}">
                                        @csrf



                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right"><strong>Votre mot de passe</strong> </label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right"><strong>Nouveau mot de passe</strong></label>

                                            <div class="col-md-6">
                                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                            </div>

                                        </div>



                                        <div class="form-group row">
                                            <div class="col-md-10">
                                                <button type="submit" class="btn btn-primary float-right" style="margin-top: 20px">
                                                   Valider
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
