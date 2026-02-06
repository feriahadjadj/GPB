@extends('layouts.poste') @section('content')
<a href="{{ url()->previous() }}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>
@can('manage-users')

<button class="btn delete btn-print " onclick="printDiv('Recap1')" id="btnPrintA"><i class="fas fa-print"></i></button>

@endcan


<div class="container">
    @can('manage-users') @endcan
    <div class="content justify-content-center row">



        <!-- section 2 ----------------------------------------------->
        <section id="Recap1">
            <div class="img-logo" style ='width:100%;margin-bottom:60px' hidden>
                <img src='{{asset('img/logo-head.png')}}' alt='img-logo' width='20%'>
                <div class="float-right" style="margin-right: 20px ;margin-top: 10px">
                <h5>{{Carbon\Carbon::now()}}</h5>
                </div>

            </div>
            <h3 class="recap-title">Récape générale des projets par WILAYA et par MODE DE FINANCEMENT</h3>
            <h5 class="img-logo" style="margin-left:10px;font-weight:bold" hidden>Projets de l'année {{$year}} @if($finance!='tout')et le mode de financement {{$finance}}@endif</h5>

            <div class="form-inline  d-flex"  >
                <div class="form-group hide" style="margin-left:10px" >
                <label for="finance" ><strong>Financement</strong> </label>
                <select name="finance" id="finance" class="form-control  select-filtre">

                    <option value="tout">tout</option>
                    @foreach ($finances as $f)
                    <option value="{{$f->name}}" @if($f->name == $finance) selected @endif>{{$f->name}}</option>

                    @endforeach

                </select>
               </div>

                <div class="form-group hide" style="margin-left:20px">
                    <label  for="year" > <strong>Année</strong>  </label>
                    <select  form-control" name="year" id="year" class="wilaya select-filtre  form-control ">

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
                    <div class="well tableContainer" id="content" style="padding: 5px;" >

                        <table id="resultA" class="table resultA table-bordered table-condensed scrollTable">
                            <thead class="thead-dark fixedHeader">

                                <tr>
                                    <th rowspan=2>Wilaya </th>
                                    <th colspan=5>nature des travaux </th>
                                    <th rowspan=2>Total Projets</th>

                                    <th rowspan=2>Montant total alloué</th>
                                    <th rowspan=2>Montant des paiments cumulés </th>

                                    <th rowspan=2>tauxA de consommation</th>

                                </tr>

                                <tr>
                                    <th>construction</th>
                                    <th>Réhabilitation</th>
                                    <th>Aménagement</th>
                                    <th>Etancheïté</th>
                                    <th>Logement d'astreinte</th>

                                </tr>
                            </thead>

                            <tbody class="scrollContent">

                                @foreach ($users as $user)

                                <tr>
                                    <td>
                                        <button data-toggle="modal" data-target="#myModal" style="border:none;background:white"><strong>{{$user['name']}}</strong></button>
                                    </td>

                                    <td>{{$user['construction']}}</td>
                                    <td>{{$user['rehabilitation']}}</td>
                                    <td>{{$user['amenagement']}}</td>
                                    <td>{{$user['etancheite']}}</td>
                                    <td>{{$user['logements d\'astreinte']}}</td>

                                    <td>{{$user['totalP']}}</td>
                                    <td>{{$user['montantAlloue']}}</td>
                                    <td>{{$user['montantPC']}}</td>
                                    <td>{{$user['tauxConsommation']}}</td>



                                </tr>
                                @endforeach
                                <tr class="projetTot">
                                    <td><strong>Total 50 UPW</strong></td>
                                    <td>{{$total['construction']}}</td>
                                    <td>{{$total['rehabilitation']}}</td>
                                    <td>{{$total['amenagement']}}</td>
                                    <td>{{$total['etancheite']}}</td>
                                    <td>{{$total['logements d\'astreinte']}}</td>

                                    <td>{{$total['totalP']}}</td>
                                    <td>{{$total['montantAlloue']}}</td>
                                    <td>{{$total['montantPC']}}</td>
                                    <td>{{$total['tauxConsommation']}}</td>
                                </tr>
                                <tr class="projetTot" style="border-bottom:0px !important">
                                    <td style="background:#afbfcc;border-color:#edf4fc;"></td>
                                    <td>Construct</td>
                                    <td>Réhabilit</td>
                                    <td>Aménagem</td>
                                    <td>Etancheïté</td>
                                    <td>Logement d'astreinte</td>
                                    <td>Projets</td>

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
    $("#select-recap option[value='1']").prop('selected', true);
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
    $("#finance option[value='{{$finance}}']").prop('selected', true);
    $("#year option[value='{{$year}}']").prop('selected', true);
    $(".select-filtre").change(function() {

        var f = $("#finance").val();
        var y = $("#year").val();


        location.href = "/projet/recaps/1/" + f+"/"+y;


    });
</script>
@endsection
