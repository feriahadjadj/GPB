@extends('layouts.poste')

@section('content')

<style type="text/css">
    /* Specific mapael css class are below
     * 'mapael' class is added by plugin
    */

    .mapael .map {
        position: relative;
    }

    .mapael .mapTooltip {
        position: absolute;
        background-color: #fff;
        /* moz-opacity: 0.70;
        opacity: 0.70;
        filter: alpha(opacity=70); */
        border: #ddd solid 1px;
        border-radius: 10px;
        padding: 10px;
        z-index: 1000;
        max-width: 200px;
        display: none;
        color: #343434;
    }
 /* ================= KPI SECTION ================= */
.kpi-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 22px 24px;
    border-radius: 12px;
    color: #333; /* text color */
    min-height: 120px;
    box-shadow: 0 6px 16px rgba(0,0,0,.08);
    position: relative;
    overflow: hidden;
    border-right: 6px solid transparent; /* Right border stripe */
    transition: transform .2s ease, box-shadow .2s ease;
}

.kpi-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px rgba(0,0,0,.12);
}

.kpi-title {
    font-size: 14px;
    font-weight: 500;
    opacity: .8;
    margin-bottom: 6px;
}

.kpi-value {
    font-size: 32px;
    font-weight: 700;
    line-height: 1;
}

.kpi-icon {
    font-size: 40px;
    opacity: .2;
}

/* Right border + light background colors */
.kpi-primary {
    border-right-color: #0068FE; /* Blue stripe */
    background: #e6f0ff; /* Very light blue background */
    color: #004ebf; /* text darker blue */
}

.kpi-success {
    border-right-color: #16a34a; /* Green stripe */
    background: #e6f9ed; /* Very light green background */
    color: #04732b; /* darker green text */
}

.kpi-warning {
    border-right-color: #f59e0b; /* Orange/Yellow stripe */
    background: #fff7e6; /* Very light yellow background */
    color: #b36b00; /* darker orange text */
}

.kpi-info {
    border-right-color: #0284c7; /* Cyan stripe */
    background: #e6f7ff; /* Very light cyan background */
    color: #02668f; /* darker cyan text */
}

/* Optional subtle hover highlight */
.kpi-card::after {
    content: "";
    position: absolute;
    right: -20px;
    top: -20px;
    width: 100px;
    height: 100px;
    background: rgba(0,0,0,.02);
    border-radius: 50%;
}
.dashboard-header {
    padding: 16px 24px;
    border-bottom: 1px solid #e0e0e0; /* subtle separation line */
    margin-bottom: 20px;
}

.dashboard-title {
    font-size: 28px;
    font-weight: 700;
    color: #222;
}

.dashboard-title .text-muted {
    font-weight: 500;
    font-size: 20px;
    color: #6c757d; /* soft gray for subtitle */
    margin-left: 8px;
}



/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .kpi-card {
        margin-bottom: 16px;
    }
    .kpi-value {
        font-size: 28px;
    }
    .kpi-icon {
        font-size: 38px;
    }
}
</style>

@can('edit-projet')

<a href="{{url()->previous()}}" class="btn back"><i class="fas fa-arrow-circle-left"></i></a>






