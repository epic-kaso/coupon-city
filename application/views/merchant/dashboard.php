<div class="merchant-body clearfix">
    <div class="hold _dash">

        <div class="clearfix export-header tagline-header">
            <h1 class="left">Dashboard</h1>

            <p>An overview of your Coupon City</p>
        </div>


        <div class="coupon-talk">
            <div class="segment-inner m-b">
                <p class="coupon-price-type">Need Help?</p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus consequat, justo eu sodales mattis, sem ligula mollis nunc, ut fringilla massa urna quis nunc.</p>

            </div>
        </div>

        <div class="clearfix">

            <div class="clearfix">
                <div class="today-details left m-b clearfix">
                    <h4>Today</h4>

                    <div class="wrap-center clearfix">
                        <div class="left sales-guage">

                            <canvas id="sales-guage" style="width: 400px !important; height: 205px !important;"></canvas>

                            <span class="start left" style="margin-left: 10px;">30 <label>Redeem'd</label></span>
                            <span style="margin-left: -10px;">40%</span>
                            <span class="end right">79 <label>Sold</label></span>
                        </div>

                        <div class="left today-sale-numbers">
                            <ul>
                                <li><?= $coupon_stats['views']['total'] ?> <span>Views</span></li>
                                <li><?= $coupon_stats['sales']['total'] ?> <span>Coupons Sold</span></li>
                                <li>₦<?= $coupon_stats['sales']['revenue'] ?> <span>Amount Earned</span></li>
                                <li>₦<?= $coupon_stats['sales']['average'] ?> <span>Average Sale</span></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="coupon-details right m-b">
                    <h4>Top Performing Coupons</h4>

                    <div class="wrap-center">
                        <?php
                        if (is_array($coupon_stats['sales']['top_performing']) && !empty($coupon_stats['sales']['top_performing'])) {
                            foreach ($coupon_stats['sales']['top_performing'] as $value) {
                                ?>
                                <p><span class="trans-state pending-trans"><?= $value->sales_count ?></span>
                                    <label><?= $value->coupon[0]->name ?></label> </p>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="coupon-graph">
                <h4>Total Sales This Month</h4>

                <div id="chart-div"></div>
            </div>

            <div class="coupon-in-numbers m-b">
                <ul class="clearfix">
                    <li class="bbb"><?= $coupon_stats['month_views'] ?> <span>Views</span></li>
                    <li><?= $coupon_stats['month_sales']['sales_count'] ?> <span>Coupons Sold</span></li>
                    <li>₦<?= $coupon_stats['month_sales']['total'] ?> <span>Amount Sold</span></li>
                    <li>₦<?= $coupon_stats['month_sales']['average'] ?> <span>Average Sale</span></li>
                </ul>
            </div>

        </div>

    </div>


    <?php
    echo partial('partials/_merchant_footer', array('year' => time('y')));
    ?>

    <script type="text/javascript">

        $(function () {

            var opts = {
                lines: 12, // The number of lines to draw
                angle: 0.15, // The length of each line
                lineWidth: 0.44, // The line thickness
                pointer: {
                    length: 0.9, // The radius of the inner circle
                    strokeWidth: 0.035, // The rotation offset
                    color: '#000000' // Fill color
                },
                limitMax: true,
                colorStart: '#6FADCF', // Colors
                colorStop: '#0f75bc', // just experiment with them
                strokeColor: '#E0E0E0', // to see which ones work best for you
                generateGradient: true
            };

            var target = document.getElementById('sales-guage'); // your canvas element
            var gauge = new Gauge(target);
            var reach = 1000;
            gauge.setOptions(opts); // create sexy gauge!
            gauge.maxValue = 3000; // set max gauge value
            gauge.animationSpeed = 40; // set animation speed (32 is default value)
            gauge.set(reach);


        });

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


</div>
