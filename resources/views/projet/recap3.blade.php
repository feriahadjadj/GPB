@extends('layouts.poste')
@section('content')
<a href="{{ url()->previous() }}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>
@can('manage-users')

<button class="btn delete btn-print " onclick="printDiv('Recap3')" id="btnPrintA"><i class="fas fa-print"></i></button>

@endcan
<style>
    @media print{@page{size:landscape}}
</style>

<div class="container">
    @can('manage-users') @endcan
    <div class=" justify-content-center row">
     <!-- section 5 ----------------------------------------------->
     <section  >

        <h3 class="recap-title hide">Récape des projets par WILAYA </h3>


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
                {{--  --}}
            <select name="select-recap" id="select-recap"  class=" form-control" >
                <option value="DUPW">DUPW</option>
                <option value="1">Récap 1</option>
                <option value="2">Récap 2</option>
                <option value="3">Récap 3</option>
                <option value="4">Récap 4</option>
            </select>
            </div>



        </div>

            <div class="row " >
                <div class="justify-content-center col-lg-12 col-md-12">
                    <div class=" table-responsive" id="Recap3" >

                    <div class="img-logo" style ='width:100%;margin-bottom:60px' hidden>
                        <img src='{{asset('img/logo-head.png')}}' alt='img-logo' width='20%'>
                        <div class="float-right" style="margin-right: 20px ;margin-top: 10px">
                        <h5>{{Carbon\Carbon::now()}}</h5>
                        </div>

                    </div>

                    <h3 class="recap-title img-logo" hidden>Récape des projets par WILAYA <span class="img-logo recap-title"  hidden>de l'année {{$year}}</span></h3>
                        <table id="resultA" class="table resultA table-bordered" style="width: 80%">

                                                <thead class="thead-dark">

                                                <tr>
                                                    <th >nature des travaux </th>
                                                    <th colspan=5>construction</th>
                                                    <th colspan=5>Réhabilitation</th>
                                                    <th colspan=5>Aménagement</th>
                                                    <th colspan=5>Etancheïté</th>
                                                    <th colspan=5>Logement d'astreinte</th>
                                                    <th rowspan=2>Total projets</th>

                                                </tr>

                                                <tr>
                                                <th >Phase Projet</th>

                                                <th >E</th>
                                                <th>P</th>
                                                <th>R</th>
                                                <th>NL</th>
                                                <th>A</th>

                                                <th >E</th>
                                                <th>P</th>
                                                <th>R</th>
                                                <th>NL</th>
                                                <th>A</th>

                                                <th >E</th>
                                                <th>P</th>
                                                <th>R</th>
                                                <th>NL</th>
                                                <th>A</th>

                                                <th >E</th>
                                                <th>P</th>
                                                <th>R</th>
                                                <th>NL</th>
                                                <th>A</th>

                                                <th >E</th>
                                                <th>P</th>
                                                <th>R</th>
                                                <th>NL</th>
                                                <th>A</th>

                                                </tr>
                                            </thead>
                            <tbody>

                                @foreach ($users as $user)

                                <tr>
                                    <td class="right-border">{{$user['name']}}</td>
                                    @foreach ($user['nature'] as  $nature)

                                        <td>{{$nature['E']}}</td>
                                        <td>{{$nature['P']}}</td>
                                        <td>{{$nature['R']}}</td>
                                        <td>{{$nature['NL']}}</td>
                                        <td class="right-border">{{$nature['A']}}</td>
                                    @endforeach
                                        <td>{{$user['totalP']}}</td>

                                </tr>
                                @endforeach
                            <tr class="projetTot">
                                <td ><strong>Total</strong></td>


                                @foreach ($total['nature'] as  $nature)

                                        <td>{{$nature['E']}}</td>
                                        <td>{{$nature['P']}}</td>
                                        <td>{{$nature['R']}}</td>
                                        <td>{{$nature['NL']}}</td>
                                        <td >{{$nature['A']}}</td>
                                    @endforeach
                                        <td rowspan=3>{{$total['totalP']}}</td>


                            </tr>

                            <tr class="projetTot">


                                <td ><strong>Taux %</strong></td>

                                @foreach ($total['tauxNature'] as  $nature)

                                <td>{{$nature['E']}}</td>
                                <td>{{$nature['P']}}</td>
                                <td>{{$nature['R']}}</td>
                                <td>{{$nature['NL']}}</td>
                                <td >{{$nature['A']}}</td>
                                @endforeach

                            </tr>

                            <tr class="projetTot" style="border-bottom:0px !important"> <th style="background:#afbfcc;border-color:#edf4fc !important"></th>


                                @foreach ($total['nature'] as  $nature)
                                <th colspan=5 >{{$nature['total']}}</th>
                                @endforeach

                            </tr>
                            </tbody>
                        </table>


                        <table class="table resultA table-bordered hide">


                                <thead class="thead-dark">

                                    <tr>
                                        <th >Etat physique</th>
                                        <th >construction</th>
                                        <th >Réhabilitation</th>
                                        <th >Aménagement</th>
                                        <th >Etancheïté</th>
                                        <th >Logement d'astreinte</th>
                                        <th >Total projets</th>

                                    </tr>


                            </thead>
                            <tbody>

                                    @php
                                      $a=0;
                                       $r=0;
                                       $nl=0;
                                    @endphp
                                <tr>
                                    <th >Projets achevés </th>
                                    @foreach ($total['nature'] as  $nature)
                                    @php
                                    $a+=$nature['A'];
                                    $r+=$nature['R'];
                                    $nl+=$nature['E']+$nature['P']+$nature['NL'];
                                    @endphp
                                    <td >{{$nature['A']}}</td>
                                    @endforeach

                                    <th>{{$a}}</th>

                                </tr>
                                <tr>

                                    <th >Projets en cours de réalisation</th>
                                    @foreach ($total['nature'] as  $nature)
                                    <td >{{$nature['R']}}</td>
                                    @endforeach

                                    <th>{{$r}}</th>

                                </tr>
                                <tr>
                                    <th >Projets non lancés (E+P+NL)</th>
                                    @foreach ($total['nature'] as  $nature)
                                    <td >{{$nature['E']+$nature['P']+$nature['NL']}}</td>
                                    @endforeach

                                    <th>{{$nl}}</th>

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
    $("#select-recap option[value='3']").prop('selected', true);
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


        location.href = "/projet/recaps/3/tout/"+y;


    });
</script>

@endsection