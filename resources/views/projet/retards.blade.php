@extends('layouts.poste')

@section('content')

<!-- Back button -->
<a href="{{route('projet.voirprojet',$id)}}" class="btn-back">
  <span class="arrow-circle">&#8592;</span> Retour
</a>

<!-- Form container with dashed border -->
<div class="ods-form-container">
    <h2 class="mb-4 text-center font-weight-bold">Ajout d’un ODS d’arrêt et de reprise</h2>
    <br>

    @can('upw-role')
    <form action="{{ route('projet.storeRetard',$id) }}" method="post" class="form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div id="form-arret_etude">

            <div class="form-group col-2 text-center">
                <label for="etude">Etude</label>
                <input class="form-check-input" type="radio" name="type" id="etude" value="etude" checked>
            </div>

            <div class="form-group col-2 text-center">
                <label for="realisation">Réalisation</label>
                <input class="form-check-input" type="radio" name="type" id="realisation" value="réalisation">
            </div>

            <div class="form-group col-3">
                <label for="reason">Motif</label>
                <textarea class="form-control" name="reason" id="reason" rows="1" required></textarea>
            </div>

            <div class="form-group col-2">
                <label for="start-date">Arret</label>
                <input type="date" id="start-date" name="date_arret" class="form-control" required>
            </div>

            <div class="form-group col-2">
                <label for="end-date">Reprise</label>
                <input type="date" id="end-date" name="date_reprise" class="form-control" required>
            </div>

           <div class="form-group col-4">
    <label for="attachment">Pièce jointe</label>
    <input type="file" name="attachment" id="attachment" class="form-control-file" required>
</div>


            <div class="form-group col-2">
                <button type="submit" class="btn btn-primary form-control">Ajouter</button>
            </div>

        </div>
    </form>
    @endcan
</div>

<br>

<div class="row">

    <!-- Etude Table -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>Etude</h3>
            </div>
            <div class="px-2">
                <table class="table table-striped" style="background: white">
                    <thead>
                        <th>Date d'arret</th>
                        <th>Date de reprise</th>
                        <th>Motif</th>
                        <th>Pièce jointe</th>
                        @can('upw-role') <th>Action</th> @endcan
                    </thead>
                    <tbody id="table-e">
                        @foreach ($retards as $r)
                            @if($r->type=="etude")
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($r->date_arret)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->date_reprise)->format('d-m-Y') }}</td>
                                <td>{{ $r->reason }}</td>
                                <td>
                                    @if($r->attachment)
                                        <a href="{{ asset('storage/'.$r->attachment) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                            Voir PJ
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                @can('upw-role')
                                <td style="display: flex;">
                                    <a href="{{route('projet.destroyRetard',$r->id)}}">
                                        <button type="button" class="btn delete mr-1" onclick="return confirm('Etes vous sur de vouloir supprimer cette ODS d\'arret')">
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

    <!-- Réalisation Table -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>Réalisation</h3>
            </div>
            <div class="px-2">
                <table class="table table-striped" style="background: white">
                    <thead>
                        <th>Date d'arret</th>
                        <th>Date de reprise</th>
                        <th>Motif</th>
                        <th>Pièce jointe</th>
                        @can('upw-role') <th>Action</th> @endcan
                    </thead>
                    <tbody id="table-r">
                        @foreach ($retards as $r)
                            @if($r->type=="réalisation")
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($r->date_arret)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->date_reprise)->format('d-m-Y') }}</td>
                                <td>{{ $r->reason }}</td>
                                <td>
                                    @if($r->attachment)
                                        <a href="{{ asset('storage/'.$r->attachment) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                            Voir PJ
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                @can('upw-role')
                                <td style="display: flex;">
                                    <a href="{{route('projet.destroyRetard',$r->id)}}">
                                        <button type="button" class="btn delete mr-1" onclick="return confirm('Etes vous sur de vouloir supprimer cette ODS d\'arret')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </a>
                                    <button onclick="editretard({{$r->id}})" data-toggle="modal" data-target="#editModal" id="btn-{{$r->id}}" type="button" class="btn btn-primary">
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

