@extends('layouts.home',['categories'=>$categories])
@section('content')

<div class="inner-pad">

    <div class="cart-order">
        <div class="clearfix mb">
            <h2 class="majors left">Wallet <a href="" class="add-funds">Add Funds &raquo;</a></h2>

            <div class="right balance">{{ number_format($user->wallet_balance,2) }}<span>₦</span> <span
                    class="balance-text">Wallet Balance</span></div>
        </div>

        @if(!isset($wallet_transactions) || $wallet_transactions->count() <= 0)

        <div class="if-no-deal">

            <div class="no-deal"></div>

            <p>You currently have no transactions. Start here &raquo; <a href="" class="add-funds">Add Funds.</a></p>
        </div>

        @else
        <table>
            <tr>
                <th colspan="4">All Time</th>
            </tr>

            @foreach($wallet_transactions as $transaction)
            <tr>
                <td>
                    <span class="trans-source source-bank" title="{{ $transaction->transaction_title }}"></span>
                </td>
                <td class="align-left">{{ $transaction->created_at }}</td>
                <td class="desc-head">34567890DFFC <span class="trans-state verified-trans">Verified</span></td>
                <td class="subby">₦{{ $transaction->transaction_amount }}</td>
            </tr>
            @endforeach
        </table>

        @endif
    </div>

    <br>

</div>

</div>
<!--Add funds-->

<div id="add-funds">
    <div class="funds-holder">

        <h2>Add Funds to Wallet</h2>

        <p>Fund your wallet to purchase discount goods and services. See why we use wallet <a href="">here</a>.</p>

        <input type="text" placeholder="Amount">

        <div class="payment-options clearfix">
            <ul>
                <li class="clearfix">
                    <input type="radio" name="payment" class="paye card-pay">

                    <div class="inter-master"></div>
                </li>

                <li class="clearfix">
                    <input type="radio" name="payment" class="paye visa-pay">

                    <div class="visa"></div>
                </li>

                <li class="clearfix">
                    <input type="radio" name="payment" class="paye paga-pay">

                    <div class="paga"></div>
                </li>

                <li class="clearfix">
                    <input type="radio" name="payment" class="paye bank-pay">

                    <div class="bank">Bank</div>
                </li>
            </ul>

            <div class="bank-pay-details">
                <input type="text" placeholder="Bank">
                <input type="text" placeholder="Transaction No">
            </div>
        </div>

        <input type="submit" value="Continue" class="text-button">

    </div>
</div>
@stop