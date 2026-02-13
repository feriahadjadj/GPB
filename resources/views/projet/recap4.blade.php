@extends('layouts.poste')
<style>
/* -----------------------------------------
  =Default css to make the demo more pretty
-------------------------------------------- */




/* -----------------------------------------
  =CSS3 Loading animations
-------------------------------------------- */

/* =Elements style
---------------------- */




.spinner {
  position: relative;
  width: 45px;
  height: 45px;
  margin: 0 auto;
}

.bubble-1,
.bubble-2 {
  position: absolute;
  top: 0;
  width: 25px;
  height: 25px;
  border-radius: 100%;
  background-color: #4b9cdb;
}

.bubble-2 {
  top: auto;
  bottom: 0;
}



/* =Animate the stuff
------------------------ */
.load-9{
    margin-top:100px;
}
.load-9 .spinner {
  animation: loadingI 2s linear infinite;
}
.load-9 .bubble-1,
.load-9 .bubble-2 {
  animation: bounce 2s ease-in-out infinite;
}
.load-9 .bubble-2 {
  animation-delay: -1s;
}



@keyframes loadingI {
  100% {
    transform: rotate(360deg);
  }
}

@keyframes bounce {
  0%,
  100% {
    transform: scale(0);
  }
  50% {
    transform: scale(1);
  }
}


</style>
@section('content')
<a href="{{ url()->previous() }}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>
@can('manage-users')

<button class="btn delete btn-print " onclick="printDiv('constructionS')" id="btnPrintA"><i class="fas fa-print"></i></button>

@endcan

<div class="container-fluid">
    <div class="tabs" style="padding: 0px; height: auto; transform: none; left: auto;">
        <div class="form-inline d-flex" style="margin-bottom: 20px; position: relative; z-index: 100;" >


            <div class="form-group" style="margin-left: auto;margin-right: 0;">
                <label  for="year" > <strong>Année</strong>  </label>
                <select  form-control" name="year" id="year" class="wilaya select-filtre form-control ">

                    @for ($i =(int)(Carbon\Carbon::today()->year) ; $i> (int)(Carbon\Carbon::today()->year)-5;$i--)
                    <option value="{{$i}}" >{{$i}}</option>

                    @endfor
                </select>
             </div>
            <div class="form-group" >
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
    <h3 class="recap-title">Récape des projets par WILAYA et par NATURE DES TRAVAUX</h3>




        @foreach ($natures as $nat)

        <input class="radios" type="radio" id="{{$nat->id}}" name="tab-control" onclick="changePrintId('{{$nat->id}}S')" @if($nat->name=='construction')checked @endif>
        @endforeach


    <ul>

        @foreach ($natures as $nat)
        <li title="{{$nat->name}}">
            <label for="{{$nat->id}}" role="button">
                <br><span>{{$nat->name}}</span></label>
        </li>
        @endforeach



    </ul>


            <!-- table nature construction tot ls wilaya -->
            <div class="content">
                @foreach ($natures as $nat)
            <section id="{{$nat->id}}S">
                <div class="img-logo" style ='width:100%;margin-bottom:60px' hidden>
                    <img src='{{asset('img/logo-head.png')}}' alt='img-logo' width='20%'>
                    <div class="float-right" style="margin-right: 20px ;margin-top: 10px">
                    <h5>{{Carbon\Carbon::now()}}</h5>
                    </div>

                </div>

                <h3 class="recap-title img-logo" hidden>Récap des projets par WILAYA et par NATURE DES TRAVAUX</h3>
                <h4 class="img-logo" style="margin-left:10px" hidden>Projets de {{$nat->name}} l'année {{$year}}</h4>
                @if($nat->name=='construction')
                @include('projet.recap4_section')
                @endif

                    </section>
                @endforeach











        </div>

    </div>

</div>


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
    $("#select-recap option[value='4']").prop('selected', true);
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

        var nature = $("input[name='tab-control']:checked").attr('id');
        var y = $("#year").val();
        $("#"+nature+"S").html('<div class="load-9"><div class="spinner"><div class="bubble-1"></div><div class="bubble-2"></div></div></div>');
            if(nature){

                $.ajax({
                url: '/../../projet/recap4/'+nature+'/'+y,
                type: 'GET',

                success: function(data) {
                    console.log(data);
                    $("#"+nature+"S").html(data);
                }
            });
        }


    });
</script>

<script>

    a=$("input[name='tab-control']:checked").attr('id');
    $("#btnPrintA").attr("onclick", "printDiv('" + a + "S')");
    function changePrintId(a) {

        $("#btnPrintA").attr("onclick", "printDiv('" + a + "')");

    };
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $(document).ready(function() {

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


        $( "input[type='radio']" ).click(function(){

            var y = $("#year").val();
            var nature = $("input[name='tab-control']:checked").attr('id');
            $("#"+nature+"S").html('<div class="load-9"><div class="spinner"><div class="bubble-1"></div><div class="bubble-2"></div></div></div>');
            if(nature){




            $.ajax({


                url: '/../../projet/recap4/'+nature+'/'+y,
                type: 'GET',

                success: function(data) {
                    console.log(data);
                    $("#"+nature+"S").html(data);
                }
            });


        }
        });



    });

</script>
@endsection
