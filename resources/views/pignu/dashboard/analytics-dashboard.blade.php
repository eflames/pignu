<?php
/**
 * Created by PhpStorm.
 * User: eflames
 * Date: 12/12/2016
 * Time: 05:25 PM
 */?>

@if((empty($config['ga_client_id']) or !isset($config['ga_client_id'])) OR (empty($config['ga_view_id']) or !isset($config['ga_view_id'])))

    <div class="alert alert-arrow-left alert-icon-left alert-light-info mb-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
        <b>¡Importante!</b> Para ver las estadísticas de Google necesita configurar las variables <b>ga_client_id</b> y <b>ga_view_id</b>
    </div>

@else

    <div class="Chartjs">
        <h4>Visitas esta semana vs la semana pasada</h4>
        <figure class="Chartjs-figure" id="chart-1-container"></figure>
        <ol class="Chartjs-legend" id="legend-1-container"></ol>
    </div>
    <div class="Chartjs mt-3">
        <h4>Visitas este año vs el año pasado</h4>
        <figure class="Chartjs-figure" id="chart-2-container"></figure>
        <ol class="Chartjs-legend" id="legend-2-container"></ol>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="Chartjs">
            <h4>Top navegadores</h4>
            <figure class="Chartjs-figure" id="chart-3-container"></figure>
            <ol class="Chartjs-legend" id="legend-3-container"></ol>
            </div>
        </div>
        <div class="col-md-6">
            <div class="Chartjs">
            <h4>Top países</h4>
            <figure class="Chartjs-figure" id="chart-4-container"></figure>
            <ol class="Chartjs-legend" id="legend-4-container"></ol>
            </div>
        </div>
    </div>
    <div class="Chartjs mt-4">
        <h4>Top páginas visitadas (últimos 30 dias)</h4>
        <figure class="Chartjs-figure" id="chart-5-container"></figure>
        <ol class="Chartjs-legend" id="legend-5-container"></ol>
    </div>
      
@section('after-scripts')

