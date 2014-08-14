<div class="merchant-body left clearfix">
    <div class="hold right">
        <div class="clearfix export-header tagline-header">
            <h1 class="left"><?= $coupon->name ?></h1>
            <a href="<?= base_url('coupon/' . $coupon->slug) ?>" class="export right btn">View Deal</a>

            <p><?= $coupon->tag_line ?></p>

        </div>

        <div class="clearfix">

            <div class="clearfix">
                <div class="today-details left m-b clearfix">
                    <h4>Today</h4>

                    <div class="wrap-center clearfix">
                        <div class="left sales-guage">

                            <canvas id="sales-guage"></canvas>

                            <span class="start left"><?= $coupon->redemption_count ?> <label>Redeem'd</label></span>
                            <span style="margin-left: -21px;">40%</span>
                            <span class="end right"><?= $coupon->sales_count ?> <label>Sold</label></span>
                        </div>

                        <div class="left today-sale-numbers">
                            <ul>
                                <li><?= $coupon->today_views ?> <span>Views</span></li>
                                <li><?= $coupon->today_sales ?> <span>Coupons Sold</span></li>
                                <li>₦<?= $coupon->today_earnings ?> <span>Amount Earned</span></li>
                                <li>₦<?= $coupon->today_average ?> <span>Average Sale</span></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="coupon-details right m-b">
                    <h4>At a Glance</h4>

                    <div class="wrap-center">
                        <?= $coupon->deal_status == 1 ? 'Active' : 'Inactive'; ?>
                        <?php
                        switch ($coupon->deal_status) {
                            case 1:
                                ?>
                                <p><label>Deal status:</label> <span class="trans-state verified-trans">Live</span></p>
                                <?php
                                break;
                            case 0:
                                ?>
                                <p><label>Deal status:</label> <span class="trans-state pending-trans">Pending</span></p>
                                <?php
                                break;
                            default:
                                ?>
                                <p><label>Deal status:</label> <span class="trans-state cancelled-trans">Completed</span></p>
                        <?php }
                        ?>
                        <p><label>Sales cap:</label> <?= $coupon->quantity ?></p>
                        <p><label>Launch date:</label> <?= $coupon->start_date ?></p>
                        <p><label>End date:</label> <?= $coupon->end_date ?></p>
                        <p><label>Market:</label> <?= $coupon->location ?></p>
                    </div>
                </div>
            </div>

            <div class="coupon-graph">
                <h4>Sales This Month</h4>

                <div id="chart-div"></div>
            </div>

            <div class="coupon-in-numbers m-b">
                <ul class="clearfix">
                    <li class="bbb"><?= $coupon->month_views ?> <span>Views</span></li>
                    <li><?= $coupon->month_sales ?> <span>Coupons Sold</span></li>
                    <li>₦<?= $coupon->month_earnings ?> <span>Amount Sold</span></li>
                    <li>₦<?= $coupon->month_average ?> <span>Average Sale</span></li>
                </ul>
            </div>

            <div class="coupon-talk">

                <p class="view-price"><label>Old Price:</label> ₦<?= $coupon->old_price ?> </p>
                <?php if ($coupon->is_advanced_pricing == 1 || $coupon->is_advanced_pricing) { ?>
                    <div class="segment-inner">
                        <p class="coupon-price-type">This coupon uses Advanced Pricing.</p>

                        <table>

                            <?php foreach ($coupon->advanced_pricing as $row) { ?>
                                <tr>
                                    <td><?= $row->count ?> Coupons</td>
                                    <td>&raquo;</td>
                                    <td><?= $row->discount ?>% Discount</td>
                                    <td>&raquo;</td>
                                    <td class="_coupon-price">₦<?= $row->price ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>

                    </div>
                <?php } else { ?>

                    <div class="segment-inner">
                        <p class="coupon-price-type">This coupon uses Basic Pricing.</p>

                        <table>

                            <tr>
                                <td><?= $coupon->discount ?>% Discount</td>
                                <td>&raquo;</td>
                                <td class="_coupon-price">₦<?= $coupon->new_price ?></td>
                            </tr>
                        </table>

                    </div>
                <?php } ?>

                <ul class="cou">
                    <li>
                        <label>Fine print</label>
                        <p><?= $coupon->summary ?></p>
                    </li>

                    <li>
                        <label>Details</label>
                        <p><?= $coupon->description ?></p>
                    </li>

                    <li>
                        <label>Images</label>
                        <ul class="images-preview clearfix">
                            <?php
                            if (property_exists($coupon, 'coupon_medias') && !empty($coupon->coupon_medias)) {
                                foreach ($coupon->coupon_medias as $media) {
                                    ?>
                                    <li style="display: inline-block">
                                        <a href="">
                                            <img height="80" width="80" src="<?= base_url($media->media_url) ?>" alt = "Image Alternative text" title = "cascada" />
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                </ul>


            </div>

            <br/>
            <br/>

        </div>


    </div>

    <?php
    echo partial('partials/_merchant_footer', array('year' => time('y')));
    ?>

    <div class="merchant-body right">
        <div class="hold">
            <h2>Coupon Details</h2>
            <p>We payout your cumulative sales amount every Wednesday excluding weekends.</p>
            <p>Let us know if your require any special needs as regards our deposit schedule and we'll be sure to adjust. We are trying hard to make deposits happen on next business day for previous day sales.</p>
        </div>
    </div>

    <!-- Google charts -->

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
                'width': 610,
                'height': 330,
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
                    top: 30
                }
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ColumnChart(document.getElementById('chart-div'));
            chart.draw(data, options);
        }
    </script>
