@extends('layouts.poste')
@section('content')

<div class="page-container">

    <!-- Header -->
    <div class="page-header">
        <div>
            <h1>{{$projet->designation}}</h1>
            <div class="subtitle">
                <?php if($projet->nature=='logementsdastreinte'){echo "Logements d'astreinte";}else{echo $projet->nature;} ?>
            </div>
        </div>
        <div class="header-actions" style="display:flex; gap:10px;">
            <a href="{{route('images.index',['id'=>$projet->id])}}" class="btn-action btn-photos">
                <i class="fas fa-image"></i> Photos
            </a>
            <a href="{{route('projet.indexRetards',$projet->id)}}" class="btn-action btn-ods">
                <i class="fa fa-clock"></i> ODS
            </a>
            @can('edit-projet')
            <div class="header-actions">
                <div class="dropdown">
                    <button class="btn-action btn-settings">
                        <i class="fas fa-cog"></i> Actions
                        <i class="fas fa-chevron-down" style="font-size:12px;"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button class="dropdown-item" onclick="printDiv('infoP')">
                                <i class="fas fa-print"></i> Imprimer
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item" onclick="openModal()">
                                <i class="fas fa-pen"></i> Modifier le projet
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item" onclick="if(confirm('Etes vous sur de vouloir supprimer ce projet ?')) { window.location='{{route('projet.destroy',$projet->id)}}'; }">
                                <i class="fas fa-trash"></i> Supprimer projet
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            @endcan
        </div>
    </div>

    <!-- Project Info Table -->
    <div id="infoP">
        <div class="table-wrapper mb-4">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th rowspan="2">Financement</th>
                        <th rowspan="2">Délai des études</th>
                        <th colspan="2">ODS démarrage</th>
                        <th rowspan="2">Date réception</th>
                        <th rowspan="2">Date de mise en service</th>
                    </tr>
                    <tr>
                        <th>Etudes ODS</th>
                        <th>Réalisation ODS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$projet->finance}}</td>
                        <td>{{$projet->delaiE}}</td>
                        <td>@if($projet->odsEtude){{Carbon\Carbon::parse($projet->odsEtude)->format('d-m-Y')}}@endif</td>
                        <td>@if($projet->odsRealisation){{Carbon\Carbon::parse($projet->odsRealisation)->format('d-m-Y')}}@endif</td>
                        <td>@if($projet->dateReception){{Carbon\Carbon::parse($projet->dateReception)->format('d-m-Y')}}@endif</td>
                        <td>@if($projet->dateMiseEnOeuvre){{Carbon\Carbon::parse($projet->dateMiseEnOeuvre)->format('d-m-Y')}}@endif</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Progress Table -->
        <div class="table-wrapper">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th>Montants Alloué</th>
                        <th>Montants des engagements cumulés</th>
                        <th>Montant des paiements cumulés</th>
                        <th>Délai de réalisation</th>
                        <th>Etat physique</th>
                        <th>Taux d'avancement</th>
                        <th>Observations / Contraintes</th>
                        <th>Date de modification</th>
                        @can('info') <th>Action</th> @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projet->avancement->all() as $av)
                    <tr>
                        <td>{{$av->montantAlloue}}</td>
                        <td>{{$av->montantEC}}</td>
                        <td>{{$av->montantPC}}</td>
                        <td>{{$av->delaiR}}</td>
                        <td>{{$av->etatPhysique}}</td>
                        <td>
                            <div class="progress-wrap">
                                <div class="progress">
                                    <div class="progress-bar" style="width:{{$av->tauxA}}%"></div>
                                </div>
                                <div class="progress-text">{{$av->tauxA}}%</div>
                            </div>
                        </td>
                        <td>{{$av->observation}}</td>
                        <td>{{Carbon\Carbon::parse($av->created_at)->format('d-m-Y h:i')}}</td>
                        @can('info')
                        <td>
                            <button class="btn-inline" onclick="if(confirm('Supprimer cette entrée ?')){window.location='{{route('projet.deleteA',['avancement'=>$av->id,'projet'=>$projet->id])}}'}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- HISTORIQUE DES MODIFICATIONS -->
<div class="page-container mt-4">
    <h2>Historique des modifications</h2>
    <p class="subtitle">
        Historique chronologique des mises à jour du projet
    </p>

    <div class="table-wrapper">
        <table class="pro-table shadow-table">
            <thead>
                <tr>
                    <th style="width:180px;">Date & Heure</th>
                    <th>Détail de la modification</th>
                </tr>
            </thead>
            <tbody>

                <!-- FAKE DATA ALGÉRIE POSTE -->
                <tr>
                    <td>04-02-2026 11:42</td>
                    <td>
                        <strong>Montant alloué</strong> modifié de
                        <span class="old-value">18 000 000 DZD</span>
                        →
                        <span class="new-value">20 500 000 DZD</span>
                        (Réévaluation budgétaire validée)
                    </td>
                </tr>

                <tr>
                    <td>02-02-2026 15:18</td>
               <td>
    État :
    <span class="status status-old">NL</span>
    →
    <span class="status status-new">E</span>
