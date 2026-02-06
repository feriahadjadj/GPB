@extends('layouts.poste')
@section('content')
<a href="{{route('projet.voirprojet',$id)}}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>
<div class="row justify-content-center text-center">

    <div class="col-sm-10 ">


  <!--                         ODS darret                       -->
        <h2 class="mb-4" >ODS d'arret et de reprise</h2>
        <br>
        @can('upw-role')


        <form action="{{ route('projet.storeRetard',$id) }}" method="post" class="form" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div id="form-arret_etude" class="form-inline justify-content-center text-center row" >

            <div class="form-group col-md-2">
                <label for="etude" class="mr-2">Etude</label>
                <input class="form-check-input mr-2" type="radio" name="type" id="etude" value="etude" checked>
            </div>
            <div class="form-group col-md-2">
                <label for="realisation" class="mr-2">Réalisation</label>
                <input class="form-check-input mr-2" type="radio" name="type" id="realisation" value="réalisation">
            </div>
            <div class="form-group">
                <label for="reason">Motif </label>
                <textarea class="form-control" name="reason" id="reason" rows="1" required></textarea>
                </div>

            <div class="form-group">
            <label for="start-date">Arret </label>
            <input type = "date" min="" value="" id = "start-date" name="date_arret"  class=" form-control" required>
            </div>
            <div class="form-group">
            <label > Reprise </label>
            <input type = "date" min="" value="" id = "end-date" name="date_reprise" class=" form-control" required>
            </div>
            <div  class="form-group" ><button type="submit"  class="btn btn-primary form-control" >Ajouter </button></div>
        </div>
        </form>
        @endcan



        <hr style=" display: block; border-top: 1px solid #ffce00 !important; width: 70%; " />
        <br>
        <div class="row" >
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Etude</h3>
                </div>
                <div class="px-2">
                    <table  class="table table-striped" style="background: white">
                        <thead>
                            <th scope="col">Date d'arret</th>
                            <th scope="col"style="white-space: nowrap">Date de reprise</th>
                            <th scope="col">Motif</th>
                            @can('upw-role')

                              <th scope="col">Action</th>@endcan
                        </thead>
                        <tbody id="table-e">
                            @foreach ($retards as $r)
                                @if($r->type=="etude")
                                <tr>
                                <td style="white-space: nowrap">{{Carbon\Carbon::parse($r->date_arret)->format('d-m-Y')}}</td>
                                <td style="white-space: nowrap">{{Carbon\Carbon::parse($r->date_reprise)->format('d-m-Y')}}</td>
                                <td>{{$r->reason}}</td>
                                @can('upw-role') <td style="display: flex">
                                    <a href="{{route('projet.destroyRetard',$r->id)}}">
                                        <button type="button" class="btn delete  mr-1">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </a>
                                    <button onclick="editretard('{{$r->id}}')" id="btn-{{$r->id}}" data-toggle="modal" data-target="#editModal" type="button" class="btn btn-primary">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                </td>
                                @endcan

                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



        </div>

        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="pull-left">Réalisation</h3>
            </div>
            <div class="px-2">
            <table  class="table table-striped " style="background: white">
                <thead>
                    <th scope="col">Date d'arret</th>
                    <th scope="col" style="white-space: nowrap">Date de reprise</th>
                    <th scope="col">Motif</th>
                    @can('upw-role')    <th scope="col">Action</th> @endcan
                </thead>
                <tbody id="table-r">
                    @foreach ($retards as $r)
                        @if($r->type=="réalisation")
                        <tr>

                            <td style="white-space: nowrap">{{Carbon\Carbon::parse($r->date_arret)->format('d-m-Y')}}</td>
                            <td style="white-space: nowrap">{{Carbon\Carbon::parse($r->date_reprise)->format('d-m-Y')}}</td>
                            <td>{{$r->reason}}</td>
                            @can('upw-role')     <td style="display: flex">
                            <a href="{{route('projet.destroyRetard',$r->id)}}">
                                <button type="button" onclick="return confirm('Etes vous sur de vouloir supprimer cette ODS d\'arret')" class="btn delete mr-1">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </a>
                        <button onclick="editretard({{$r->id}})" data-toggle="modal" data-target="#editModal" id="btn-{{$r->id}}" type="button" class="btn btn-primary ">
                                <i class="fa fa-pen"></i>
                            </button>
                        </td>
                        @endcan
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
  </div>

    <div id="editModal" class="modal" role="dialog">
        <div class="modal-sm modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong> Modifier ODS d'arret </strong></h4>
                </div>
                <div class="modal-body  row justify-content-center">
                    <form id="form-modal" action="" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="reason">Motif </label>
                            <textarea class="form-control" name="reason" id="reason-modal" rows="1" required></textarea>
                            </div>
                        <div class="form-group">
                            <label for="start-date">De</label>
                            <input type = "date" value="" id = "start-date-modal" name="date_arret"  class=" form-control"required>
                        </div>
                        <div class="form-group">
                            <label >A</label>
                            <input type = "date" value="" id = "end-date-modal" name="date_reprise" class=" form-control"required>
                        </div>
                        <div  class="form-group" >
                            <button type="submit"  class="btn btn-primary form-control" >
                                Valider
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

  <style>
      .mr-2{
          margin-right: 20px;
      }

      .mb-4{
          margin-right: 20px;
      }
  </style>

  <script>
      function editretard(id){

        url="{{route('projet.updateRetard','id')}}";
        r=url.replace("id", id);

        $("#form-modal").attr('action',r);

        a=$("#btn-"+id).parents().siblings('td').first().html();
        b=$("#btn-"+id).parents().siblings('td').first().next().html();
        c=$("#btn-"+id).parents().siblings('td').first().next().next().html();

        var dateParts = a.split("-");
        var dateParts2 = b.split("-");

// month is 0-based, that's why we need dataParts[1] - 1

        var dateArret = dateParts[2]+"-"+dateParts[1]+"-"+dateParts[0];
        var dateReprise = dateParts2[2]+"-"+dateParts2[1]+"-"+dateParts2[0];

        $('#start-date-modal').val(dateArret);
        $('#end-date-modal').val(dateReprise);
        $('#reason-modal').val(c);
      }
  </script>


  <script>
      window.onload= function(){
        a=$("input[type='radio']:checked").val();
        if(a=='etude'){
            if($('#table-e').children('tr').size()>0){
                split=$('#table-e').find('td').first().next().html().split('-');
                date=split[2]+"-"+split[1]+"-"+split[0];
                $('#start-date').attr('min',date);
            }else{
                $('#start-date').attr('min','');
            }

        }else{
            //alert($('#table-r').children('tr').size());
            if($('#table-r').children('tr').size()>0){
                split=$('#table-r').find('td').first().next().html().split('-');
                date=split[2]+"-"+split[1]+"-"+split[0];
                $('#start-date').attr('min',date);
            }else{
                $('#start-date').attr('min','');
            }
        }
      }

       $("input[type='radio']").change(function(){
        a=$("input[type='radio']:checked").val();
        if(a=='etude'){
            if($('#table-e').children('tr').size()>0){
                split=$('#table-e').find('td').first().next().html().split('-');
                date=split[2]+"-"+split[1]+"-"+split[0];
                $('#start-date').attr('min',date);
            }else{
                $('#start-date').attr('min','');
            }

        }else{

            if($('#table-r').children('tr').size()>0){
                split=$('#table-r').find('td').first().next().html().split('-');
                date=split[2]+"-"+split[1]+"-"+split[0];
                $('#start-date').attr('min',date);
            }else{
                $('#start-date').attr('min','');
            }
        }


       });

       $("#start-date").change(function(){
        a=$(this).val();

            $('#end-date').attr('min',a);



       });

  </script>

@endsection
