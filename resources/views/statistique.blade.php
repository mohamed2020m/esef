@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid mb-3"> 
  <div class="d-flex flex-wrap justify-content-around mb-4">
    <div class="mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="d-flex">
            <div class="mx-3">
              <div class="numbers">
                <p class="text-sm mb-0 font-weight-bold">Nombre des Filières</p>
                <div class="font-weight-bolder text-center mb-0" style="font-size:25px">
                    {{$nombre_filieres}}
                </div>
              </div>
            </div>
            <div class="mx-3 text-end">
              <div class="icon icon-shape text-center border-radius-md text-white" style="background-color:#0f233a">
                <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="d-flex">
            <div class="mx-3">
              <div class="numbers">
                <p class="text-sm mb-0 font-weight-bold">Nombre des Candidatures</p>
                <div class="font-weight-bolder text-center mb-0" style="font-size:25px">
                  {{$nombre_candidats_inscrits}}
                </div>
              </div>
            </div>
            <div class="mx-3 text-end">
              <div class="icon icon-shape text-center border-radius-md text-white" style="background-color:#0f233a">
                <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="d-flex flex-column justify-content-center mt-4">
    <div class="flex-grow-1  mb-4">
      <div class="card z-index-2">
        <div class="card-body p-3">
          <div class="border-radius-lg py-3 pe-1 mb-3">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="400"></canvas>
            </div>
          </div> 
        </div>
      </div>
    </div>
    <div class="flex-grow-1 mb">
      <div class="card z-index-2">
        <div class="card-body p-3">
          <div>
            <select class="form-select form-select-lg" id="month"
                style="border-color:#0f233a !important; box-shadow:none !important" aria-label="Default select example" name="mois" required>
                <option disabled selected>Le mois En Cours</option>
                <option value="1">Janvier</option>
                <option value="2">Février</option>
                <option value="3">Mars</option>
                <option value="4">Avril</option>
                <option value="5">Mai</option>
                <option value="6">Juin</option>
                <option value="7">Juillet</option>
                <option value="8">Août</option>
                <option value="9">Septembre</option>
                <option value="10">Octobre</option>
                <option value="11">Novembre</option>
                <option value="12">Décembre</option>
            </select>
          </div>
          <div class="border-radius-lg py-3 pe-1 mb-3">
            <div class="chart" id="chart_line">
              <canvas id="chart-line" class="chart-canvas" height="400"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection


