@extends('layouts.facile_master')
@section('content')

<div class="main--content dashboardpage" id="app">
    <h3 class="main--content__title">Dashboard</h3>
    <small class="main--content__desc">Here are dashboard layout for you to choose</small>
    
    <div class="grid flex">
      <div class="span3">
        <div class="card dashboard-card">
          <div class="card--content card--bg text-white grad-orange">
            <div class="flex vcenter between">
              <h6 class="bold card--title margin0">CARD TITLE</h6>
              <div class="dropdown-check">
                <input type="checkbox" class="arrow" id="grid-1">
                <label for="grid-1">Actions</label>
                <ul class="dropdown-menu">
                  <li><a href="#"><small class="medium">Setting</small></a></li>
                  <li><a href="#"><small class="medium">Close</small></a></li>
                </ul>
              </div>
            </div>
            <h1 class="bold margin0 right-align">250K</h1>
            <div class="dashboard-card-bottom flex vend between">
              <i class="ico-stats"></i>
              <a href="#" class="">more <i class="ico-arrowright"></i></a> 
            </div>
          </div>
        </div>  
      </div>
      <div class="span3">
        <div class="card dashboard-card">
          <div class="card--content card--bg">
            <div class="flex vcenter between">
              <h6 class="bold card--title margin0">CARD TITLE</h6>
              <div class="dropdown-check">
                <input type="checkbox" class="arrow" id="grid-2">
                <label for="grid-2">Actions</label>
                <ul class="dropdown-menu">
                  <li><a href="#"><small class="medium">Setting</small></a></li>
                  <li><a href="#"><small class="medium">Close</small></a></li>
                </ul>
              </div>
            </div>
            <h1 class="bold margin0 right-align">1200K</h1>
            <div class="dashboard-card-bottom flex vend between">
              <i class="ico-bag"></i>
              <a href="#" class="">more <i class="ico-arrowright-orange"></i></a> 
            </div>
          </div>
        </div>  
      </div>
      <div class="span3">
        <div class="card dashboard-card">
          <div class="card--content card--bg text-white grad-aquablue">
            <div class="flex vcenter between">
              <h6 class="bold card--title margin0">CARD TITLE</h6>
              <div class="dropdown-check">
                <input type="checkbox" class="arrow" id="grid-3">
                <label for="grid-3">Actions</label>
                <ul class="dropdown-menu">
                  <li><a href="#"><small class="medium">Setting</small></a></li>
                  <li><a href="#"><small class="medium">Close</small></a></li>
                </ul>
              </div>
            </div>
            <h1 class="bold margin0 right-align">250K</h1>
            <div class="dashboard-card-bottom flex vend between">
              <i class="ico-speechbubble"></i>
              <a href="#" class="">more <i class="ico-arrowright"></i></a> 
            </div>
          </div>
        </div>  
      </div>
      <div class="span3">
        <div class="card dashboard-card">
          <div class="card--content card--bg text-white grad-green">
            <div class="flex vcenter between">
              <h6 class="bold card--title margin0">CARD TITLE</h6>
              <div class="dropdown-check">
                <input type="checkbox" class="arrow" id="grid-4">
                <label for="grid-4">Actions</label>
                <ul class="dropdown-menu">
                  <li><a href="#"><small class="medium">Setting</small></a></li>
                  <li><a href="#"><small class="medium">Close</small></a></li>
                </ul>
              </div>
            </div>
            <h1 class="bold margin0 right-align">5.4K</h1>
            <div class="dashboard-card-bottom flex vend between">
              <i class="ico-spedometer"></i>
              <a href="#" class="">more <i class="ico-arrowright"></i></a> 
            </div>
          </div>
        </div>  
      </div>
    </div>
    <div class="grid flex">
      <div class="span9">
            <div class="card">
                <div class="card--content card--bg">
                    <div class="flex vcenter between">
                        <h6 class="bold card--title margin0">CARD TITLE</h6>
                        <div class="dropdown-check">
                            <input type="checkbox" class="arrow" id="grid-9">
                            <label for="grid-9">Actions</label>
                            <ul class="dropdown-menu">
                                <li><a href="#"><small class="medium">Setting</small></a></li>
                                <li><a href="#"><small class="medium">Close</small></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="chart">
                        <canvas id="line-1"></canvas>
                    </div>
                </div>
            </div>  
        </div>
        <div class="span3">
            <div class="card dashboard-card dashboard-weather">
               <div class="card--content card--bg-img text-white" style="background-image:url('{{Theme::url('images/thumb/bg-card-facile.jpg')}}');">
               <h6 class="bold card--title margin0">CARD TITLE</h6>
               <h1 class="center-align margin0 light">39&deg;</h1>
               <div class="dashboard-card-bottom flex vend right">
                <a href="#" class="">more <i class="ico-arrowright"></i></a> 
            </div>
            </div>
            </div>  
        </div>
    </div>
    <div class="grid flex">
      <div class="span6">
        <div class="card">
          <div class="card--content">
            <h6 class="bold card--title margin0">LINE CHART 3</h6>
            <div id="line-2-legend" class="chart-legend flex right"></div>
            <div class="chart">
              <canvas id="line-2"></canvas>
            </div>
          </div>
        </div>  
      </div>
      <div class="span6">
        <div class="card">
          <div class="card--content">
            <h6 class="bold card--title margin0">LINE CHART 4</h6>
            <div id="point-1-legend" class="chart-legend flex right"></div>
            <div class="chart">
              <canvas id="point-1"></canvas>
            </div>
          </div>
        </div>  
      </div>
    </div>
    <div class="grid flex">
      <div class="span4">
        <div class="card dashboard-card">
          <div class="card--content card--bg text-white grad-orange">
            <div class="flex vcenter between">
              <h6 class="bold card--title margin0">TOTAL VISIT</h6>
              <div class="dropdown-check">
                <input type="checkbox" class="arrow" id="grid-5">
                <label for="grid-5">Actions</label>
                <ul class="dropdown-menu">
                  <li><a href="#"><small class="medium">Setting</small></a></li>
                  <li><a href="#"><small class="medium">Close</small></a></li>
                </ul>
              </div>
            </div>
            <h1 class="bold center-align">250K</h1>
            <div class="dashboard-card-bottom flex vend between">
              <i class="ico-bars"></i>
              <a href="#" class="">more <i class="ico-arrowright"></i></a> 
            </div>
          </div>
        </div>  
      </div>
      <div class="span4">
        <div class="card dashboard-card">
          <div class="card--content card--bg text-white grad-darkblue right-align">
            <h6>Science has not yet mastered prophecy.</h6>
            <h6>22 May, 2015 via mobile</h6>
            <small class="light">23 Mei 2017</small>
            <br>
            <div class="dashboard-card-bottom flex vend between">
              <i class="ico-questionmark"></i>
              <a href="#" class="">more <i class="ico-arrowright"></i></a> 
            </div>
          </div>
        </div>  
      </div>
      <div class="span4">
        <div class="card dashboard-card">
          <div class="card--content card--bg text-white grad-blue right-align">
            <h6>Science has not yet mastered prophecy.</h6>
            <h6>22 May, 2015 via mobile</h6>
            <small class="light">23 Mei 2017</small>
            <br>
            <div class="dashboard-card-bottom flex vend between">
              <i class="ico-questionmark"></i>
              <a href="#" class="">more <i class="ico-arrowright"></i></a> 
            </div>
          </div>
        </div>  
      </div>
    </div>
    <div class="grid flex">
      <div class="span8">
        <div class="card dashboard-card">
          <div class="card--content card--bg text-white grad-orange">
            <div class="flex vcenter between">
              <h6 class="bold card--title margin0">TOTAL VISIT</h6>
              <div class="dropdown-check">
                <input type="checkbox" class="arrow" id="grid-7">
                <label for="grid-7">Actions</label>
                <ul class="dropdown-menu">
                  <li><a href="#"><small class="medium">Setting</small></a></li>
                  <li><a href="#"><small class="medium">Close</small></a></li>
                </ul>
              </div>
            </div>
            <h1 class="bold right-align">250K</h1>
            <div class="dashboard-card-bottom flex vend between">
              <i class="ico-bars"></i>
              <a href="#" class="">more <i class="ico-arrowright"></i></a> 
            </div>
          </div>
        </div>  
      </div>
      <div class="span4">
        <div class="card dashboard-card">
          <div class="card--content card--bg text-white grad-green">
            <div class="flex vcenter between">
              <h6 class="bold card--title margin0">TOTAL VISIT</h6>
              <div class="dropdown-check">
                <input type="checkbox" class="arrow" id="grid-8">
                <label for="grid-8">Actions</label>
                <ul class="dropdown-menu">
                  <li><a href="#"><small class="medium">Setting</small></a></li>
                  <li><a href="#"><small class="medium">Close</small></a></li>
                </ul>
              </div>
            </div>
            <h1 class="bold right-align">250K</h1>
            <div class="dashboard-card-bottom flex vend between">
              <i class="ico-bars"></i>
              <a href="#" class="">more <i class="ico-arrowright"></i></a> 
            </div>
          </div>
        </div>  
      </div>
    </div>
    <div class="grid flex">
      <div class="span12">
        <div class="card">
          <div class="card--content">
            <h6 class="bold card--title margin0">LINE CHART 2</h6>
            <div id="line-3-legend" class="chart-legend flex right"></div>
            <div class="chart">
              <canvas id="line-3"></canvas>
            </div>
          </div>
        </div>  
      </div>
    </div>