<script>
    (function(w,d,s,g,js,fs){
      g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
      js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
      js.src='https://apis.google.com/js/platform.js';
      fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
    }(window,document,'script'));
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>      
<script src="{{ asset('analytics/date-range-selector.js') }}"></script>
<script>
    
    gapi.analytics.ready(function() {
        renderWeekOverWeekChart();
        renderYearOverYearChart();
        renderTopBrowsersChart();
        renderTopCountriesChart();
        renderTopPagesChart();

      gapi.analytics.auth.authorize({
        container: 'embed-api-auth-container',
        clientid: '{{ $config['ga_client_id'] }}'
      });


      function renderWeekOverWeekChart() {
    
        // Adjust `now` to experiment with different days, for testing only...
        var now = moment(); // .subtract(3, 'day');
    
        var thisWeek = query({
          'ids': '{{ $config['ga_view_id'] }}',
          'dimensions': 'ga:date,ga:nthDay',
          'metrics': 'ga:sessions',
          'start-date': moment(now).subtract(1, 'day').day(0).format('YYYY-MM-DD'),
          'end-date': moment(now).format('YYYY-MM-DD')
        });
    
        var lastWeek = query({
          'ids': '{{ $config['ga_view_id'] }}',
          'dimensions': 'ga:date,ga:nthDay',
          'metrics': 'ga:sessions',
          'start-date': moment(now).subtract(1, 'day').day(0).subtract(1, 'week')
              .format('YYYY-MM-DD'),
          'end-date': moment(now).subtract(1, 'day').day(6).subtract(1, 'week')
              .format('YYYY-MM-DD')
        });
    
        Promise.all([thisWeek, lastWeek]).then(function(results) {
    
          var data1 = results[0].rows.map(function(row) { return +row[2]; });
          var data2 = results[1].rows.map(function(row) { return +row[2]; });
          var labels = results[1].rows.map(function(row) { return +row[0]; });
    
          labels = labels.map(function(label) {
            return moment(label, 'YYYYMMDD').format('ddd');
          });
    
          var data = {
            labels : labels,
            datasets : [
              {
                label: 'Semana pasada',
                fillColor : 'rgba(220,220,220,0.5)',
                strokeColor : 'rgba(220,220,220,1)',
                pointColor : 'rgba(220,220,220,1)',
                pointStrokeColor : '#fff',
                data : data2
              },
              {
                label: 'Esta semana',
                fillColor : '#6D72C3',
                strokeColor : '#6D72C3',
                pointColor : '#6D72C3',
                pointStrokeColor : '#fff',
                data : data1
              }
            ]
          };
    
          new Chart(makeCanvas('chart-1-container')).Line(data);
          generateLegend('legend-1-container', data.datasets);
        });
      }

      function renderYearOverYearChart() {
    
        // Adjust `now` to experiment with different days, for testing only...
        var now = moment(); // .subtract(3, 'day');
    
        var thisYear = query({
          'ids': '{{ $config['ga_view_id'] }}',
          'dimensions': 'ga:month,ga:nthMonth',
          'metrics': 'ga:users',
          'start-date': moment(now).date(1).month(0).format('YYYY-MM-DD'),
          'end-date': moment(now).format('YYYY-MM-DD')
        });
    
        var lastYear = query({
          'ids': '{{ $config['ga_view_id'] }}',
          'dimensions': 'ga:month,ga:nthMonth',
          'metrics': 'ga:users',
          'start-date': moment(now).subtract(1, 'year').date(1).month(0)
              .format('YYYY-MM-DD'),
          'end-date': moment(now).date(1).month(0).subtract(1, 'day')
              .format('YYYY-MM-DD')
        });
    
        Promise.all([thisYear, lastYear]).then(function(results) {
          var data1 = results[0].rows.map(function(row) { return +row[2]; });
          var data2 = results[1].rows.map(function(row) { return +row[2]; });
          var labels = ['Ene','Feb','Mar','Abr','May','Jun',
                        'Jul','Ago','Sep','Oct','Nov','Dic'];
    
          // Ensure the data arrays are at least as long as the labels array.
          // Chart.js bar charts don't (yet) accept sparse datasets.
          for (var i = 0, len = labels.length; i < len; i++) {
            if (data1[i] === undefined) data1[i] = null;
            if (data2[i] === undefined) data2[i] = null;
          }
    
          var data = {
            labels : labels,
            datasets : [
              {
                label: 'Año pasado',
                fillColor : 'rgba(220,220,220,0.5)',
                strokeColor : 'rgba(220,220,220,1)',
                data : data2
              },
              {
                label: 'Este año',
                fillColor : '#6D72C3',
                strokeColor : '#6D72C3',
                data : data1
              }
            ]
          };
    
          new Chart(makeCanvas('chart-2-container')).Bar(data);
          generateLegend('legend-2-container', data.datasets);
        })
        .catch(function(err) {
          console.error(err.stack);
        });
      }

      function renderTopBrowsersChart() {
    
        query({
          'ids': '{{ $config['ga_view_id'] }}',
          'dimensions': 'ga:browser',
          'metrics': 'ga:pageviews',
          'sort': '-ga:pageviews',
          'max-results': 5
        })
        .then(function(response) {
    
          var data = [];
          var colors = ['#6D72C3','#949FB1','#D4CCC5','#E2EAE9','#9b9ed3'];
    
          response.rows.forEach(function(row, i) {
            data.push({ value: +row[1], color: colors[i], label: row[0] });
          });
    
          new Chart(makeCanvas('chart-3-container')).Doughnut(data);
          generateLegend('legend-3-container', data);
        });
      }
    

      function renderTopCountriesChart() {
        query({
          'ids': '{{ $config['ga_view_id'] }}',
          'dimensions': 'ga:country',
          'metrics': 'ga:sessions',
          'sort': '-ga:sessions',
          'max-results': 5
        })
        .then(function(response) {
    
          var data = [];
          var colors = ['#6D72C3','#949FB1','#D4CCC5','#E2EAE9','#9b9ed3'];
    
          response.rows.forEach(function(row, i) {
            data.push({
              label: row[0],
              value: +row[1],
              color: colors[i]
            });
          });
    
          new Chart(makeCanvas('chart-4-container')).Doughnut(data);
          generateLegend('legend-4-container', data);
        });
      }

      function renderTopPagesChart() {
        var now = moment(); // .subtract(3, 'day');
        var dataChart3 = new gapi.analytics.googleCharts.DataChart({
                query: {
                    'ids': '{{ $config['ga_view_id'] }}',
                    dimensions: 'ga:pageTitle,ga:pagePath',
                    metrics: 'ga:pageviews,ga:uniquePageviews',
                    'start-date': moment(now).subtract(1, 'month').day(0).format('YYYY-MM-DD'),
                    'end-date': moment(now).format('YYYY-MM-DD'),
                    sort: '-ga:pageviews',
                    'max-results': 8
                },
                chart: {
                    container: 'chart-5-container',
                    type: 'TABLE',
                    options: {
                        width: '100%'
                    }
                }
            });

            dataChart3.execute();
      }
    
      /**
       * Extend the Embed APIs `gapi.analytics.report.Data` component to
       * return a promise the is fulfilled with the value returned by the API.
       * @param {Object} params The request parameters.
       * @return {Promise} A promise.
       */
      function query(params) {
        return new Promise(function(resolve, reject) {
          var data = new gapi.analytics.report.Data({query: params});
          data.once('success', function(response) { resolve(response); })
              .once('error', function(response) { reject(response); })
              .execute();
        });
      }

      /**
       * Create a new canvas inside the specified element. Set it to be the width
       * and height of its container.
       * @param {string} id The id attribute of the element to host the canvas.
       * @return {RenderingContext} The 2D canvas context.
       */
      function makeCanvas(id) {
        var container = document.getElementById(id);
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
    
        container.innerHTML = '';
        canvas.width = container.offsetWidth;
        canvas.height = container.offsetHeight;
        container.appendChild(canvas);
    
        return ctx;
      }
    
      /**
       * Create a visual legend inside the specified element based off of a
       * Chart.js dataset.
       * @param {string} id The id attribute of the element to host the legend.
       * @param {Array.<Object>} items A list of labels and colors for the legend.
       */
      function generateLegend(id, items) {
        var legend = document.getElementById(id);
        legend.innerHTML = items.map(function(item) {
          var color = item.color || item.fillColor;
          var label = item.label;
          return '<li><i style="background:' + color + '"></i>' +
              escapeHtml(label) + '</li>';
        }).join('');
      }
    
      // Set some global Chart.js defaults.
      Chart.defaults.global.animationSteps = 60;
      Chart.defaults.global.animationEasing = 'easeInOutQuart';
      Chart.defaults.global.responsive = true;
      Chart.defaults.global.maintainAspectRatio = false;
    
      /**
       * Escapes a potentially unsafe HTML string.
       * @param {string} str An string that may contain HTML entities.
       * @return {string} The HTML-escaped string.
       */
      function escapeHtml(str) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
      }
    
    });
</script>
@stop
@section('after-styles')
<link rel="stylesheet" href="{{ asset('analytics/chartjs-visualizations.css/') }}">
    <style>
        .nose{
            position: relative;
        }
        .gapi-analytics-auth-styles-signinbutton-buttonText {
            padding-left: 6px !important;
        }
    </style>
@stop

@endif