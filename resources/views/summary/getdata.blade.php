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
   .wrapper {
     /*margin: 30px auto;*/
     /*width: 80%;*/
     /*font-family: sans-serif;*/
     /*color: #555;*/
     /*font-size: 14px;*/
     /*line-height: 24px;*/
   }
   ul, ol{
   	list-style: none;
   }
   h1 {
     font-size: 20px;
     font-weight: bold;
     text-align: center;
     text-transform: uppercase;
   }
   h1 + p {
     text-align: center;
     margin: 20px 0;
     font-size: 16px;
   }
   .tabs li {
     float: left;
     width: 50%;
   }
   .tabs a {
     display: block;
     text-align: center;
     text-decoration: none;
     text-transform: uppercase;
     color: #333;
     padding: 20px 0;
     border-bottom: 2px solid #888;
     background: #f7f7f7;
   }
   .tabs a:hover,
   .tabs a.active {
     background: #ddd;
   }
   .tabgroup div {
     padding: 0 10px;
     /*box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);*/
   }
   .clearfix:after {
     content: "";
     display: table;
     clear: both;
   }
   .tabs{background: #ffffff;}
   .tabgroup .row{padding-top: 20px;}
   table.table-fit {
       width: auto !important;
       table-layout: auto !important;
   }
   table.table-fit thead th, table.table-fit tfoot th {
       width: auto !important;
   }
   table.table-fit tbody td, table.table-fit tfoot td {
       width: auto !important;
   }
</style>
<!-- <?php //print_r(json_encode($data));?> -->
<div class="container-fluid mt-4">
	<div class="wrapper">
		<!-- <div id="bar_chart" style="width: 100%; height: 500px;"></div> -->
		<ul class="tabs" data-tabgroup="first-tab-group" style="padding: 0;">
		<li><a href="#tab1" class="active">Risk Meter & Scorecard</a></li>
		<!-- <li><a href="#tab2">Risk Chart</a></li> -->
		<li><a href="#tab3">Reference</a></li>
		</ul>
		<section id="first-tab-group" class="tabgroup">
			<div id="tab1" class="tabs">
				<div class="row" id="capture">
		        <div class="col-md-7">
		           <div id="riskMeter" style="margin: 0 25%;"></div>
               <div id="bar_chart" style="width: 100%; height: 500px;"></div>
		           <!-- <div class="input-group">
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
		           </div> -->
		        </div>
		        <div class="col-md-5">
		           <div class="table-responsive">
		              <table class="table align-items-center table-striped table-fit" id="riskTable">
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
		                       <td>{{ $value->weight }}</td>
		                       <td>{{ $value->data }}</td>
		                    </tr>
		                    @php
		                    $sum = $sum + $value->data;
		                    @endphp
		                    @endforeach
		                    <tr>
		                       <td>Total Score</td>
		                       <td>100</td>
		                       <td>{{ $sum }}</td>
		                    </tr>
		                    <thead class="thead-light">
		                    <tr>
		                       <th>Final Score out of 100</th>
		                       <th colspan="2" class="text-center">{{ $sum }}</th>
		                    </tr>
		                    <tr>
		                       <th>Equivalent Rating</th>
			                    @if ($sum <= 20)
			                       	<th colspan="2" class="text-center">
			                       	TMF-D (Default Risk)
			                       </th>
								@elseif ($sum <= 39)
							    	<th colspan="2" class="text-center">
							    	TMF-C (Very High Risk)
							    	</th>							
							    @elseif ($sum <= 50)
							    	<th colspan="2" class="text-center">
							    	TMF-B (High Risk)
							    	</th>							
							    @elseif ($sum <= 60)
							    	<th colspan="2" class="text-center">
							    	TMF-BB (Medium Risk)
							    	</th>							
							    @elseif ($sum <= 70)
							    	<th colspan="2" class="text-center">
							    	TMF-BBB (Moderate Risk)
							    	</th>							
							    @elseif ($sum <= 80)
							    	<th colspan="2" class="text-center">
							    	TMF-A (Low Risk)
							    	</th>							
							    @elseif ($sum <= 90)
							    	<th colspan="2" class="text-center">
							    	TMF-AA (Very Low Risk)
							    	</th>							
							    @else ($sum <= 39)
							    	<th colspan="2" class="text-center">
							    	TMF-AAA (Lowest Risk)
							    	</th>
								@endif
		                    </tr>
		                	</thead>
		                 </tbody>
		              </table>
		           </div>
		        </div>
		        </div>
		    </div>
		    <div id="tab2" class="tabs">
		    	<div class="row">
		     	<div class="col-md-12">
			     	<!-- <div id="bar_chart" style="width: 100%; height: 500px;"></div> -->
		     	</div>
		     	</div>
		   </div>
		   <div id="tab3" class="tabs">
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
		</section>
	</div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.4.2/d3.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi?.js"></script>
<script type="text/javascript">
	$('.tabgroup > div').hide();
	$('.tabgroup > div:first-of-type').show();
	$('.tabs a').click(function (e) {
	  e.preventDefault();
	  var $this = $(this),
	  tabgroup = '#' + $this.parents('.tabs').data('tabgroup'),
	  others = $this.closest('li').siblings().children('a'),
	  target = $this.attr('href');
	  others.removeClass('active');
	  $this.addClass('active');
	  $(tabgroup).children('div').hide();
	  $(target).show();

	});

	// $("a[href='#tab2']").on('click', function (e) {
	    	google.charts.load('current', {'packages':['corechart']});
	          google.charts.setOnLoadCallback(drawVisualization);

	          function drawVisualization() {
	            // Some raw data (not necessarily accurate)
	            var data = google.visualization.arrayToDataTable([
	            	['Month', 'Actual','Maximum'],
	            	@foreach($data as $value)
	              ['{{ $value->name }}',  {{ $value->data }}, {{ $value->weight }}],
	            	@endforeach
	            ]);

	            var options = {
	              title : '',
	              vAxis: {title: 'Score',gridlines:{color: 'transparent'}},
	              hAxis: {title: 'Risk Type',gridlines:{color: 'transparent'}},
	              seriesType: 'bars',
	              series: {7: {type: 'line'}},
	              colors:['#2771b8','#19237e']
	              // colors: ['red','green','blue','orange'],
	              // is3D:true
	          	};

	            var chart = new google.visualization.ComboChart(document.getElementById('bar_chart'));
	            chart.draw(data, options);
	          }
	// }); 
</script>
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
   size: 350,
   clipWidth: 400,
   clipHeight: 250,
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
   @if($sum < 0)
   riskMeter.update(0);
   @else
   riskMeter.update({{ $sum }});
   @endif
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

   html2canvas(document.querySelector("#riskTable")).then(canvas => {
       var dataURL = canvas.toDataURL('image/jpeg');
       // console.log(dataURL);
       $.ajax({
         type: "POST",
         url: "{{ url('summary/save-image') }}",
         data: { 
           "_token": "{{ csrf_token() }}",
           "summaryId": "{{ $summaryId }}",
           "type": "table",
            imgBase64: dataURL
         }
       }).done(function(o) {
         console.log('saved'); 
       });
       // document.body.appendChild(canvas)
   });

   html2canvas(document.querySelector("#riskMeter")).then(canvas => {
       var meterURL = canvas.toDataURL('image/jpeg');
       // console.log(meterURL);
       $.ajax({
         type: "POST",
         url: "{{ url('summary/save-image') }}",
         data: { 
           "_token": "{{ csrf_token() }}",
           "summaryId": "{{ $summaryId }}",
           "type": "meter",
            imgBase64: meterURL
         }
       }).done(function(o) {
         console.log('saved'); 
       });
       // document.body.appendChild(canvas)
   });

   // var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
   // google.visualization.events.addListener(chart, 'ready', function () {
   //     var imgUri = chart.getImageURI();
   //     // do something with the image URI, like:
   //     console.log(imgUri);
   // });
   // chart.draw(data, {
   //     title:"Daily Sales",
   //     width:500,
   //     height:400,
   //     hAxis: {title: "Daily"}
   // });

</script>
@endsection