@push('dashboard')
<script>
  
  let noms_filieres = {!! json_encode($names, JSON_HEX_TAG) !!};
  let nombre_filieres = {!! json_encode($nombre_candidat_par_filiere, JSON_HEX_TAG) !!};
  let backgroundColorArr = [
    'rgba(255, 99, 132)',
    'rgba(255, 159, 64)',
    'rgba(255, 205, 86)',
    'rgba(75, 192, 192)',
    'rgba(54, 162, 235)',
    'rgba(153, 102, 255)'
  ];
  // generating colors:
  for(let i = 0; i< noms_filieres.length - 6 ;i++){
    let R = Math.round(Math.random() * 255);
    let G = Math.round(Math.random() * 255);
    let B = Math.round(Math.random() * 255); 
    backgroundColorArr.push(`rgba(${R}, ${G}, ${B})`)
  }

  window.onload = function() {
    var ctx = document.getElementById("chart-bars").getContext("2d");
    new Chart(ctx, {
      type: "bar",
      data: {
        
        labels: noms_filieres,
        datasets: [{
          // label: "Nombre des candidats",
          data: nombre_filieres,
          backgroundColor: backgroundColorArr,
          borderColor: backgroundColorArr,
          // maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animations: {
          tension: {
            duration: 1200,
            easing: 'linear',
          }
        },
        plugins: {
          legend: {
            display: false
          },
          title: {
              display: true,
              text: 'Nombre des candidats par filière',
              font: {
                size: 18
              }
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: true,
              display: true,
              drawOnChartArea: true,
              drawTicks: true,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Open Sans",
                style: 'normal',
              },
            },
            title:{
              display:true,
              text:'Nombre des candidats'
            }
          },
          x: {
            grid: {
              drawBorder: true,
              display: true,
              drawOnChartArea: true,
              drawTicks: true
            },
            ticks: {
            },
            title:{
              display:true,
              text:'Les Filières'
            }
          },
        },
      },
    });

    $("#month").on('change',function(){ 
        $('#chart-line').remove();
        $('#chart_line').append('<canvas id="chart-line" class="chart-canvas" height="400"></canvas>');
        var myChart;
        let month_id= $(this).val();
        $.ajax({
            type:'get',
            url:'{{URL::to("NumberOfCandidatePerMonth")}}',
            data:{'id':month_id},
            success: function(data){
              var ctx2 = document.getElementById("chart-line").getContext("2d");
              var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
              new Chart(ctx2, {
                type: "line",
                data: {
                  labels: data[0],
                  datasets: [{
                      label: "Nombre d'utilisateurs rejoints",
                      tension: 0.4,
                      borderWidth: 0,
                      pointRadius: 0,
                      borderColor: "#0f233a",
                      borderWidth: 2,
                      fill: true,
                      data: data[1],
                      maxBarThickness: 3
                    }
                  ],
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      display: false
                    },
                    title: {
                      display: true,
                      text: 'Nombre des candidats inscrits par jour',
                      font: {
                        size: 18
                      }
                    }
                  },
                  interaction: {
                    intersect: false,
                    mode: 'index',
                  },
                  scales: {
                    y: {
                      grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                      },
                      ticks: {
                        display: true,
                        padding: 20,
                        color: '#b2b9bf',
                        font: {
                          size: 11,
                          family: "Open Sans",
                          style: 'normal',
                          lineHeight: 2
                        },
                      },
                      title:{
                        display:true,
                        text:'Nombre des candidats'
                      }
                    },
                    x: {
                      grid: {
                        drawBorder: true,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: true,
                      },
                      ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                          size: 11,
                          family: "Open Sans",
                          style: 'normal',
                          lineHeight: 2
                        },
                      },
                      title:{
                        display:true,
                        text:'Les jours du mois'
                      }
                    },
                  },
                },
              });
            },
            error:function(err){
                console.log(err.statusText)
            }
        });
    });

    // on reload the page get the current month
    $(window).on('load',function(){ 
        $.ajax({
            type:'get',
            url:'{{URL::to("NumberOfCandidateCurrentMonth")}}',
            success: function(data){
              var ctx2 = document.getElementById("chart-line").getContext("2d");
              var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
              new Chart(ctx2, {
                type: "line",
                data: {
                  labels: data[0],
                  datasets: [{
                      label: "Nombre d'utilisateurs rejoints",
                      tension: 0.4,
                      borderWidth: 0,
                      pointRadius: 0,
                      borderColor: "#0f233a",
                      borderWidth: 2,
                      fill: true,
                      data: data[1],
                      maxBarThickness: 3
                    }
                  ],
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      display: false
                    },
                    title: {
                      display: true,
                      text: 'Nombre des candidats inscrits par jour',
                      font: {
                        size: 18
                      }
                    }
                  },
                  interaction: {
                    intersect: false,
                    mode: 'index',
                  },
                  scales: {
                    y: {
                      grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                      },
                      ticks: {
                        display: true,
                        padding: 20,
                        color: '#b2b9bf',
                        font: {
                          size: 11,
                          family: "Open Sans",
                          style: 'normal',
                          lineHeight: 2
                        },
                      },
                      title:{
                        display:true,
                        text:'Nombre des candidats'
                      }
                    },
                    x: {
                      grid: {
                        drawBorder: true,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: true,
                      },
                      ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                          size: 11,
                          family: "Open Sans",
                          style: 'normal',
                          lineHeight: 2
                        },
                      },
                      title:{
                        display:true,
                        text:'Les jours du mois'
                      }
                    },
                  },
                },
              });
            },
            error:function(err){
                console.log(err.statusText)
            }
        });
    }); 
  }
</script> 
@endpush

