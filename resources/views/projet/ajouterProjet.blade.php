@extends('layouts.poste')

@section('content')

<a href="{{ url()->previous() }}" class="btn btn-light mb-3">
    <i class="fas fa-arrow-circle-left"></i> Retour
</a>

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12">

        <!-- Card wrapper -->
        <div class="card shadow border-0 rounded-4">
            <!-- Card header with gradient -->
            <div class="card-header text-white p-3" style="background: linear-gradient(60deg, #0068FE 0%, #4D95FE 100%); font-weight:600; font-size:1.25rem;">
                Nouveau Projet
            </div>

            <!-- Card body -->
            <div class="card-body p-4">

                <form id="form" action="{{ route('projet.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Include project fields -->
                    @include('projet.shared.projectForm')

                    <!-- Submit/reset buttons -->
                    
                </form>

            </div>
        </div>

    </div>
</div>

<style>
    /* Form controls */
    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #CED4DA;
        padding: 0.625rem 0.75rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #0068FE;
        box-shadow: 0 0 0 0.2rem rgba(0, 104, 254, 0.25);
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    /* Error messages */
    .text-danger {
        font-size: 0.875rem;
    }

    /* Buttons */
    .btn-primary {
        background-color: #0068FE;
        border: none;
        border-radius: 0.5rem;
        font-weight: 500;
    }
    .btn-primary:hover {
        background-color: #004EBF;
    }

    .btn-outline-secondary {
        border-radius: 0.5rem;
    }

    /* Card shadow */
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }
</style>

<script>
    // ==========================
    // Etat Physique automatic selection
    // ==========================
    var odsEtude = $('input[name$="odsEtude"]').val();
    if(odsEtude.length == 0){
        $("#etatPhysique option[value='NL']").attr('selected','selected');
    }

    $('input[name$="odsEtude"]').change(function() {
        if($(this).val().length == 0){
            $("#etatPhysique option[value='NL']").attr('selected','selected');
            $("#etatPhysique option:selected").removeAttr('selected');
        } else {
            if ($("#etatPhysique option:selected").val() == "NL") {
                $("#etatPhysique option[value='NL']").removeAttr('selected');
                $("#etatPhysique option[value='E']").attr('selected',true);
            }
        }
    });

    $('select[name$="etatPhysique"]').change(function() {
        if($('input[name$="odsEtude"]').val().length == 0 ){
            $("#etatPhysique option[value='NL']").attr('selected',true);
            $("#etatPhysique option:selected").removeAttr('selected');
        } else {
            if ($("#etatPhysique option:selected").val() == "NL"){
                $("#etatPhysique option[value='NL']").removeAttr('selected');
                $("#etatPhysique option[value='E']").attr('selected',true);
            }
        }
    });

    // ==========================
    // Validation montant
    // ==========================
    $('form').submit(function(e) {
        $("#erreur-montantEC").html('');
        $("#erreur-montantPC").html('');
        var mA = parseInt($("#montantAlloue").val());
        var mec = parseInt($("#montantEC").val());
        var mpc = parseInt($("#montantPC").val());

        if (mpc > mA) {
            e.preventDefault();
            $("#erreur-montantPC").html('Le montant doit être inférieur au montant alloué !');
            window.location.href = "#montantPC";
        }

        if (mec > mA) {
            e.preventDefault();
            $("#erreur-montantEC").html('Le montant doit être inférieur au montant alloué !');
            window.location.href = "#montantEC";
        }
    });
</script>

@endsection
