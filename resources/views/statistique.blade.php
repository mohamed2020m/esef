@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid"> 
  <div class="d-flex flex-wrap justify-content-around">
    <div class="mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="d-flex">
            <div class="mx-3">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Nombre des Filières</p>
                <div class="font-weight-bolder text-center mb-0" style="font-size:25px">
                    4
                </div>
              </div>
            </div>
            <div class="mx-3 text-end">
              <div class="icon icon-shape text-center border-radius-md text-white" style="background-color:#0f233a">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
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
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Nombre des Candidats</p>
                <div class="font-weight-bolder text-center mb-0" style="font-size:25px">
                    250
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
  
  <div class="d-flex justify-content-center mt-4">
    <div class="flex-grow-1">
      <div class="card z-index-2">
        <div class="card-header pb-0">
          <h6>Nombre des candidats par rapport au nombre des filières</h6>
          <!-- <p class="text-sm">
            <span class="font-weight-bold">Nombre des Candidats</span>
          </p> -->
        </div>
        <div class="card-body p-3">
          <div class="d-flex">
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
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
  window.onload = function() {
    let ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); 

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)');

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

          },
          {
            label: "Websites",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
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
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
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
            }
          },
        },
      },
    });

  //   new Chart(ctx, {
  //         type: 'bar',
  //         data: {
  //             labels: ['SEP', 'SES - Anglaise', 'SES - sc.Ind', 'SES - Mathématique'],
  //             datasets: [{
  //                 label: 'Nombre des candidat',
  //                 data: [52, 19, 30, 50, 20, 23],
  //                 backgroundColor: [
  //                     ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"]
  //                 ],
  //                 borderColor: [
  //                     'rgba(255, 99, 132, 1)',
  //                     'rgba(54, 162, 235, 1)',
  //                     'rgba(255, 206, 86, 1)',
  //                     'rgba(75, 192, 192, 1)',
  //                     'rgba(153, 102, 255, 1)',
  //                     'rgba(255, 159, 64, 1)'
  //                 ],
  //                 borderWidth: 1
  //             }]
  //         },
  //         options: {
  //             scales: {
  //                 y: {
  //                   beginAtZero: true
  //                 }
  //             }
  //         }
  //     });
  // }
</script>
@endpush
