@extends('layouts.layout')
@section('content')
<style>
    #power-gauge g.arc {
		fill: steelblue;
	}

	#power-gauge g.pointer {
		fill: #e85116;
		stroke: #b64011;
	}
	
	#power-gauge g.label text {
		text-anchor: middle;
		font-size: 14px;
		font-weight: bold;
		fill: #666;
	}
  </style>
<!-- <?php //print_r(json_encode($data));?> -->
<div class="main-content">
   <div class="container-fluid mt-4">
      <!-- Table -->
      <div class="row">
         <div class="col">
            <div class="card">
               <div class="card-header">
                  <div class="col-lg-6 col-6 row">
                     <h3 class="col-md-6 mb-0">Models</h3>
                  </div>
                  <!-- <div class="col-lg-6 col-6 text-right">
                     <a href="{{ url('models') }}" class="btn btn-outline-primary">Back to List</a>
                     </div> -->
               </div>
               <!-- 
                  <script src="https://code.highcharts.com/highcharts.js"></script>
                  <script src="https://code.highcharts.com/modules/exporting.js"></script>
                  <script src="https://code.highcharts.com/modules/export-data.js"></script>
                  <script src="https://code.highcharts.com/modules/accessibility.js"></script> -->
               <div class="card-header">
                  <div class="row">
                     <!-- <div class="col-md-6"> -->
                     <!-- 				<figure class="highcharts-figure">
                        <div id="container"></div>
                        
                        </figure> -->
                     <!-- 								<div class="chart">
                        <canvas id="canvas"></canvas>
                        </div> -->
                     <!-- <button id="randomizeData">Randomize Data</button>
                        <button id="addDataset">Add Dataset</button>
                        <button id="removeDataset">Remove Dataset</button>
                        <button id="addData">Add Data</button>
                        <button id="removeData">Remove Data</button> -->
                     <!-- </div>				 -->
                     <div class="col-md-12">
                        <div class="nav-wrapper">
                           <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">Score</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">Risk Score Chart</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">Reference</a>
                              </li>
                           </ul>
                        </div>
                        <div class="card">
                           <div class="card-body">
                              <div class="tab-content" id="myTabContent">
                                 <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                 	<div class="row">
                                 		<div class="col-md-6">
                                 			<div id="riskMeter"></div>
                                 			<div class="input-group">
                                 			   <form id="add-rationale" name="add-rationale" action="{{ url('summary/rationale') }}" method="post" style="width: 100%;">
                                 			      {{ csrf_field() }}
                                 			      <div class="form-group">
                                 			         <div class="input-group">
                                 			            <textarea class="form-control" name="rationale" aria-label="With textarea"></textarea>
                                 			         </div>
                                 			      </div>
                                 			      <input type="hidden" name="summaryId" value="{{$summaryId}}">
                                 			      <button type="submit" class="btn btn-primary">Submit</button>
                                 			   </form>
                                 			</div>
                                 		</div>
                                 		<div class="col-md-6">
		                                    <div class="table-responsive">
		                                       <table class="table align-items-center table-striped" id="riskTable">
		                                          <thead class="thead-light">
		                                             <tr>
		                                                <th scope="col">Risk Type</th>
		                                                <th scope="col">Maximum Wt</th>
		                                                <th scope="col">Actual Score</th>
		                                             </tr>
		                                          </thead>
		                                          <tbody>
		                                             @php 
		                                             $sum=0; 
		                                             @endphp
		                                             @foreach($data as $value)
		                                             <tr>
		                                                <td>{{ $value->name }}</td>
		                                                <td>15</td>
		                                                <td>{{ $value->data }}</td>
		                                             </tr>
		                                             @php
		                                             $sum = $sum + $value->data;
		                                             @endphp
		                                             @endforeach
		                                             <tr>
		                                                <td></td>
		                                                <td>100</td>
		                                                <td>{{ $sum }}</td>
		                                             </tr>
		                                          </tbody>
		                                       </table>
		                                    </div>
	                                    </div>
	                                </div>
                                 </div>
                                 <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                 	<div id="bar_chart" style="width: 100%; height: 500px;"></div>
                                 </div>
                                 <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                 	<div class="row">
                                 		<div class="col-md-12">
		                                    <div class="table-responsive">
		                                       <table class="table align-items-center table-striped" id="myTable">
		                                          <thead class="thead-light">
		                                             <tr>
		                                                <th scope="col">Score</th>
		                                                <th scope="col">Grade</th>
		                                                <th scope="col">Rationale</th>
		                                             </tr>
		                                          </thead>
		                                          <tbody>
		                                             <tr>
		                                                <td>91 and above</td>
		                                                <td>TMF-AAA (Lowest Risk)</td>
		                                                <td>Lowest Risk</td>
		                                             </tr>
		                                             <tr>
		                                                <td>81 to 90</td>
		                                                <td>TMF-AA (Very Low Risk)</td>
		                                                <td>Very Low Risk</td>
		                                             </tr>
		                                             <tr>
		                                                <td>71 to 80</td>
		                                                <td>TMF-A (Low Risk)</td>
		                                                <td>Low Risk</td>
		                                             </tr>
		                                             <tr>
		                                                <td>61 to 70</td>
		                                                <td>TMF-BBB (Moderate Risk)</td>
		                                                <td>Moderate Risk</td>
		                                             </tr>
		                                             <tr>
		                                                <td>51 to 60</td>
		                                                <td>TMF-BB (Medium Risk)</td>
		                                                <td>Medium Risk</td>
		                                             </tr>
		                                             <tr>
		                                                <td>40 to 50</td>
		                                                <td>TMF-B (High Risk)</td>
		                                                <td>High Risk</td>
		                                             </tr>
		                                             <tr>
		                                                <td>21 to 39</td>
		                                                <td>TMF-C (Very High Risk)</td>
		                                                <td>Very High Risk</td>
		                                             </tr>
		                                             <tr>
		                                                <td>0 to 20</td>
		                                                <td>TMF-D (Default Risk)</td>
		                                                <td>Default Risk</td>
		                                             </tr>
		                                          </tbody>
		                                       </table>
		                                    </div>

	                                    </div>
                                	</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- <style type="text/css">
   .highcharts-figure, .highcharts-data-table table {
   	min-width: 310px; 
   	max-width: 800px;
   	margin: 1em auto;
   }
   .highcharts-data-table table {
   	font-family: Verdana, sans-serif;
   	border-collapse: collapse;
   	border: 1px solid #EBEBEB;
   	margin: 10px auto;
   	text-align: center;
   	width: 100%;
   	max-width: 500px;
   }
   .highcharts-data-table caption {
   	padding: 1em 0;
   	font-size: 1.2em;
   	color: #555;
   }
   .highcharts-data-table th {
   	font-weight: 600;
   	padding: 0.5em;
   }
   .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
   	padding: 0.5em;
   }
   .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
   	background: #f8f8f8;
   }
   .highcharts-data-table tr:hover {
   	background: #f1f7ff;
   }
   
   </style>
   <script type="text/javascript">
   Highcharts.chart('container', {
   	chart: {
   		type: 'bar'
   	},
   	title: {
   		text: 'Summary Chart'
   	},
   	subtitle: {
   		text: ''
   	},
   	xAxis: {
   		categories: ['Asset', 'Business', 'Financial', 'Market', 'Profile','Promotor','Repayment'],
   		title: {
   			text: 'Risk Type'
   		}
   	},
   	yAxis: {
   		min: 0,
   		title: {
   			text: 'Weightage',
   			align: 'high'
   		},
   		labels: {
   			overflow: 'justify'
   		}
   	},
   	tooltip: {
   		valueSuffix: ' '
   	},
   	plotOptions: {
   		bar: {
   			dataLabels: {
   				enabled: true
   			}
   		}
   	},
   
   	credits: {
   		enabled: false
   	},
   	series: [{
   		name: 'Asset',
   		data: [107]
   	}, {
   		name: 'Business',
   		data: [133]
   	}, {
   		name: 'Financial',
   		data: [814]
   	}, {
   		name: 'Market',
   		data: [216]
   	},{
   		name: 'Portfolio',
   		data: [133]
   	}, {
   		name: 'Profile',
   		data: [814]
   	}, {
   		name: 'Promotor',
   		data: [1216]
   	},{
   		name: 'Repayment',
   		data: [126]
   	}]
   });
   </script> -->
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.4.2/d3.min.js"></script>
<script>
    var gauge = function (container, configuration) {
  var that = {};
  var config = {
    size: 200,
    clipWidth: 200,
    clipHeight: 110,
    ringInset: 20,
    ringWidth: 20,

    pointerWidth: 10,
    pointerTailLength: 5,
    pointerHeadLengthPercent: 0.9,

    minValue: 0,
    maxValue: 100,

    minAngle: -90,
    maxAngle: 90,

    transitionMs: 750,

    majorTicks: 9,
    labelFormat: d3.format(',g'),
    labelInset: 10,

    arcColorFn: d3.interpolateHsl(d3.rgb('#FF0000'), d3.rgb('#00FF00')) };

  var range = 1-100;
  var r = undefined;
  var pointerHeadLength = undefined;
  var value = 0;

  var svg = undefined;
  var arc = undefined;
  var scale = undefined;
  var ticks = undefined;
  var tickData = undefined;
  var pointer = undefined;

  var donut = d3.layout.pie();

  function deg2rad(deg) {
    return deg * Math.PI / 180;
  }

  function newAngle(d) {
    var ratio = scale(d);
    var newAngle = config.minAngle + ratio * range;
    return newAngle;
  }

  function configure(configuration) {
    var prop = undefined;
    for (prop in configuration) {
      config[prop] = configuration[prop];
    }

    range = config.maxAngle - config.minAngle;
    r = config.size / 2;
    pointerHeadLength = Math.round(r * config.pointerHeadLengthPercent);

    // a linear scale that maps domain values to a percent from 0..1
    scale = d3.scale.linear().
    range([0, 1]).
    domain([config.minValue, config.maxValue]);

    ticks = scale.ticks(config.majorTicks);
    tickData = d3.range(config.majorTicks).map(function () {return 1 / config.majorTicks;});

    arc = d3.svg.arc().
    innerRadius(r - config.ringWidth - config.ringInset).
    outerRadius(r - config.ringInset).
    startAngle(function (d, i) {
      var ratio = d * i;
      return deg2rad(config.minAngle + ratio * range);
    }).
    endAngle(function (d, i) {
      var ratio = d * (i + 1);
      return deg2rad(config.minAngle + ratio * range);
    });
  }
  that.configure = configure;

  function centerTranslation() {
    return 'translate(' + r + ',' + r + ')';
  }

  function isRendered() {
    return svg !== undefined;
  }
  that.isRendered = isRendered;

  function render(newValue) {
    svg = d3.select(container).
    append('svg:svg').
    attr('class', 'gauge').
    attr('width', config.clipWidth).
    attr('height', config.clipHeight);

    var centerTx = centerTranslation();

    var arcs = svg.append('g').
    attr('class', 'arc').
    attr('transform', centerTx);

    arcs.selectAll('path').
    data(tickData).
    enter().append('path').
    attr('fill', function (d, i) {
      return config.arcColorFn(d * i);
    }).
    attr('d', arc);

    var lg = svg.append('g').
    attr('class', 'label').
    attr('transform', centerTx);
    lg.selectAll('text').
    data(ticks).
    enter().append('text').
    attr('transform', function (d) {
      var ratio = scale(d);
      var newAngle = config.minAngle + ratio * range;
      return 'rotate(' + newAngle + ') translate(0,' + (config.labelInset - r) + ')';
    }).
    text(config.labelFormat);

    var lineData = [[config.pointerWidth / 2, 0],
    [0, -pointerHeadLength],
    [-(config.pointerWidth / 2), 0],
    [0, config.pointerTailLength],
    [config.pointerWidth / 2, 0]];
    var pointerLine = d3.svg.line().interpolate('monotone');
    var pg = svg.append('g').data([lineData]).
    attr('class', 'pointer').
    attr('transform', centerTx);

    pointer = pg.append('path').
    attr('d', pointerLine /*function(d) { return pointerLine(d) +'Z';}*/).
    attr('transform', 'rotate(' + config.minAngle + ')').
    attr('onmouseover', 'showTooltip(evt)').
    attr('onmouseout', 'hideTooltip()');

    update(newValue === undefined ? 0 : newValue);
    svg.append('text').attr('class', 'tooltip').
    attr('x', '0').
    attr('y', '0').
    attr('visibility', 'hidden').text('Tooltip');
  }
  that.render = render;

  function update(newValue, newConfiguration) {
    if (newConfiguration !== undefined) {
      configure(newConfiguration);
    }
    var ratio = scale(newValue);
    var newAngle = config.minAngle + ratio * range;
    pointer.transition().
    duration(config.transitionMs).
    ease('elastic').
    attr('transform', 'rotate(' + newAngle + ')');
    var tooltip = d3.select('.tooltip');
    tooltip.text(newValue);
  }
  that.update = update;

  configure(configuration);

  return that;
};

// var twitterGauge = new gauge('#twitterGauge', {
//   size: 300,
//   clipWidth: 300,
//   clipHeight: 300,
//   ringWidth: 60,
//   maxValue: 10,
//   transitionMs: 4000 });

// twitterGauge.render();

var riskMeter = new gauge('#riskMeter', {
  size: 500,
  clipWidth: 500,
  clipHeight: 300,
  ringWidth: 60,
  maxValue: 100,
  transitionMs: 4000 });

riskMeter.render();

function updateReadings() {
  // just pump in random data here...
  twitterGauge.update(Math.random() * 10);
  riskMeter.update(Math.random() * 10);
}

// every few seconds update reading values
// updateReadings();
riskMeter.update(40);
setInterval(function () {
  // updateReadings();
}, 5 * 1000);

function showTooltip(evt) {
  var tooltip = d3.select('.tooltip');
  tooltip.attr('x', evt.clientX - 8);
  tooltip.attr('y', evt.clientY - 5);
  tooltip.attr('visibility', 'visible');
}

function hideTooltip() {
  var tooltip = d3.select('.tooltip');
  tooltip.attr('visibility', 'hidden');
}
  </script>
@endsection