@endsection

@section('js_script')
<script src="{{ elixir('js/facile_main.js', 'themes/admin')}}"></script>
<script>
window.onload = function() {
    
  // LINE 1
  var lineChartData1 = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
    datasets: [{
      label: 'Dataset 1',
      backgroundColor: "rgba(249,89,89,0.10)",
      pointBackgroundColor: "#fff",
      borderColor: '#F95959',
      borderWidth: 1,
      data: [2478,1267,734,784,433,1500,780,1200]
    }]

  };
  var line1 = document.getElementById("line-1");
  line1.style.height = '240px';
  var lineCanvas = line1.getContext("2d");
  var mainLine = new Chart(lineCanvas, {
    type: 'line',
    data: lineChartData1,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      title: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
            color: "#fff",
            offsetGridLines: false
          },
          ticks: {
              fontSize: 10
          }
        }],
        yAxes: [{
          ticks: {
              fontSize: 10
          }
        }]
      },
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 20,
          bottom: 0
        }
      }
    }
  });



  // LINE STACKED
  var lineChartData2 = {
    labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
    datasets: [{
      label: 'Dataset 1',
      backgroundColor: "rgba(249,89,89,0.25)",
      pointBackgroundColor: "#fff",
      borderColor: '#F95959',
      borderWidth: 1,
      data: [250,80,20,110,130,85,230]
    },{
      label: 'Dataset 2',
      backgroundColor: "rgba(255,172,146,0.20)",
      pointBackgroundColor: "#fff",
      borderColor: '#FFAC92',
      borderWidth: 1,
      data: [500,160,40,220,260,170,460]
    },{
      label: 'Dataset 3',
      backgroundColor: "rgba(171,37,37,0.20)",
      pointBackgroundColor: "#fff",
      borderColor: '#AB2525',
      borderWidth: 1,
      data: [750,240,60,330,390,255,690]
    }]

  };
  var line2 = document.getElementById("line-2");
  line2.style.height = '240px';
  var lineCanvas2 = line2.getContext("2d");
  var mainLine2 = new Chart(lineCanvas2, {
    type: 'line',
    data: lineChartData2,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      elements: {
        line: {
            tension: 0.000001
        }
      },
      legend: {
        display: false
      },
      title: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
            color: "#fff",
            offsetGridLines: false
          },
          ticks: {
              fontSize: 10
          }
        }],
        yAxes: [{
          stacked: true,
          ticks: {
              fontSize: 10
          }
        }]
      },
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 20,
          bottom: 0
        }
      },
      tooltips: {
        mode: 'x',
        intersect: true,
      },
      hover: {
        mode: 'x',
        intersect: true
      }
    }
  });
  document.getElementById('line-2-legend').innerHTML = mainLine2.generateLegend();


  // LINE 3
  var lineChartData3 = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
    datasets: [{
      label: 'Dataset 1',
      pointBackgroundColor: "#fff",
      pointHoverBackgroundColor: "#F95959",
      backgroundColor: '#F95959',
      borderColor: '#F95959',
      borderWidth: 1,
      data: [2478,1267,734,784,433,1500,780,1200],
      fill: false
    },{
      label: 'Dataset 2',
      pointBackgroundColor: "#fff",
      pointHoverBackgroundColor: "#FFAC92",
      backgroundColor: '#FFAC92',
      borderColor: '#FFAC92',
      borderWidth: 1,
      data: [1500,1700,500,1023,301,486,1200,2000],
      fill: false
    }]

  };
  var line3 = document.getElementById("line-3");
  line3.style.height = '240px';
  var lineCanvas3 = line3.getContext("2d");
  var mainLine3 = new Chart(lineCanvas3, {
    type: 'line',
    data: lineChartData3,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      elements: {
        line: {
            tension: 0.000001
        }
      },
      legend: {
        display: false
      },
      title: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
            color: "#fff",
            offsetGridLines: false
          },
          ticks: {
              fontSize: 10
          }
        }],
        yAxes: [{
          ticks: {
              fontSize: 10
          }
        }]
      },
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 20,
          bottom: 0
        }
      },
      tooltips: {
        mode: 'point',
        intersect: true,
      },
      hover: {
        mode: 'point',
        intersect: true
      }
    }
  });
  document.getElementById('line-3-legend').innerHTML = mainLine3.generateLegend();




  // POINT 1
  var pointChartData1 = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    datasets: [{
      label: 'Dataset 1',
      backgroundColor: "#F95959",
      borderColor: '#F95959',
      borderWidth: 0,
      data: [30,100,80,190,300,240,250,200],
      fill: false,
      pointRadius: 3,
      pointHoverRadius: 8,
      showLine: false // no line shown
    },{
      label: 'Dataset 2',
      backgroundColor: "#FC8E6D",
      borderColor: '#FC8E6D',
      borderWidth: 0,
      data: [80,150,120,250,360,300,320,500],
      fill: false,
      pointRadius: 3,
      pointHoverRadius: 8,
      showLine: false // no line shown
    }]

  };
  var point1 = document.getElementById("point-1");
  point1.style.height = '240px';
  var pointCanvas = point1.getContext("2d");
  var mainPoint = new Chart(pointCanvas, {
    type: 'line',
    data: pointChartData1,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      elements: {
        point: {
            pointStyle: 'circle'
        }
      },
      legend: {
        display: false
      },
      title: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
            color: "#fff",
            offsetGridLines: false
          },
          ticks: {
              fontSize: 10
          }
        }],
        yAxes: [{
          ticks: {
              fontSize: 10
          }
        }]
      },
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 20,
          bottom: 0
        }
      },
      tooltips: {
        mode: 'point',
        intersect: true,
      },
      hover: {
        mode: 'point',
        intersect: true
      }
    }
  });
  document.getElementById('point-1-legend').innerHTML = mainPoint.generateLegend();

};
</script>

@endsection