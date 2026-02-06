@extends('layouts.poste')

@section('content')
@if ($message = Session::get('success'))
<div class="row justify-content-center">
<div class="col-md-5">
<div class="row justify-content-center">
<div class="alert alert-success alert-block col-md-11  ">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
</div>
</div>
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Ajouter un utilisateur</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nom</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" minlength="8" maxlength="32" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmer le mot de passe</label>

                            <div class="col-md-6">
                                <input id="password-confirm"  minlength="8" maxlength="32" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label  class="col-md-4 col-form-label text-md-right">Roles</label>
                            <div class="col-md-6">

                               <div class="form-check ">

                                 <input type="checkbox" name="roles[]" value="superA"  >
                                 <label>superA</label>
                                </div>
                                 <div class="form-check ">
                                 <input type="checkbox" name="roles[]" value="Admin"  >
                                 <label>Admin</label>
                                </div>
                                 <div class="form-check ">
                                 <input type="checkbox" name="roles[]" value="User"  >
                                 <label>UPW</label>
                               </div>

                            </div>
                          </div>

                        <div class="form-group">
                            <div class="float-lg-right" style="margin-right:8rem">
                                <button type="submit" class="btn btn-primary">
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
@endsection