<div class="row justify-content-center">


 <section class="features-icons col-md-6   text-center">
    <div class="container accueil">
      <div class="row justify-content-center">
        @can('manage-users')
        <div class="col-lg-6">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <a href="{{ route('admin.users.index') }}" >
            <div class="features-icons-icon d-flex">
              <i class="icon-people m-auto text-primary"> </i>
            </div>
          </a>
            <h3>Gestion des utilisateurs</h3>
            <p class="lead mb-0">Gerez vos utilisateurs</p>

          </div>
        </div>
        @endcan


         <div class="col-lg-6">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <a href="{{ route('projet.gestionprojets',['id'=>Auth::user()->id,'finance'=>'tout','year'=>Carbon\Carbon::today()->year]) }}" >
            <div class="features-icons-icon d-flex">
              <i class="icon-note m-auto text-primary"></i>
            </div>
            </a>
            <h3>Gestion des projet</h3>
            <p class="lead mb-0">Gerez vos projets </p>
          </div>
        </div>

      </div>
    </div>
  </section>
  @can('upw-role')

  <section class=" col-md-6  section-chart">
      <div class="form-inline" style="display: flex">
        <div class="form-group " style="margin: 0 0 auto auto ">
            <label for="wilaya" > <strong>Wilaya</strong>  </label>
           <select name="wilaya" id="wilaya" class="wilaya form-control ">

               @foreach (App\User::all() as $user) @if($user->roles->contains('name','user'))

               <option value="{{$user->id}}">{{$user->name}}</option>
               @endif @endforeach

           </select>

          </div>
      </div>

              <div class="d-card ">
                  <div class=" dashboard-card card-padding full-height" style="padding: 30px">


                  <canvas id="doughnut-chart" width="400" height="225"></canvas>


              </div>
              </div>

    </section>



@endcan
</div>
@endcan
  <!--  chart section -->

  @can('show-statistics')
  <!-- Dashboard Title Section -->
<div class="dashboard-header mb-4">
    <h2 class="dashboard-title">Tableau de Bord<span class="text-muted"></h2>
</div>

 <!-- KPI Cards Row -->
<div class="row g-3 mb-3">
   <div class="col-12 col-md-3">
    <div class="kpi-card kpi-primary">
        <div>
            <div class="kpi-title">Total Projets</div>
<div class="kpi-value">
                    {{ \App\Projet::where(function($q) { 
                        $q->whereYear('dateMiseEnOeuvre', date('Y'))
                          ->orWhereNull('dateMiseEnOeuvre'); 
                    })->count() }}
                </div>        </div>
        <i class="fas fa-project-diagram kpi-icon"></i>
    </div>
</div>

<div class="col-12 col-md-3">
    <div class="kpi-card kpi-success">
        <div>
            <div class="kpi-title">Projets Achevés</div>
 <div class="kpi-value">
                    {{ \App\Projet::where('etatPhysique', 'R')
                        ->where(function($q) {
                            $q->whereYear('dateMiseEnOeuvre', date('Y'))
                              ->orWhereNull('dateMiseEnOeuvre');
                        })->count() }}
                </div>        </div>
        <i class="fas fa-check-circle kpi-icon"></i>
    </div>
</div>

<div class="col-12 col-md-3">
    <div class="kpi-card kpi-warning">
        <div>
            <div class="kpi-title">Projets en Réalisation</div>
<div class="kpi-value">
                    {{ \App\Projet::where('etatPhysique', 'E')
                        ->where(function($q) {
                            $q->whereYear('dateMiseEnOeuvre', date('Y'))
                              ->orWhereNull('dateMiseEnOeuvre');
                        })->count() }}
                </div>        </div>
        <i class="fas fa-spinner kpi-icon"></i>
    </div>
</div>

<div class="col-12 col-md-3">
    <div class="kpi-card kpi-info">
        <div>
            <div class="kpi-title">Utilisateurs</div>
            <div class="kpi-value">{{ App\User::count() }}</div>
        </div>
        <i class="fas fa-users kpi-icon"></i>
    </div>
</div>

</div>

