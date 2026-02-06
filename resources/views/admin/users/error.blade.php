@extends('layouts.poste')
@section('content')
<style >
body{
background-color:#edf4fc;
}
</style>
<div >
    <a href="{{ URL::previous() }}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>
    <div class=" row justify-content-center">

            <img src="{{asset('img/403_page2.jpg')}}" alt="Vous n'estes pas autorisé a voir ce contenu">

    </div>
</div>
@endsection