</td>

                </tr>

                <tr>
                    <td>31-01-2026 09:55</td>
                    <td>
                        <strong>Délai des études</strong> prolongé :
                        <span class="old-value">30 jours</span>
                        →
                        <span class="new-value">45 jours</span>
                        (Retard de validation technique)
                    </td>
                </tr>

                <tr>
                    <td>29-01-2026 14:07</td>
                    <td>
                        <strong>Montant des paiements cumulés</strong> mis à jour :
                        <span class="old-value">8 200 000 DZD</span>
                        →
                        <span class="new-value">10 000 000 DZD</span>
                    </td>
                </tr>

                <tr>
                    <td>27-01-2026 16:30</td>
                    <td>
                        Ajout d’une <strong>observation terrain</strong> :
                        <em>
                            « Difficulté d’accès au site de construction,
                            impact sur le rythme d’avancement »
                        </em>
                    </td>
                </tr>

                <tr>
                    <td>25-01-2026 10:12</td>
                    <td>
                        <strong>Création du projet</strong>  
                        (Type : Logements d’astreinte – Algérie Poste,
                        Financement : Budget central)
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Editing Project -->
<div id="myModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Modifier Projet</h3>
            <button onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <form id="form" action="{{route('projet.update',$projet->id)}}" method="POST">
                {{csrf_field()}}
                @include('projet.shared.projectForm')
            </form>
        </div>
    </div>