<!-- Filters Row -->
<div class="row g-3 mb-3 align-items-end">
    <div class="col-12 col-md-6 col-lg-3">
        <label for="wilaya"><strong>Wilaya</strong></label>
        <select name="wilaya" id="wilaya" class="form-control">
            <option value="all">Tous les UPWs</option>
            @foreach (App\User::all() as $user)
                @if($user->roles->contains('name','user'))
                    <option value="{{$user->id}}" @if($user->id==$id) selected @endif>{{$user->name}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <label for="year"><strong>Année</strong></label>
        <select name="year" id="year" class="form-control">
            @for ($i = (int) Carbon\Carbon::today()->year; $i > (int) Carbon\Carbon::today()->year - 5; $i--)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
    </div>
</div>

<!-- First Row: Stacked Bar Chart + Pie Chart -->
<div class="row g-3 mb-3">
    <div class="col-12 col-md-6">
        <div class="dashboard-card p-3 rounded" style="min-height: 350px; background: #f8f9fa;">
            <canvas id="mychart" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="dashboard-card p-3 rounded" style="min-height: 350px; background: #f8f9fa;">
            <canvas id="doughnut-chart" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>
</div>

<!-- Second Row: Map + Legend + Trending Bar Chart -->
<div class="row g-3 mb-3">


    <div class="col-12 col-md-12">
        <div class="dashboard-card p-3 rounded" style="min-height: 350px; background: #f8f9fa;">
            <canvas id="trending-bar-chart" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>
</div>

<!-- Third Row: Table Full Width -->
<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="dashboard-card p-3 rounded" style="min-height: 400px; background: #f8f9fa;">
            <div class="text-center mb-4">
                <h4>Projets par nature et phase d'avancement</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Phase d'avancement</th>
                            <th>Construction</th>
                            <th>Réhabilitation</th>
                            <th>Aménagement</th>
                            <th>Etanchéité</th>
                            <th>Logement d'astreinte</th>
                            <th>Total projets</th>
                            <th>Taux</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($table as $key=>$r)
                        <tr>
                            <td>{{$r['text']}}</td>
                            @foreach ($r as $i=>$n)
                                @if($i!='text' && $i!='total' && $i!='taux')
                                    <td>{{$n}}</td>
                                @endif
                            @endforeach
                            <td>{{$r['total']}}</td>
                            <td style="white-space: nowrap">{{$r['taux']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endcan
<script>
    var w={!! json_encode($map)!!};
</script>
<script src="{{asset('js/map/raphael.min.js')}}" charset="utf-8"></script>
<script src="{{asset('js/map/jquery.mousewheel.min.js')}}" charset="utf-8"></script>
<script src="{{asset('js/map/jquery.mapael.js')}}" charset="utf-8"></script>
<script src="{{asset('js/map/algeria.js')}}" charset="utf-8"></script>
<script src="{{asset('js/map/france_departments.js')}}" charset="utf-8"></script>


<script type="text/javascript">
$(".mapcontainer").mapael({
    map: {
        name: "algeria_map",
        defaultPlot: {
            size: 10,
            attrs: {
                fill: "#4D95FE",
                stroke: "#fff",
                "stroke-width": 1,
                cursor: "pointer",
                filter: "drop-shadow(0 2px 6px rgba(0,0,0,0.15))"
            },
            attrsHover: {
                fill: "#0068FE",
                stroke: "#fff",
                "stroke-width": 2,
                opacity: 0.9
            },
            text: {
                attrs: {
                    fill: "#111827",
                    "font-weight": "bold"
                }
            }
        },
        defaultArea: {
            attrs: {
                stroke: "#fff",
                "stroke-width": 1,
                fill: "#edf2fb",
                opacity: 0.9,
                transition: "all 0.4s ease"
            },
            attrsHover: {
                fill: "#a3c4ff",
                opacity: 1,
                "stroke-width": 2,
                cursor: "pointer",
                transform: "scale(1.05)",
                transition: "all 0.4s ease"
            },
            eventHandlers: {
                click: function(e, id, mapElem, textElem, elemOptions) {
                    Swal.fire({
                        title: `Wilaya: ${id}`,
                        html: `<strong>Projets achevés:</strong> ${w[id] || 0}`,
                        icon: 'info',
                        confirmButtonColor: '#0068FE'
                    });
                }
            }
        }
    },
    legend: {
        area: {
            title: "Projets achevés par wilaya",
            slices: [
                { max: 3, attrs: { fill: "#d0e6ff" }, label: "Moins de 3 projets" },
                { min: 3, max: 10, attrs: { fill: "#80bfff" }, label: "3 à 10 projets" },
                { min: 10, max: 15, attrs: { fill: "#3399ff" }, label: "10 à 15 projets" },
                { min: 15, attrs: { fill: "#0052cc" }, label: "Plus de 15 projets" }
            ]
        }
    },
    areas: a,
    zoom: {
        enabled: true,
        step: 0.2,
        maxLevel: 2,
        mousewheel: true
    },
    plots: {},
    tooltip: {
        css: {
            "background-color": "#fff",
            color: "#111827",
            padding: "10px 15px",
            "border-radius": "10px",
            "box-shadow": "0 8px 20px rgba(0,0,0,0.2)",
            "font-weight": "500",
            "font-family": "Nunito, sans-serif"
        },
        delay: 80,
        content: function (data) {
            if (!data || !data.id) return "";
            let count = w[data.id] || 0;
            return `<div style="font-size:14px;"><strong>${data.id}</strong><br/>Projets achevés: <span style="color:#0068FE;font-weight:600;">${count}</span></div>`;
        }
    }
});

// Add subtle pulse animation for wilaya with projects > 10
$.each(a, function(id, area) {
    if (w[id] > 10) {
        let $el = $(".mapcontainer").find(`#${id}`);
        $el.css({ "transform-origin": "center center" });
        setInterval(function(){
            $el.animate({ transform: "scale(1.05)" }, 600)
               .animate({ transform: "scale(1)" }, 600);
        }, 1500);
    }
});
</script>




<script>
Chart.defaults.font.family = "Nunito, sans-serif";
Chart.defaults.font.size = 14;

Chart.register({
    id: 'emptyChartOverlay',
    afterDraw: function(chart) {
        let allZero = true;
        chart.data.datasets.forEach(dataset => {
            if (!dataset.data.every(item => item === 0)) {
                allZero = false;
            }
        });

        if (allZero) {
            const ctx = chart.ctx;
            const width = chart.width;
            const height = chart.height;

            // Semi-transparent overlay
            ctx.save();
            ctx.fillStyle = 'rgba(255,255,255,0.85)';
            ctx.fillRect(0, 0, width, height);

            // Shadowed title
            ctx.fillStyle = '#333';
            ctx.font = 'bold 20px Nunito';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.shadowColor = 'rgba(0,0,0,0.15)';
            ctx.shadowBlur = 8;
            ctx.fillText(chart.options.plugins.title.text || "Aucune donnée", width/2, height/2 - 20);

            // Subtext
            ctx.font = '16px Nunito';
            ctx.fillStyle = '#666';
            ctx.shadowBlur = 0;
            ctx.fillText("Les données ne sont pas disponibles pour cette sélection", width/2, height/2 + 20);

            ctx.restore();
        }
    }
});
</script>
<script>
$(document).ready(function(){

    // Filter handling
    $("#wilaya").val('{{$id}}');
    $("#year").val('{{$year}}');
    $("select.wilaya, #year").change(function(){
        var selectedUpw = $("#wilaya").val();
        var yy = $("#year").val();
        location.href = "{{ route('home') }}" + "?id=" + selectedUpw + "&year=" + yy;
    });

    // Soft/pastel gradient palette
    const pastelColors = [
        '#A8D5BA', // soft green
        '#FFE1A8', // soft yellow
        '#A8CFE2', // soft blue
        '#F4B6C2', // soft pink
        '#D3C4F3'  // soft purple
    ];

    const dataValues = {!! json_encode(array_values($etats)) !!};
    const ctx = document.getElementById("doughnut-chart").getContext("2d");

    const softDoughnut = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Études", "Procédures", "Réalisation", "Non-Lancés", "Achevés"],
            datasets: [{
                data: dataValues,
                backgroundColor: pastelColors,
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 20,
                borderRadius: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            animation: {
                animateRotate: true,
                animateScale: true,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 15,
                        font: {
                            family: 'Nunito',
                            size: 13,
                            weight: '500',
                            color: '#333'
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0,0,0,0.7)',
                    titleFont: { family: 'Nunito', size: 14, weight: '600' },
                    bodyFont: { family: 'Nunito', size: 13 },
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(tooltipItem) {
                            const value = tooltipItem.raw;
                            const total = tooltipItem.chart._metasets[tooltipItem.datasetIndex].total;
                            const percent = ((value / total) * 100).toFixed(1);
                            return `${tooltipItem.label}: ${value} (${percent}%)`;
                        }
                    }
                },
                title: {
                    display: true,
                    text: "Projets par phase d'avancement",
                    font: {
                        family: "Nunito",
                        size: 18,
                        weight: "600"
                    },
                    color: "#333",
                    padding: { top: 15, bottom: 20 }
                }
            }
        }
    });

});
</script>