<!-- Edit Modal -->
<div id="editModal" class="modal" role="dialog">
    <div class="modal-sm modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Modifier ODS d'arret</strong></h4>
            </div>
            <div class="modal-body row justify-content-center">
                <form id="form-modal" action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="reason">Motif</label>
                        <textarea class="form-control" name="reason" id="reason-modal" rows="1" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="start-date">De</label>
                        <input type="date" id="start-date-modal" name="date_arret" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="end-date">A</label>
                        <input type="date" id="end-date-modal" name="date_reprise" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="attachment-modal">Pièce jointe</label>
                        <input type="file" name="attachment" id="attachment-modal" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    /* Basic styling */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #FFFFFF	;
        color: #333;
    }

    h2 {
        color:#2d3436;
        font-weight: bold;
    }

    .card {
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }

    .card-header {
        background-color:#E9ECEF;
        color: #333;
        font-weight: bold;
    }

    table.table {
        border-radius: 5px;
        overflow: hidden;
    }

    table.table th,
    table.table td {
        vertical-align: middle !important;
        padding: 12px 15px !important;
    }

    .btn {
        border-radius: 5px;
    }

    .form-control,
    .form-control-file {
        border-radius: 5px;
    }
.form-group.col-4 {
  display: flex;
  align-items: center;
  gap: 10px; /* space between label and input */
  justify-content: flex-start;
}

.form-group.col-4 label {
  margin-bottom: 0; /* remove bottom margin */
  white-space: nowrap; /* keep label on one line */
}

    .modal-content {
        border-radius: 10px;
    }

    hr {
        border-top: 2px solid #ffce00;
    }

    /* Back button */
    .btn-back {
        display: inline-flex;
        align-items: center;
        color: #4a90e2;
        font-weight: 500;
        text-decoration: none;
        margin: 20px;
        font-size: 1.25rem;
    }

    .arrow-circle {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #4a90e2;
        color: white;
        margin-right: 8px;
        font-size: 20px;
        font-weight: bold;
        line-height: 1;
    }

    /* Form container with dashed border */
    .ods-form-container {
        border: 2px dashed #FDC90A;
        padding: 15px 0;
        margin-bottom: 30px;
    }

    /* Form inline styling */
    #form-arret_etude {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    #form-arret_etude .form-group {
        margin-bottom: 10px;
        padding: 0 10px;
        text-align: center;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
    }

    textarea#reason {
        height: 38px;
        resize: none;
    }

    input[type="date"] {
        width: 130px;
    }

    label[for="attachment"],
    label[for="attachment-modal"] {
        text-align: left;
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
    }

    button[type="submit"] {
        background-color: #4a90e2;
        border: none;
        color: white;
        font-weight: 600;
        height: 38px;
        border-radius: 4px;
    }
</style>

<!-- Scripts -->
<script>
    function editretard(id){
        let url = "{{route('projet.updateRetard','id')}}";
        url = url.replace('id', id);
        $("#form-modal").attr('action', url);

        // Get table row data
        let row = $("#btn-"+id).closest('tr');
        let dateArret = row.find('td:nth-child(1)').text().split("-").reverse().join("-");
        let dateReprise = row.find('td:nth-child(2)').text().split("-").reverse().join("-");
        let reason = row.find('td:nth-child(3)').text();

        $('#start-date-modal').val(dateArret);
        $('#end-date-modal').val(dateReprise);
        $('#reason-modal').val(reason);
    }

    window.onload = function() {
        updateStartMinDate();
    }

    $("input[type='radio']").change(function(){
        updateStartMinDate();
    });

    function updateStartMinDate() {
        let type = $("input[type='radio']:checked").val();
        let table = (type=='etude') ? $('#table-e') : $('#table-r');
        if(table.children('tr').length > 0){
            let split = table.find('td:nth-child(2)').first().text().split('-');
            let date = split[2] + "-" + split[1] + "-" + split[0];
            $('#start-date').attr('min', date);
        } else {
            $('#start-date').attr('min','');
        }
    }

    $("#start-date").change(function(){
        $('#end-date').attr('min', $(this).val());
    });
</script>

@endsection
