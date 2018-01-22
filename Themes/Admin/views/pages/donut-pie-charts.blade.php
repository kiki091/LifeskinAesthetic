@extends('layouts.master')
@section('content')

<div class="main--content" id="app">
    <h3 class="main--content__title">Bar Charts</h3>
    <small class="main--content__desc">Here is the Bar Charts options for you to choose</small>
    
    <div class="grid">
    	<div class="span6">
    		<div class="card">
    			<div class="card--content">
    				<h6 class="bold card--title">DONUT CHART</h6>
    				<div id="donut-legend" class="chart-legend flex center"></div>
    				<div class="chart">
    					<canvas id="donut"></canvas>
    				</div>
    			</div>
    		</div>	
    	</div>
        <div class="span6">
            <div class="card">
                <div class="card--content">
                    <h6 class="bold card--title">PIE CHART</h6>
                    <div id="pie-legend" class="chart-legend flex center"></div>
                    <div class="chart">
                        <canvas id="pie"></canvas>
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

        var configDonut = {
            type: 'doughnut',
            width: 300,
            data: {
                datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: [
                    "#F95959",
                    "#AB2525",
                    "#FC8E6D"
                    ],
                    borderWidth: 0
                }],
                labels: [
                "Legend 1",
                "Legend 2",
                "Legend 3"
                ]
            },
            options: {
                responsive: false,
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Chart.js Doughnut Chart'
                },
                showPercentage: true, //Enables percentages on the pie
                cutoutPercentage: 60,
                percentageInnerCutout: 0,
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                layout: {
                    padding: {
                      left: 0,
                      right: 0,
                      top: 20,
                      bottom: 0
                    }
                },
                pieceLabel: {
                    mode: 'percentage',
                    precision: 0,
                    fontSize: 12,
                    fontColor: '#fff' // set label color
                }
            }
        };
        var id = document.getElementById("donut");
        id.style.height = '300px';
        id.style.width = '300px';
        id.style.margin = 'auto';
        var canvasDonut = id.getContext("2d");
        var donut = new Chart(canvasDonut, configDonut);
        document.getElementById('donut-legend').innerHTML = donut.generateLegend();



        var configPie = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [70, 30],
                    backgroundColor: ["#F95959", "#ca6160"],
                    borderWidth: 0
                }],
                labels: ["Legend 1","Legend 2"]
            },
            options: {
                responsive: false,
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Chart.js Doughnut Chart'
                },
                layout: {
                    padding: {
                      left: 0,
                      right: 0,
                      top: 20,
                      bottom: 0
                    }
                },
                pieceLabel: {
                    mode: 'percentage',
                    precision: 0,
                    fontSize: 12,
                    fontColor: '#fff' // set label color
                }
            }
        };
        var ids = document.getElementById("pie");
        ids.style.height = '300px';
        ids.style.width = '300px';
        ids.style.margin = 'auto';
        var canvasPie = ids.getContext("2d");
        var pie = new Chart(canvasPie, configPie);
        document.getElementById('pie-legend').innerHTML = pie.generateLegend();

    };
</script>
@endsection