<script>
new Chart(document.getElementById("trending-bar-chart"), {
                type: 'bar',
                data: {
                  labels: {!! json_encode(array_keys($month)) !!},
                  datasets: [
                    {
                      label: "Nombre de projets",
                      backgroundColor:"#9381ff",
                      data: {!! json_encode(array_values($bar)) !!}
                    }
                  ]
                },


                options: {
                  maintainAspectRatio:false,
                  legend:{
                    defaultFontFamily:"Nunito,sans-serif"
                },
                  title: {
                    display: true
                    ,
                     text: 'Projets achevés par mois'
                     ,
                     fontSize: 18
                  }
                }
            });


  </script>
<script>
var ctx = document.getElementById("mychart").getContext('2d');

// Create gradient fills
var gradientAcheve = ctx.createLinearGradient(0, 0, 0, 400);
gradientAcheve.addColorStop(0, '#4D95FE'); // primary-light
gradientAcheve.addColorStop(1, '#0068FE'); // primary

var gradientRealisation = ctx.createLinearGradient(0, 0, 0, 400);
gradientRealisation.addColorStop(0, '#FDC90A'); // secondary
gradientRealisation.addColorStop(1, '#FFD84D'); // lighter secondary

var gradientNonLance = ctx.createLinearGradient(0, 0, 0, 400);
gradientNonLance.addColorStop(0, '#DEE2E6'); // grey-300
gradientNonLance.addColorStop(1, '#E9ECEF'); // grey-200

