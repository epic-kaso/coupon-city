
<div class="merchant-body left clearfix">
    <div class="hold right">
        <div class="clearfix export-header tagline-header">
            <h1 class="left">Chicken Pie Deal 50% off</h1>
            <a href="" class="export right btn">View Deal</a>

            <p>Italina Spaghetti and Amala with Sauce and Ewedu, 50% 0ff</p>

        </div>

        <div class="clearfix">

            <div class="clearfix">
                <div class="today-details left m-b clearfix">
                    <h4>Today</h4>

                    <div class="wrap-center clearfix">
                        <div class="left sales-guage">

                            <canvas id="sales-guage"></canvas>

                            <span class="start left">30 <label>Redeem'd</label></span>
                            <span style="margin-left: -21px;">40%</span>
                            <span class="end right">79 <label>Sold</label></span>
                        </div>

                        <div class="left today-sale-numbers">
                            <ul>
                                <li>423 <span>Views</span></li>
                                <li>23 <span>Coupons Sold</span></li>
                                <li>₦230,000 <span>Amount Earned</span></li>
                                <li>₦2,300 <span>Average Sale</span></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="coupon-details right m-b">
                    <h4>At a Glance</h4>

                    <div class="wrap-center">
                        <p><label>Deal status:</label> <span class="trans-state verified-trans">Live</span></p>
                        <p><label>Deal status:</label> <span class="trans-state pending-trans">Pending</span></p>
                        <p><label>Deal status:</label> <span class="trans-state cancelled-trans">Completed</span></p>
                        <p><label>Sales cap:</label> 300</p>
                        <p><label>Launch date:</label> Friday 2 July, 2014</p>
                        <p><label>End date:</label> Thursday 11 July, 2014</p>
                        <p><label>Market:</label> Lekki, Lagos</p>
                    </div>
                </div>
            </div>
            
            <div class="coupon-graph">
                <h4>Sales This Month</h4>

                <div id="chart-div"></div>
            </div>

            <div class="coupon-in-numbers m-b">
                <ul class="clearfix">
                    <li class="bbb">200 <span>Views</span></li>
                    <li>20 <span>Coupons Sold</span></li>
                    <li>₦200,000 <span>Amount Sold</span></li>
                    <li>₦100 <span>Average Sale</span></li>
                </ul>
            </div>

            <div class="coupon-talk">

                <p class="view-price"><label>Old Price:</label> ₦3,200</p>

                <div class="segment-inner">
                    <p class="coupon-price-type">This coupon uses Advanced Pricing.</p>

                    <table>

                        <tr>
                            <td>100 Coupons</td>
                            <td>&raquo;</td>
                            <td>28% Discount</td>
                            <td>&raquo;</td>
                            <td class="_coupon-price">₦300</td>
                        </tr>

                        <tr>
                            <td>200 Coupons</td>
                            <td>&raquo;</td>
                            <td>30% Discount</td>
                            <td>&raquo;</td>
                            <td class="_coupon-price">₦200</td>
                        </tr>

                        <tr>
                            <td>300 Coupons</td>
                            <td>&raquo;</td>
                            <td>35% Discount</td>
                            <td>&raquo;</td>
                            <td class="_coupon-price">₦100</td>
                        </tr>
                    </table>

                </div>

                <div class="segment-inner">
                    <p class="coupon-price-type">This coupon uses Basic Pricing.</p>

                    <table>

                        <tr>
                            <td>28% Discount</td>
                            <td>&raquo;</td>
                            <td class="_coupon-price">₦300</td>
                        </tr>
                    </table>

                </div>
                    
                <ul class="cou">
                    <li>
                        <label>Fine print</label>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus consequat, justo eu sodales mattis, sem ligula mollis nunc, ut fringilla massa urna quis nunc. 

                        <p>Curabitur fringilla, dolor eget vulputate porta, leo elit congue lacus, convallis condimentum urna dolor sit amet mi. Sed consectetur viverra odio sed porttitor.</p>
                    </li>

                    <li>
                        <label>Details</label>
                        <p>Curabitur fringilla, dolor eget vulputate porta, leo elit congue lacus, convallis condimentum urna dolor sit amet mi. Sed consectetur viverra odio sed porttitor. </p>
                    </li>

                    <li>
                        <label>Images</label>
                        <ul class="images-preview clearfix">
                            <li><img src="../offers/deal.jpg"></li>
                            <li><img src="../offers/three.jpg"></li>
                            <li><img src="../offers/five.jpg"></li>
                            <li><img src="../offers/two.jpg"></li>
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


