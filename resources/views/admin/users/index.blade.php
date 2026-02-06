@extends('layouts.poste')
 @section('content')
<a href="{{ route('home') }}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <br> @if ($message = Session::get('success'))
            <div class="row justify-content-center">
                <div class="alert alert-success alert-block col-md-12  ">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="row justify-content-center">
                <div class="alert alert-danger alert-block col-md-12  ">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            </div>
            @endif

            <br>
            <div class="card" style="margin-bottom: 50px">
                <div class="card-header">
                    <h4 class="float-left" style="margin-top:8px"> Utilisateurs</h4> @can('edit-users')
                    <a class="float-right">
                        <button data-toggle="modal" data-target="#ajouterModal" class="btn edit">Ajouter un utilisateur</button>
                    </a>
                    @endcan
                </div>

                <div class="card-body ">

                    <table id="userTable" class="table table-striped table-borderless   " style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col" style="text-align: center">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                            @if ($u->email!='djemmal@namane.dz' && $u->roles()->first()->name!='admin')


                            <tr>
                                <td> {{$u->name}}</td>
                                <td>{{$u->email}} </td>

                                <td>@if($u->roles()->first()->name=='user') Upw @elseif($u->roles()->first()->name=='superA') Administrateur @else DIPB  @endif</td>
                                <td class="row justify-content-center">
                                    <div>

                                        <!--     only supeer admin    can edit               -->

                                        @can('edit-users')
                                        <a><button type="button" data-toggle="modal" data-target="#{{$u->id}}" class="btn edit">Modifier</button></a>

                                        <!--Modifier Modal -->
                                        <div id="{{$u->id}}" class="modal " role="dialog" >
                                            <div class="modal-dialog" id="addUser">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Modifier Utilisateur</h4>
                                                    </div>
                                                    <div class="modal-body"  >

                                                        <form action="{{route('admin.users.update',$u)}}" method="POST" style="padding: 20px;">
                                                            @csrf {{method_field('PUT')}}
                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">Nom d'utilisateur</label>

                                                                <div class="col-md-6">
                                                                    <input id="{{ $u->name ?? ''}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $u->name ?? ''}}" required autofocus> @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                                                                <div class="col-md-6">
                                                                    <input id="{{ $u->email  ?? ''}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $u->email  ?? ''}}" required autocomplete="email"> @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>

                                                                <div class="col-md-6">
                                                                    <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" autocomplete=""> @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row ">
                                                                <label for="roles" class="col-md-4 col-form-label text-md-right">Roles</label>
                                                                <div class="col-md-6">
                                                                    @foreach ($roles as $role)
                                                                    @if($role->name != 'admin')

                                                                    <div class="form-check row ">

                                                                        <input type="radio" class="col-md-2" name="roles[]" value="{{$role->id}}" @if ($u->roles->pluck('id')->contains($role->id)) checked @endif>
                                                                        <label class="col-md-4">@if($role->name=='user') Upw @elseif($role->name=='superA') Administrateur @else {{$role->name}}  @endif </label>
                                                                    </div>
                                                                    @endif
                                                                    @endforeach
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

                                        <form action="{{route('admin.users.destroy',$u )}}" method="POST" class="float-left">
                                            @csrf {{method_field('DELETE')}}
                                            <button onclick="return confirm('Etes vous sur de vouloir supprimer l\'utilisateur {{$u->name}}?')" type="submit" class="btn delete " style="margin-right: 4px">Supprimer</button>
                                        </form>
                                        @endcan
                                    </div>

                                </td>

                            </tr>
                            @endif

                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<!--Ajouter Modal -->
<div id="ajouterModal" class="modal " role="dialog">
    <div class="modal-dialog" id="addUser">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ajouter Utilisateur</h4>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Nom</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus> @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"> @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>
                                                            <?php

                                                                echo '<script>jQuery(function(){$(\'#ajouterModal\').modal({show: \'false\'});});</script>';

                                                            ?>
                                                            {{ $message }}</strong>
                                                        </span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"  class="col-md-4 col-form-label text-md-right">Mot de passe</label>

                                    <div class="col-md-6">
                                        <input id="password" minlength="8" maxlength="32" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmer le mot de passe</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" minlength="8" maxlength="32" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="col-md-4 col-form-label text-md-right">Roles</label>
                                    <div class="col-md-6">

                                        <div class="form-check ">

                                            <input type="radio" name="roles[]" value="superA">
                                            <label>Administrateur</label>
                                        </div>

                                        <div class="form-check ">
                                            <input type="radio" name="roles[]" value="User">
                                            <label>Upw</label>
                                        </div>

                                        <div class="form-check ">
                                            <input type="radio" name="roles[]" value="Dipb">
                                            <label>Dipb</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="float-lg-right">
                                    <button type="submit" class="btn btn-primary">
                                        Valider
                                    </button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- secript data-table -->
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({

            "language": {
                "url": "{{asset('dist/dataTables.fr.json')}}"
            }

        });
    });

</script>

@endsection
