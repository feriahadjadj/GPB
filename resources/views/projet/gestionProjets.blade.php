@extends('layouts.poste')
@section('content')

<style>
/* ===== BODY BACKGROUND ===== */
body {
    background: #f3f4f6; /* soft gray for contrast */
    font-family: 'Inter', sans-serif;
}

/* ===== CONTAINER CARD ===== */
.page-container {
    background: #fff;
    padding: 30px 40px;   /* top/bottom 30px, left/right 40px */
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin: 20px auto;
    max-width: 98%;       /* almost full width */
}


/* ===== HEADER ===== */
.page-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom: 25px;
    border-bottom: 1px solid #e5e7eb;
    padding-bottom: 15px;
}
.page-header h1 {
    margin:0;
    font-size:24px;
    color: #111827;
}
.subtitle {
    color: #6b7280;
    font-size:14px;
    margin-top:4px;
}
.header-actions {
    display:flex;
    gap:10px;
}

/* ===== BUTTONS ===== */
.btn-primary {
    background:#0068FE;
    color:#fff;
    padding:10px 16px;
    border-radius:8px;
    text-decoration:none;
    font-weight:500;
    transition: all 0.2s;
}
.btn-primary:hover { background:#0050c7; }
.btn-secondary {
    background:#f1f5f9;
    border:1px solid #cbd5e1;
    padding:10px 16px;
    border-radius:8px;
    font-weight:500;
    cursor:pointer;
}
.btn-secondary:hover {
    background:#e2e8f0;
}

/* ===== FILTER BAR ===== */
.filter-bar {
    display:flex;
    gap:20px;
    padding:18px 20px;
    background:#f9fafb;
    border-radius:10px;
    margin-bottom:25px;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
    flex-wrap:wrap;
}
.filter-bar .form-group {
    display:flex;
    flex-direction:column;
}

/* ===== KPI CARDS ===== */
.kpi-row {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:15px;
    margin-bottom:25px;
}
.kpi {
    background:#f9fafb;
    border:1px solid #e5e7eb;
    border-radius:10px;
    padding:20px;
    text-align:center;
    transition: transform 0.2s;
}
.kpi:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.05);
}
.kpi span {
    font-size:13px;
    color:#6b7280;
}
.kpi strong {
    display:block;
    margin-top:8px;
    font-size:20px;
    color:#111827;
}
.btn-inline {
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 4px 10px;          /* compact for table cells */
    font-size: 13px;
    font-weight: 500;
    color: #111827;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-block;
    white-space: nowrap;        /* prevent wrapping */
}

.btn-inline:hover {
    background: #e2e8f0;
    border-color: #a3b4c4;
    transform: translateY(-1px);
}

/* ===== TABS ===== */
.tabs-pro {
    display:flex;
    gap:10px;
    margin-bottom:15px;
    border-bottom:1px solid #e5e7eb;
    flex-wrap:wrap;
}
.tab-btn {
    padding:8px 16px;
    border:none;
    background:none;
    border-bottom:3px solid transparent;
    cursor:pointer;
    font-weight:500;
    transition: all 0.2s;
}
.tab-btn.active {
    border-color:#0068FE;
    color:#0068FE;
}

/* ===== TABLE ===== */
.tab-content { display:none; }
.tab-content.active { display:block; }

.table-wrapper {
    max-height:500px;
    overflow-x:auto;
    border:1px solid #e5e7eb;
    border-radius:10px;
    background:#fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    padding:10px;
}
.pro-table {
    width:100%;
    border-collapse:collapse;
}
.pro-table th, .pro-table td {
    padding:12px 10px;
    border-bottom:1px solid #e5e7eb;
    font-size:14px;
}
.pro-table thead th {
    position:sticky;
    top:0;
    background:#f1f5f9;
    font-weight:600;
}

/* ===== BADGES ===== */
.badge {
    padding:4px 10px;
    border-radius:12px;
    font-size:12px;
    background:#e5e7eb;
}

