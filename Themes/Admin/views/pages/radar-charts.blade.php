@extends('layouts.facile_master')
@section('content')

<div class="main--content" id="app">
    <h3 class="main--content__title">Bar Charts</h3>
    <small class="main--content__desc">Here is the Bar Charts options for you to choose</small>
    
    <div class="grid">
    	<div class="span6">
    		<div class="card">
    			<div class="card--content">
    				<h6 class="bold card--title">RADAR CHART 1</h6>
    				<div id="radar-1-legend" class="chart-legend flex right"></div>
    				<div class="chart">
    					<canvas id="radar-1"></canvas>
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
  var radarChartData1 = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May"],
    datasets: [{
      label: 'Dataset 1',
      backgroundColor: "#f95959",
      borderColor: "#f95959",
      pointBorderColor: "#f95959",
      pointBackgroundColor: "#f95959",
      borderWidth: 1,
      data: [80,50,65,30,90],
      fill: false
    },{
      label: 'Dataset 2',
      backgroundColor: "rgb(0, 128, 0)",
      borderColor: "rgb(0, 128, 0)",
      pointBorderColor: "rgb(0, 128, 0)",
      pointBackgroundColor: "rgb(0, 128, 0)",
      borderWidth: 1,
      data: [30,100,50,16,63],
      fill: false
    },{
      label: 'Dataset 3',
      backgroundColor: "rgb(128, 0, 128)",
      borderColor: "rgb(128, 0, 128)",
      pointBorderColor: "rgb(128, 0, 128)",
      pointBackgroundColor: "rgb(128, 0, 128)",
      borderWidth: 1,
      data: [50,20,45,80,45],
      fill: false
    }]

  };
  var radar1 = document.getElementById("radar-1");
  radar1.style.height = '300px';
  radar1.style.width = '300px';
  radar1.style.margin = 'auto';
  var radarCanvas = radar1.getContext("2d");
  var mainRadar = new Chart(radarCanvas, {
    type: 'radar',
    data: radarChartData1,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      title: {
        display: false
      },
      scale: {
        ticks: {
          beginAtZero: true,
          display: false
        }
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
  document.getElementById('radar-1-legend').innerHTML = mainRadar.generateLegend();

  
};
</script>
@endsection