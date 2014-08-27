<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?= URL::asset('js/vendor/jquery-1.10.1.min.js') ?>"><\/script>')</script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script src="<?= URL::asset('js/basic.js'); ?>"></script>
<script src="<?= URL::asset('js/modal.js') ?>"></script>
<script src="<?= URL::asset('js/gauge.js') ?>"></script>
<script src="<?= URL::asset('js/waypoints.min.js') ?>"></script>
<script src="<?= URL::asset('js/plugin.min.js') ?>"></script>
<script src="<?= URL::asset('js/countdown.min.js') ?>"></script>
<script src="<?= URL::asset('js/main.js') ?>"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages': ['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Day');
        data.addColumn('number', 'Coupons Sold');
        data.addRows([
            [new Date(2014, 7, 1), 300],
            [new Date(2014, 7, 2), 400],
            [new Date(2014, 7, 3), 500],
            [new Date(2014, 7, 4), 700],
            [new Date(2014, 7, 5), 1000],
            [new Date(2014, 7, 6), 500],
            [new Date(2014, 7, 7), 300],
            [new Date(2014, 7, 8), 400],
            [new Date(2014, 7, 9), 500],
            [new Date(2014, 7, 10), 700],
            [new Date(2014, 7, 11), 1000],
            [new Date(2014, 7, 12), 500],
            [new Date(2014, 7, 13), 700],
            [new Date(2014, 7, 14), 1000],
            [new Date(2014, 7, 15), 300],
            [new Date(2014, 7, 16), 400],
            [new Date(2014, 7, 17), 500],
            [new Date(2014, 7, 18), 400],
            [new Date(2014, 7, 19), 500],
            [new Date(2014, 7, 20), 500],
            [new Date(2014, 7, 21), 700],
            [new Date(2014, 7, 22), 1000],
            [new Date(2014, 7, 23), 500],
            [new Date(2014, 7, 24), 300]
        ]);

        // Set chart options
        var options = {
            'width': 850,
            'height': 350,
            legend: 'none',
            backgroundColor: 'transparent',
            colors: ['#0f75bc'],
            fontSize: 11,
            vAxis: {
                gridlines: {
                    color: '#e8e8e8'
                },
                textStyle: {
                    color: '#999'
                },
                baselineColor: '#f4f4f4'
            },
            hAxis: {
                textStyle: {
                    color: '#999'
                },
                format: 'MMM d',
                gridlines: {
                    color: '#fff'
                },
                baselineColor: 'white'
            },
            chartArea: {
                height: '80%',
                width: '100%',
                left: 80,
                top: 35
            }
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart-div'));
        chart.draw(data, options);
    }
</script>

<!--Put analytics script here-->

</body>
</html>