</div>
<script>
function openModal() {
    const modal = document.getElementById('myModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden'; // prevent background scroll
}

function closeModal() {
    const modal = document.getElementById('myModal');
    modal.style.display = 'none';
    document.body.style.overflow = ''; // restore scroll
}

/* Close modal when clicking outside */
document.addEventListener('click', function (e) {
    const modal = document.getElementById('myModal');
    if (modal.style.display === 'flex' && e.target === modal) {
        closeModal();
    }
});

/* Close modal with ESC key (enterprise UX standard) */
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>

<script>

function printDiv(divName) {
    // Show logo and hide action buttons
    $('.hide').attr('hidden', true);
    $('.img-logo').attr('hidden', false);

    // Get content of the div
    var content = document.getElementById(divName).innerHTML;

    // Open a new window for printing
    var printWindow = window.open('', '', 'height=900,width=1200');

    // Write the HTML content with CSS
    printWindow.document.write(`
        <html>
        <head>
            <title>Impression Projet</title>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- your main app styles -->
            <style>
                body { font-family: 'Inter', sans-serif; margin: 20px; color: #111827; }
                h2 { color: #003c71; margin-bottom: 20px; }
                .img-logo { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
                .img-logo img { width: 150px; }
                .img-logo .date { font-size: 14px; color: #6b7280; }

                table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
                th, td { border: 1px solid #e5e7eb; padding: 8px; text-align: left; font-size: 13px; }
                th { background-color: #f1f5f9; font-weight: 600; }
                .progress { height: 8px; background: #e5e7eb; border-radius: 6px; overflow: hidden; }
                .progress-bar { height: 100%; background: linear-gradient(90deg,#0068FE,#4D95FE); }

                .shadow-table { box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
            </style>
        </head>
        <body>
            ${content}
        </body>
        </html>
    `);

    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();

    // Restore visibility
    $('.hide').attr('hidden', false);
    $('.img-logo').attr('hidden', true);
}

</script>


<style>
/* ===== BODY ===== */
body { font-family:'Inter',sans-serif; background:#f3f4f6; margin:0; }
.status {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid transparent;
}

.status-old {
    background: #f1f5f9;
    color: #475569;
    border-color: #cbd5e1;
}

.status-new {
    background: #ecfeff;
    color: #0369a1;
    border-color: #67e8f9;
}

/* ===== PAGE CONTAINER ===== */
.page-container { background:#fff; padding:30px 40px; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.08); margin:20px auto; max-width:98%; }

/* ===== HEADER ===== */
.page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; border-bottom:1px solid #e5e7eb; padding-bottom:15px; }
.page-header h1 { margin:0; font-size:24px; color:#111827; }
.subtitle { color:#6b7280; font-size:14px; margin-top:4px; }
.header-actions { display:flex; gap:10px; }

/* ===== BUTTONS ===== */
.btn-action { display:inline-flex; align-items:center; gap:6px; padding:8px 14px; font-size:14px; font-weight:500; border-radius:8px; text-decoration:none; transition:all 0.2s; border:1px solid transparent; cursor:pointer; }
.btn-photos { color:#004EBF; background:#e7f0ff; border-color:#c7d9f5; }
.btn-photos:hover { background:#d0e0ff; border-color:#a6c4f0; }
.btn-ods { color:#F59E0B; background:#fff7e6; border-color:#fcd68a; }
.btn-ods:hover { background:#fff2d1; border-color:#fbc26a; }
.btn-primary { background:#0068FE; color:#fff; padding:10px 16px; border-radius:8px; font-weight:500; transition:all 0.2s; border:none; cursor:pointer; }
.btn-primary:hover { background:#0050c7; }
.btn-secondary { background:#f1f5f9; border:1px solid #cbd5e1; padding:10px 16px; border-radius:8px; font-weight:500; cursor:pointer; }
.btn-secondary:hover { background:#e2e8f0; }
.btn-inline { background:#f1f5f9; border:1px solid #cbd5e1; border-radius:6px; padding:4px 10px; font-size:13px; font-weight:500; cursor:pointer; transition:all 0.2s; }
.btn-inline:hover { background:#e2e8f0; border-color:#a3b4c4; transform:translateY(-1px); }
.old-value {
    color: #dc2626;
    text-decoration: line-through;
    font-weight: 500;
}
.badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    line-height: 1;
    white-space: nowrap;
}

.badge-info {
    background-color: #e0f2fe;
    color: #0369a1;
}

.badge-success {
    background-color: #dcfce7;
    color: #166534;
}

.new-value {
    color: #16a34a;
    font-weight: 600;
}

.badge {
    padding: 3px 8px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 500;
}

.badge-info {
    background: #e0f2fe;
    color: #0369a1;
}

.badge-success {
    background: #dcfce7;
    color: #166534;
}

/* ===== DROPDOWN ===== */
.dropdown { position:relative; display:inline-block; }
.dropdown-menu { display:none; position:absolute; top:calc(100% + 5px); right:0; background:#fff; border:1px solid #e5e7eb; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.08); min-width:180px; padding:6px 0; z-index:100; }
.dropdown-menu li { list-style:none; margin:0; }
.dropdown-menu .dropdown-item { width:100%; padding:8px 14px; background:#fff; border:none; text-align:left; display:flex; align-items:center; gap:6px; font-size:14px; font-weight:500; color:#111827; cursor:pointer; transition:all 0.2s; }
.dropdown-menu .dropdown-item:hover { background:#f1f5f9; }
.btn-settings { display:inline-flex; align-items:center; gap:6px; padding:8px 14px; font-size:14px; font-weight:500; color:#111827; background:#f1f5f9; border:1px solid #e5e7eb; border-radius:8px; cursor:pointer; transition:all 0.2s; }
.btn-settings:hover { background:#e2e8f0; }
.dropdown:hover .dropdown-menu { display:block; }

/* ===== TABLE ===== */
.table-wrapper { max-height:500px; overflow-x:auto; border:1px solid #e5e7eb; border-radius:10px; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.03); padding:10px; margin-bottom:25px; }
.pro-table { width:100%; border-collapse:collapse; }
.pro-table th, .pro-table td { padding:12px 10px; border-bottom:1px solid #e5e7eb; font-size:14px; }
.pro-table thead th { position:sticky; top:0; background:#f1f5f9; font-weight:600; }

/* ===== PROGRESS BAR ===== */
.progress-wrap { display:flex; align-items:center; gap:8px; }
.progress { width:100%; height:8px; background:#e5e7eb; border-radius:6px; overflow:hidden; }
.progress-bar { height:100%; background:linear-gradient(90deg,#0068FE,#4D95FE); }
.progress-text { font-size:12px; min-width:40px; }

/* ===== MODAL ===== */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px; /* space around modal on small screens */
    z-index: 9999;
    overflow-y: auto; /* enable scrolling if content too tall */
}

.modal-box {
    background: #fff;
    width: 100%;
    max-width: 720px;
    max-height: 90vh; /* don't exceed 90% of viewport height */
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 18px;
    border-bottom: 1px solid #e5e7eb;
    flex-shrink: 0; /* keep header fixed height */
}

.modal-header h3 {
    margin: 0;
    font-size: 18px;
}

.modal-header button {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

.modal-body {
    padding: 18px;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    overflow-y: auto; /* scroll body if too tall */
}

/* responsive grid for smaller screens */
@media (max-width: 768px) {
    .modal-body {
        grid-template-columns: 1fr; /* stack items vertically */
    }
}

.modal-item {
    background: #f8fafc;
    padding: 10px;
    border-radius: 6px;
}

.modal-item span {
    display: block;
    font-size: 12px;
    color: #6b7280;
}

/* optional fade-in animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>

@endsection
