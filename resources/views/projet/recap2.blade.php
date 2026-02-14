@extends('layouts.poste') @section('content')
<a href="{{ url()->previous() }}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>
@can('manage-users')

<button  class="btn delete btn-print " onclick="printDiv('Recap2')" id="btnPrintA"><i class="fas fa-print"></i></button>

@endcan

<style>
    .recap-title{
        text-align: center;
        margin: 15px 0 25px;
        font-weight: 800;
    }
</style>

<div class="container-fluid">
    @can('manage-users') @endcan
    <div class="justify-content-center row">

        <!-- section 3----------------------------------------------->

        <section id="Recap2">
            <div class="img-logo" style ='width:100%;margin-bottom:60px' hidden>
                <img src='{{asset('img/logo-head.png')}}' alt='img-logo' width='20%'>
                <div class="float-right" style="margin-right: 20px ;margin-top: 10px">
                <h5>{{Carbon\Carbon::now()}}</h5>
                </div>

            </div>

            <h3 class="recap-title">Récap général des projets par WILAYA et par PHASE D'AVANCEMENT </h3>
            <h3 class="img-logo recap-title"  hidden>de l'année {{$year}}</h3>


            <div class="form-inline d-flex"  >


                <div class="form-group hide" style="margin-left:10px">
                    <label  for="year" > <strong>Année</strong>  </label>
                    <select  form-control" name="year" id="year" class="wilaya select-filtre form-control ">

                        @for ($i =(int)(Carbon\Carbon::today()->year) ; $i> (int)(Carbon\Carbon::today()->year)-5;$i--)
                        <option value="{{$i}}" >{{$i}}</option>

                        @endfor
                    </select>
                 </div>
                <div class="form-group hide" style="margin-left: auto;margin-right: 0;">

                <select name="select-recap" id="select-recap"  class=" form-control" >
                    <option value="DUPW">DUPW</option>
                    <option value="1">Récap 1</option>
                    <option value="2">Récap 2</option>
                    <option value="3">Récap 3</option>
                    <option value="4">Récap 4</option>
                </select>
                </div>



            </div>
            <div class="row ">
                <div class="justify-content-center col-lg-12 col-md-12">
                    <div class="well table-responsive" id="content" style="padding: 5px;">

                        <table id="resultA" class="table resultA table-bordered table-condensed w-100">
                            <thead class="thead-dark">

                                <tr>
                                    <th rowspan=2>Wilaya </th>
                                    <th colspan=5>Phase Projet</th>
                                    <th rowspan=2>Total Projets</th>

                                    <th rowspan=2>Projets non lancés (E+P+NL)</th>

                                    <th rowspan=2>Taux Projets Non lancés</th>

                                </tr>

                                <tr>
                                    <th>E : Etudes</th>
                                    <th>P : Procédures</th>
                                    <th>R : Réalisation</th>
                                    <th>NL : Non Lancés</th>
                                    <th>A : Achevés</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)

                                <tr>
                                    <td><strong>{{$user['name']}}</strong></td>
                                    <td>{{$user['E']}}</td>
                                    <td>{{$user['P']}}</td>
                                    <td>{{$user['R']}}</td>
                                    <td>{{$user['NL']}}</td>
                                    <td>{{$user['A']}}</td>
                                    <td>{{$user['totalP']}}</td>
                                    <td>{{$user['projetNL']}}</td>
                                    <td>{{$user['tauxProjetNL']}}</td>


                                </tr>
                                @endforeach
                                <tr class="projetTot">
                                    <td><strong>Total 50 UPW</strong></td>
                                    <td>{{$total['E']}}</td>
                                    <td>{{$total['P']}}</td>
                                    <td>{{$total['R']}}</td>
                                    <td>{{$total['NL']}}</td>
                                    <td>{{$total['A']}}</td>
                                    <td>{{$total['totalP']}}</td>
                                    <td>{{$total['projetNL']}}</td>
                                    <td>{{$total['tauxProjetNL']}}</td>

                                </tr>

                                <tr class="projetTot" style="border-bottom:0px !important">
                                    <td style="background:#afbfcc;border-color:#edf4fc"></td>
                                    <td>Etudes</td>
                                    <td>Procédures</td>
                                    <td>Réalisation</td>
                                    <td> Non Lancés</td>
                                    <td>Achevés</td>
                                    <td>Projets</td>
                                    <td>Non lancés</td>

                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

<!------------------------------------------------------------------------------------->

<script>
    // print function

    function printDiv(divName) {
        $('.hide').attr('hidden',true);
        $('.img-logo').attr('hidden',false);
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        location.reload();
    };
</script>
<script>
    $("#select-recap option[value='2']").prop('selected', true);
    $("#select-recap").change(function() {
        var a = $(this).val();
        var y = $("#year").val();
        if (a == "DUPW") {
            location.href = "/projet/gestionprojets/{{auth::user()->id}}/tout/"+y;
        } else {
            location.href = "/projet/recaps/" + a + "/" + "tout"+"/"+y;
        }

    });
</script>
<script>

    $("#year option[value='{{$year}}']").prop('selected', true);
    $(".select-filtre").change(function() {


        var y = $("#year").val();


        location.href = "/projet/recaps/2/tout/"+y;


    });
</script>

@endsection
