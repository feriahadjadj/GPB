@extends('layouts.poste')
 @section('content')
 <a href="{{ route('home') }}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card"  style="margin-top:32px">
                <div class="card-header">
                    <h4 class="float-left" style="margin-top:8px; color:#4D95FE;">
    Annuaire
</h4>

                </div>

                <div class="card-body ">

                    <table id="userTable" class="table table-striped    " style="width:100%">
                       <thead>
    <tr>
        <th scope="col" style="color:#FDC90A;font-weight:700;">Nom</th>
        <th scope="col" style="color:#FDC90A;font-weight:700;">Email</th>
        <th scope="col" style="color:#FDC90A;font-weight:700;">Tel</th>
    </tr>
</thead>

                        <tbody>
                            @foreach ($users as $u)

                            @if($u->roles()->get()->pluck('name')[0]=='user' && $u->email!='djemmal@namane.dz' )
                            <tr>
                                <td> {{$u->name}}</td>
                                <td>{{$u->email}} </td>
                                 <td>{{$u->tel}}</td>


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
