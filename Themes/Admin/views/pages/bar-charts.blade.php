@extends('layouts.master')
@section('content')

<div class="main--content" id="app">
    <h3 class="main--content__title">Bar Charts</h3>
    <small class="main--content__desc">Here is the Bar Charts options for you to choose</small>
    
    <div class="grid">
    	<div class="span6">
    		<div class="card">
    			<div class="card--content">
    				<h6 class="bold card--title">BAR CHART 1</h6>
    				<div id="bar-1-legend" class="chart-legend flex right"></div>
    				<div class="chart">
    					<canvas id="bar-1"></canvas>
    				</div>
    			</div>
    		</div>	
    	</div>
    	<div class="span6">
    		<div class="card">
    			<div class="card--content">
    				<h6 class="bold card--title">BAR CHART <span>Two types of data</span></h6>
    				<div id="bar-2-legend" class="chart-legend flex right"></div>
    				<div class="chart">
    					<canvas id="bar-2"></canvas>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="span6">
    		<div class="card">
    			<div class="card--content">
    				<h6 class="bold card--title">HORIZONTAL STACKED CHART</h6>
    				<div id="bar-3-legend" class="chart-legend flex right"></div>
    				<div class="chart">
    					<canvas id="bar-3"></canvas>
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
    
  // BAR 1
  var barChartData1 = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    datasets: [{
      label: 'Dataset 1',
      backgroundColor: "#f95959",
      borderWidth: 0,
      data: [2478,1267,734,784,433,1500,780]
    }]

  };
  var bar1 = document.getElementById("bar-1");
  bar1.style.height = '240px';
  var barCanvas = bar1.getContext("2d");
  var mainBar = new Chart(barCanvas, {
    type: 'bar',
    data: barChartData1,
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
          barPercentage: 1.0,
          gridLines: {
            display: false,
            color: "#fff",
            offsetGridLines: true
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
  document.getElementById('bar-1-legend').innerHTML = mainBar.generateLegend();

  // BAR 2
  var barChartData2 = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    datasets: [{
      label: 'Dataset 1',
      backgroundColor: "#f95959",
      borderWidth: 0,
      data: [2478,1267,734,784,433,1500,780]
    }, {
      label: 'Dataset 2',
      backgroundColor: "#fd764d",
      borderWidth: 0,
      data: [1000,1567,300,800,433,1100,700]
    }]

  };
  var bar2 = document.getElementById("bar-2");
  bar2.style.height = '240px';
  var barCanvas2 = bar2.getContext("2d");
  var mainBar2 = new Chart(barCanvas2, {
    type: 'bar',
    data: barChartData2,
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
          barPercentage: 1.0,
          gridLines: {
            display: false,
            color: "#fff",
            offsetGridLines: true
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
        mode: 'index',
        intersect: true,
      }
    }
  });
  document.getElementById('bar-2-legend').innerHTML = mainBar2.generateLegend();

  // BAR 3
  var barChartData3 = {
    labels: ["N1", "N2", "N3", "N4"],
    datasets: [{
      label: 'Dataset 1',
      backgroundColor: "#f95959",
      borderWidth: 0,
      data: [2478,1267,734,784]
    }, {
      label: 'Dataset 2',
      backgroundColor: "#fd764d",
      borderWidth: 0,
      data: [1000,1567,300,800]
    }]

  };
  var bar3 = document.getElementById("bar-3");
  bar3.style.height = '240px';
  var barCanvas3 = bar3.getContext("2d");
  var mainBar3 = new Chart(barCanvas3, {
    type: 'horizontalBar',
    data: barChartData3,
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
          barPercentage: 1.0,
          gridLines: {
            display: false,
            color: "#fff",
            offsetGridLines: true
          },
          ticks: {
              fontSize: 10
          }
        }],
        yAxes: [{
          gridLines: {
            display: false
          },
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
        mode: 'index',
        intersect: true,
      }
    }
  });
  document.getElementById('bar-3-legend').innerHTML = mainBar3.generateLegend();

};
</script>
@endsection