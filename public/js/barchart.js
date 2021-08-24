	google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Actual','Maximum'],
          ['Industry Risk',  -5,      15],
          ['Business Risk',  7,      15],
          ['Promoter Risk',  3.5,      15],
          ['Repayment Risk',  12,      15],
          ['Financial Risk',  0,      15],
          ['Asset Risk',  15,      15],
          ['Political Risk',  10,      15],
        ]);

        var options = {
          title : '',
          width: 1100,
          height: 400,
          vAxis: {title: 'Score'},
          hAxis: {title: 'Risk Type'},
          seriesType: 'bars',
          series: {7: {type: 'line'}},
      	};

        var chart = new google.visualization.ComboChart(document.getElementById('bar_chart'));
        // chart.draw(data, options);
      }