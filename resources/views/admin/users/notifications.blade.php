@extends('layouts.poste') @section('content')
<a href="{{ route('home') }}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>
<div class="container">

    <div class="row justify-content-center">
        @if ($message = Session::get('error'))

            <div class="alert alert-danger alert-block col-md-9 ">

                <strong>{{ $message }}</strong>
            </div>

        @elseif ($message = Session::get('success'))

            <div class="alert alert-success alert-block col-md-9  ">

                <strong>Le changement à été fait avec succès </strong>
            </div>


        @endif
        <div class="col-md-9 list-group" style="padding-top: 20px;padding-right:0;">
            @if($notifications->count()==0)

            <div class="row justify-content-center">
                <div class="col-md-12 row justify-content-center">
                    <h1>Aucune notification disponible</h1></div>

                <img src="{{asset('img/jaune_empty.svg')}}" style="width:25em ;margin-top: 50px" alt="empty">
            </div>

            @else
            <div class="list-group-item list-group-item-action active ">
                <div class="row">
                <div class="col-md-3"><strong>Notification</strong></div>
                <div class="col-md-7"></div>

                <div class="col-md-2 text-right" style="font-size:1.1rem;margin-top:2px" >

                    <a  id='enveloppe' onclick="markAsRead()" hidden><i class="fas fa-envelope-open"></i></a>
                    <a id="deleteNotif" onclick="deleteNotifs()" hidden><i class="fas fa-trash"></i></a>
                    <input type="checkbox"   id="checkAll" style="margin-left: 18px; margin-right: 8;" >
                </div>
                {{-- <div class="col-md-1 text-center"></div> --}}

            </div>
            </div>
            <div >
                <form action="" method="POST">
                    {{csrf_field()}}
                @foreach ($notifications as $notification) @if($notification->unread())
                <a href="{{route('projet.voirprojet',$notification->data['projet_id'])}}" id="{{$notification->id}}" class="list-group-item list-group-item-action ">
                    <div class="row">
                        <div class="col-md-3"> <span class="badge badge-primary badge-pill   "> {{$notification->data['type']}} </span></div>
                        <div class="col-md-6">{{$notification->data['text']}}</div>
                        <div class="col-md-2"><span class="badge badge-warning badge-pill float-right">{{ substr((string) $notification->getOriginal('created_at'), 0, 16) }}</span> </div>
                        <div class="col-md-1"><span class=" float-right"><input type="checkbox" id="{{$notification->id}}"  name="notRead" value="{{$notification->id}}"></span> </div>
                    </div>
                </a>
                @else
                <a class="list-group-item list-group-item-secondary ">
                    <div class="row">
                        <div class="col-md-3"> <span class="badge badge-primary badge-pill   "> {{$notification->data['type']}} </span></div>
                        <div class="col-md-6">{{$notification->data['text']}}</div>
                        <div class="col-md-2"><span class="badge badge-warning badge-pill float-right">{{ substr((string) $notification->getOriginal('created_at'), 0, 16) }}</span> </div>
                      <div class="col-md-1"><span class=" float-right"><input type="checkbox" id="{{$notification->id}}" name="Read" value="{{$notification->id}}"></span> </div>

                    </div>
                </a>
                @endif @endforeach
                <div style="margin-top:30px"> {{ $notifications->links() }}</div>
            </form>
            </div>

            @endif
        </div>
    </div>
</div>

<script>
    $('#checkAll').click(function () {
        $('input:checkbox').prop('checked', this.checked);
     });
     $('input:checkbox').click(function(){
        if($('input:checkbox:checked').length != 0){
        $('#enveloppe').removeAttr('hidden');
        $('#deleteNotif').removeAttr('hidden');
        }else{
        $('#enveloppe').attr('hidden','');
        $('#deleteNotif').attr('hidden','');
        }

     });

   // console.log($('input:checkbox').val());

    function markAsRead() {
        var checked=[];
        $.each($("input[name='notRead']:checked"),function(){
            checked.push($(this).val());
            //console.log("#" +$(this).attr('id'));
            $(this).parents('a:first').addClass("list-group-item-secondary");
        }
        );
        //alert(checked);
        if(checked!=""){
        $.ajax({
            method: 'POST',
            url: '{{ route('projet.markAsRead')}}',
            dataType:'text',
            data:{_token: '{{csrf_token()}}' , data:checked },

            success: function(data) {
                console.log(data);

            }


        });
    }


    }

    function deleteNotifs() {
        var checked=[];
        $.each($("input:checked"),function(){
            // delete all check exept check all
            if($(this).attr('id') !== "checkAll"){
             checked.push($(this).val());
            console.log("#" +$(this).attr('id'));
            $(this).parents('a:first').remove();
            }

        }
        );
        //alert(checked);
        if(checked!=""){
        $.ajax({
            method: 'POST',
            url: '{{ route('projet.deleteNotif')}}',
            dataType:'text',
            data:{_token: '{{csrf_token()}}' , data:checked },

            success: function(data) {
                console.log(data);

            }


        });
    }


    }
</script>
@endsection
