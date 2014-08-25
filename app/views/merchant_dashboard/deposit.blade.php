@extends('layouts.merchant_dashboard')
@section('content')
<div class="merchant-body left clearfix">
    <div class="hold right">
        <div class="clearfix export-header">
            <h1 class="left">Deposits</h1>

            <a href="" class="export right btn">Withdraw Now</a>
        </div>

        <div class="cart-order tableau segment">

            <table>
                <tr>
                    <th>Date Sent</th>
                    <th>ID</th>
                    <th>Coupons</th>
                    <th class="subby">Deposited</th>
                </tr>

                <tr class="trans-pending">
                    <td>Pending</td>
                    <td></td>
                    <td class="align-left"></td>
                    <td class="subby">₦1,000</td>
                </tr>

                <tr>
                    <td>12/08/14</td>
                    <td>34567890DFFC</td>
                    <td class="align-left">3</td>
                    <td class="subby">₦1,000</td>
                </tr>

                <tr>
                    <td>12/08/14</td>
                    <td>34567890DFFC</td>
                    <td class="align-left">3</td>
                    <td class="subby">₦1,000</td>
                </tr>

            </table>
        </div>

    </div>

    <div class="merchant-footer">
        <div class="center">
            &copy; 2014 Couponcity.
            <a href="">Terms</a>
            <a href="">Privacy</a>
            <a href="">Legal</a>
            <a href="">Help</a>
        </div>
    </div>

</div>

<div class="merchant-body right">
    <div class="hold">
        <h2>Your Deposits</h2>

        <p>We payout your cumulative sales amount every Wednesday excluding weekends.</p>

        <p>Let us know if your require any special needs as regards our deposit schedule and we'll be sure to adjust. We
            are trying hard to make deposits happen on next business day for previous day sales.</p>
    </div>
</div>
@stop