var data = [{
    label: 'Achevé',
    backgroundColor: gradientAcheve,
    data: {!! json_encode(array_values($ratio['A'])) !!}
}, {
    label: 'Réalisation',
    backgroundColor: gradientRealisation,
    data: {!! json_encode(array_values($ratio['R'])) !!}
}, {
    label: 'Non-Lancé',
    backgroundColor: gradientNonLance,
    data: {!! json_encode(array_values($ratio['NL'])) !!}
}];

var options = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
        display: true,
        position: 'bottom',
        labels: {
            fontColor: "#212529", // grey-800 for modern look
            boxWidth: 24,
            fontFamily: 'Nunito, sans-serif'
        }
    },
    title: {
        display: true,
        text: 'Projets par nature et phase d\'avancement',
        fontSize: 18,
        fontColor: '#212529' // grey-800
    },
    tooltips: {
        mode: 'index',
        intersect: false,
        backgroundColor: '#343A40', // grey-700 dark tooltip
        titleFontColor: '#fff',
        bodyFontColor: '#fff',
        callbacks: {
            label: function(tooltipItem, data) {
                var type = data.datasets[tooltipItem.datasetIndex].label;
                var value = parseInt(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]);
                var total = data.datasets.reduce((sum, ds) => sum + parseInt(ds.data[tooltipItem.index]), 0);
                var percentage = ((value / total) * 100).toFixed(1);
                return type + " : " + value + " - " + percentage + " %";
            }
        }
    },
    scales: {
        xAxes: [{
            stacked: true,
            gridLines: { display: true, color: '#DEE2E6' }, // grey-300
            ticks: { fontColor: "#495057" } // grey-600
        }],
        yAxes: [{
            stacked: true,
            gridLines: { display: true, color: '#DEE2E6' }, // grey-300
            ticks: { fontColor: "#495057" } // grey-600
        }]
    }
};

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($ratio['A'])) !!},
        datasets: data
    },
    options: options
});

</script>

  <script>
  $('.map svg:first-child').attr('height','620px');


  </script>
@endsection