<?php
if (property_exists($coupon, 'empty')) {
    ?>
    <div class="span3">
        <!-- COUPON THUMBNAIL -->
        <a href="#" class="coupon-thumb">
            <div class="coupon-inner">
                <h5 class="coupon-title text-center"><?= $coupon->name ?></h5>
            </div>
        </a>
    </div>
<?php } else {
    ?>

    <div class="container">
        <div class = "span6">
            <div id="my-carousel" class="carousel slide">
                <div class="carousel-inner">
                    <?php
                    $index = 0;
                    if (property_exists($coupon, 'coupon_medias') && !empty($coupon->coupon_medias)) {
                        foreach ($coupon->coupon_medias as $media) {
                            ?>
                            <div class = "<?= ($index === 0 ? 'active ' : '') ?>item">
                                <img src = "<?= base_url($media->media_url) ?>" alt = "Image Alternative text" title = "cascada" />
                            </div>
                            <?php
                            $index++;
                        }
                    } else {
                        ?>
                        <div class = "active item">
                            <img src = "<?= base_url('assets/images/no_image.png') ?>" alt = "Image Alternative text" title = "cascada" />
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                if ($index > 1) {
                    ?>
                    <a class="carousel-control left" href="#my-carousel" data-slide="prev"></a>
                    <a class="carousel-control right" href="#my-carousel" data-slide="next"></a>
                <?php } ?>
            </div>

            <div class="coupon-inner">
                <h5 class="coupon-title"><?= $coupon->name ?></h5>
                <p class="coupon-desciption"><?= $coupon->summary ?></p>
                <div class="coupon-meta">
                    <table>
                        <tr>
                            <td><p>Coupon Code:</p></td>
                            <td><h5><?= $coupon->coupon_code; ?></h5></td>
                        </tr>
                        <tr>
                            <td><p>Deal Status:</p></td>
                            <td><h5><?= $coupon->deal_status == 1 ? 'Active' : 'Inactive'; ?></h5></td>
                        </tr>
                        <tr>
                            <td><p>Sales Count:</p></td>
                            <td><h5><?= $coupon->sales_count ?></h5></td>
                        </tr>
                        <tr>
                            <td><p>View Count:</p></td>
                            <td><h5><?= $coupon->view_count ?></h5></td>
                        </tr>
                        <tr>
                            <td><p>Redemption Count:</p></td>
                            <td><h5><?= $coupon->redemption_count ?></h5></td>
                        </tr>
                    </table>
                    <span class="coupon-time"><?= $coupon->remaining ?></span>
                    <span class="coupon-save">Save <?= $coupon->discount ?>%</span>
                    <div class="coupon-price">
                        <span class="coupon-old-price">₦<?= $coupon->old_price ?></span>
                        <span class="coupon-new-price">₦<?= $coupon->new_price ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <p><?= $coupon->description ?></p>
        </div>
    </div>
    <?php
}
?>

<!-- Google charts -->

<script type="text/javascript">

    $(function() {
        
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
            colorStart: '#6FADCF',   // Colors
            colorStop: '#0f75bc',    // just experiment with them
            strokeColor: '#E0E0E0',   // to see which ones work best for you
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
  google.load('visualization', '1', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.setOnLoadCallback(drawChart);

  function drawChart() {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('date', 'Day');
    data.addColumn('number', 'Coupons Sold');
    data.addRows([
        [new Date(2014, 7, 1),  300],
        [new Date(2014, 7, 2),  400],
        [new Date(2014, 7, 3),  500],
        [new Date(2014, 7, 4),  700],
        [new Date(2014, 7, 5),  1000],
        [new Date(2014, 7, 6),  500],
        [new Date(2014, 7, 7),  300],
        [new Date(2014, 7, 8),  400],
        [new Date(2014, 7, 9),  500],
        [new Date(2014, 7, 10),  700],
        [new Date(2014, 7, 11),  1000],
        [new Date(2014, 7, 12),  500],
        [new Date(2014, 7, 13),  700],
        [new Date(2014, 7, 14),  1000],
        [new Date(2014, 7, 15),  300],
        [new Date(2014, 7, 16),  400],
        [new Date(2014, 7, 17),  500],
        [new Date(2014, 7, 18),  400],
        [new Date(2014, 7, 19),  500],
        [new Date(2014, 7, 20),  500],
        [new Date(2014, 7, 21),  700],
        [new Date(2014, 7, 22),  1000],
        [new Date(2014, 7, 23),  500],
        [new Date(2014, 7, 24),  300]
    ]);

    // Set chart options
    var options = {
        'width':610,
        'height':330,
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
            format:'MMM d',
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