/* ===== PROGRESS BAR ===== */
.progress-wrap {
    display:flex;
    align-items:center;
    gap:8px;
}
.progress {
    width:100%;
    height:8px;
    background:#e5e7eb;
    border-radius:6px;
    overflow:hidden;
}
.progress-bar {
    height:100%;
    background:linear-gradient(90deg,#0068FE,#4D95FE);
}
.progress-text {
    font-size:12px;
    min-width:40px;
}

/* ===== DEADLINE ===== */
.deadline {
    font-weight:500;
}
.deadline.ok { color:#16a34a; }
.deadline.soon { color:#f59e0b; }
.deadline.late { color:#dc2626; }
.deadline a { text-decoration:none; color:inherit; }

/* ===== MODAL ===== */
.modal-overlay {
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.45);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:9999;
}
.modal-box {
    background:#fff;
    width:720px;
    max-width:95%;
    border-radius:12px;
    overflow:hidden;
}
.modal-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:14px 18px;
    border-bottom:1px solid #e5e7eb;
}
.modal-header h3 { margin:0; font-size:18px; }
.modal-header button {
    background:none;
    border:none;
    font-size:20px;
    cursor:pointer;
}
.modal-body {
    padding:18px;
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:12px;
}
.modal-item {
    background:#f8fafc;
    padding:10px;
    border-radius:6px;
}
.modal-item span {
    display:block;
    font-size:12px;
    color:#6b7280;
}

</style>

<div class="page-container">

    {{-- ================= HEADER ================= --}}
    <div class="page-header">
        <div>
            <h1>Gestion des projets</h1>
            <p class="subtitle">Suivi par type de financement</p>
        </div>

        <div class="header-actions">
            @can('upw-role')
                <a href="{{ route('projet.create') }}" class="btn-primary">+ Nouveau projet</a>
            @endcan
  @can('manage-users')
    <button class="btn-secondary" 
            onclick="printAllProjects()"

            style="background-color: #4D95FE; color:FFFFF; border: none; 
                   padding: 5px 10px; font-size: 15px;">
        Imprimer
    </button>
    
@endcan
</div>
    </div>

    {{-- ================= FILTER ================= --}}
    <div class="filter-bar">
        @can('manage-users')
<div class="form-group">
    <label><strong>Wilaya</strong></label>
    <select name="wilaya" id="wilaya" class="select-filtre form-control">
        @foreach (App\User::all() as $user)
            @if($user->roles->contains('name','user'))
                <option value="{{ $user->id }}"
                    {{ $user->id == ($id ?? auth()->id()) ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endif
        @endforeach
    </select>
    
</div>
@endcan


        <div class="form-group">
            <label><strong>Financement</strong></label>
            <select name="finance" id="finance" class="select-filtre form-control">
                <option value="tout">Tous</option>
                @foreach ($finances as $f)
                    <option value="{{$f->name}}" @if($f->name == $finance) selected @endif>{{$f->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><strong>Année</strong></label>
            <select name="year" id="year" class="select-filtre form-control">
                @for ($i = (int)Carbon\Carbon::today()->year; $i > (int)Carbon\Carbon::today()->year-5; $i--)
                    <option value="{{$i}}" @if($i==$year) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>

     {{-- DUPW / RECAP (TOUJOURS À LA FIN) --}}
    @can('edit-users')
   <div class="form-group" style="margin-left:auto">
    <label><strong>Vue</strong></label>
    <select name="select-recap" id="select-recap" class="form-control">

        <option value="DUPW"
            {{ request()->is('projet/gestionprojets*') ? 'selected' : '' }}>
            DUPW
        </option>

        <option value="1"
            {{ request()->is('projet/recaps/1*') ? 'selected' : '' }}>
            Récap 1
        </option>

        <option value="2"
            {{ request()->is('projet/recaps/2*') ? 'selected' : '' }}>
            Récap 2
        </option>

        <option value="3"
            {{ request()->is('projet/recaps/3*') ? 'selected' : '' }}>
            Récap 3
        </option>

        <option value="4"
            {{ request()->is('projet/recaps/4*') ? 'selected' : '' }}>
            Récap 4
        </option>

    </select>
</div>
    @endcan

</div>
    {{-- ================= TABS ================= --}}
    <div class="tabs-pro">
        @foreach($projetsFN as $i=>$type)
            <button class="tab-btn {{ $i==0?'active':'' }}" data-tab="tab-{{ $loop->index }}">
                {{ $type->name }}
            </button>
        @endforeach
    </div>

    {{-- ================= CONTENT ================= --}}
    @foreach($projetsFN as $i=>$type)
        @php
            $total = $type->count();
            $alloue = $type->sum('montantAlloue');
            $consomme = $type->sum('montantPC');
            $taux = $alloue > 0 ? round(($consomme / $alloue) * 100, 2) : 0;
        @endphp

        <div id="tab-{{ $loop->index }}" class="tab-content {{ $i==0?'active':'' }}">

            {{-- KPI --}}
            <div class="kpi-row">
    <div class="kpi" style="background-color: #fff7e6;">
        <span>Total projets</span>
        <strong>{{ $total }}</strong>
    </div>
    <div class="kpi" style="background-color: #fff7e6;">
        <span>Montant alloué (DZD)</span>
        <strong>{{ number_format($alloue, 0, ',', ' ') }} </strong>
    </div>
    <div class="kpi" style="background-color: #fff7e6;">
        <span>Taux consommation (%)</span>
        <strong>{{ $taux }} </strong>
    </div>
</div>


            {{-- TABLE --}}
            <div class="table-wrapper">
                <table class="pro-table">
                    <thead>
                        <tr>
                            <th>Désignation</th>
                            <th>Financement</th>
                            <th>Alloué</th>
                            <th>Engagé</th>
                            <th>Payé</th>
                            <th>ODS</th>
                            <th>État</th>
                            <th>Taux</th>
                            <th>Délai / Réception</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($type as $p)
                            @php
                                $today = \Carbon\Carbon::today();
                                $dateRec = $p->dateReception ? \Carbon\Carbon::parse($p->dateReception) : null;
                            @endphp
                            <tr>
                                <td><a href="{{ route('projet.voirprojet',$p->id) }}">{{ $p->designation }}</a></td>
                                <td>{{ $p->finance }}</td>
                                <td>{{ number_format($p->montantAlloue) }}</td>
                                <td>{{ number_format($p->montantEC) }}</td>
                                <td>{{ number_format($p->montantPC) }}</td>
                                <td>{{ $p->odsRealisation ?? '-' }}</td>
                                <td><span class="badge">{{ $p->etatPhysique }}</span></td>
                                <td>
                                    <div class="progress-wrap">
                                        <div class="progress">
                                            <div class="progress-bar" style="width: {{ min($p->tauxA,100) }}%"></div>
                                        </div>
                                        <span class="progress-text">{{ $p->tauxA }}%</span>
                                    </div>
                                </td>
                                <td>
                                    @if($dateRec)
                                        @php $days = $today->diffInDays($dateRec,false); @endphp
                                        <div class="deadline {{ $days < 0 ? 'late' : ($days <= 30 ? 'soon' : 'ok') }}">
                                            <a href="{{ route('projet.voirprojet',$p->id) }}">
                                                {{ $days < 0 ? 'Retard '.abs($days).' j' : $days.' j restants' }}
                                            </a>
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                            <td>
    <button class="btn-inline" onclick="openModal({{ $p->id }})">Détails</button>
</td>

                            </tr>
                        @empty
                            <tr><td colspan="10" style="text-align:center;color:#6b7280">Aucun projet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

</div> {{-- end page-container --}}

{{-- ================= PROJECTS ARRAY FOR MODAL ================= --}}
<script>
const projects = [
@foreach($projetsFN as $type)
    @foreach($type as $p)
        {
            id: {{ $p->id }},
            designation: @json($p->designation),
            finance: @json($p->finance),
            montantAlloue: @json($p->montantAlloue),
            montantEC: @json($p->montantEC),
            montantPC: @json($p->montantPC),
            tauxA: @json($p->tauxA),
            etatPhysique: @json($p->etatPhysique),
            odsRealisation: @json($p->odsRealisation),
            dateReception: @json($p->dateReception),
            observation: @json($p->observation),
        },
    @endforeach
@endforeach
];
</script>

{{-- ================= MODAL ================= --}}
<div id="projectModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Détails du projet</h3>
            <button onclick="closeModal()">✕</button>
        </div>
        <div class="modal-body" id="modalContent"></div>
    </div>
</div>

{{-- ================= JS ================= --}}
<script>
// TAB SWITCH
document.querySelectorAll('.tab-btn').forEach(btn=>{
    btn.addEventListener('click',()=>{
        document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c=>c.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById(btn.dataset.tab).classList.add('active');
    });
});

// MODAL
function openModal(id){
    const p = projects.find(pr => pr.id === id);
    if(!p){ alert('Projet introuvable'); return; }
    document.getElementById('modalContent').innerHTML = `
        <div class="modal-item"><span>Désignation</span>${p.designation}</div>
        <div class="modal-item"><span>Financement</span>${p.finance}</div>
        <div class="modal-item"><span>Montant alloué</span>${p.montantAlloue}</div>
        <div class="modal-item"><span>Montant engagé</span>${p.montantEC}</div>
        <div class="modal-item"><span>Montant payé</span>${p.montantPC}</div>
        <div class="modal-item"><span>Taux d’avancement</span>${p.tauxA}%</div>
        <div class="modal-item"><span>État physique</span>${p.etatPhysique}</div>
        <div class="modal-item"><span>ODS réalisation</span>${p.odsRealisation ?? '-'}</div>
        <div class="modal-item"><span>Date réception</span>${p.dateReception ?? '-'}</div>
        <div class="modal-item"><span>Observation</span>${p.observation ?? '-'}</div>
    `;
    document.getElementById('projectModal').style.display = 'flex';
}
function closeModal(){
    document.getElementById('projectModal').style.display = 'none';
}

// FILTER CHANGE
$(".select-filtre").change(function() {
    var w = $('#wilaya').val() ?? '{{$id}}';
    var f = $('#finance').val();
    var y = $('#year').val();
    location.href = "/projet/gestionprojets/"+w+"/"+f+"/"+y;
});
</script>

<script>
function printAllProjects() {

    // hide filters / buttons
    document.querySelectorAll('.filter-bar, .tabs-pro, .header-actions').forEach(el => {
        el.style.display = 'none';
    });

    // show ALL tab contents
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('active');
        tab.style.display = 'block';
    });

    // add header (same spirit as old version)
    const header = document.createElement('div');
    header.id = 'print-header';
    header.innerHTML = `
        <div style="margin-bottom:30px">
            <img src="{{ asset('img/logo-head.png') }}" width="200">
            <h3 style="margin-top:10px">
                Liste des projets – Année {{ $year }}
            </h3>
        </div>
    `;
    document.querySelector('.page-container').prepend(header);

    window.print();

    // restore page
    location.reload();
}
</script>
<script>
document.getElementById('select-recap')?.addEventListener('change', function () {
    const recap = this.value;
    const year  = document.getElementById('year').value;
    const wilaya = document.getElementById('wilaya')?.value ?? '{{ auth()->id() }}';

    if (recap === 'DUPW') {
        window.location.href = `/projet/gestionprojets/${wilaya}/tout/${year}`;
    } else {
        window.location.href = `/projet/recaps/${recap}/tout/${year}`;
    }
});
</script>

@endsection
