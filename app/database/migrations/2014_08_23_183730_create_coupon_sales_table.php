<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateCouponSalesTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('coupon_sales', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->integer('coupon_id');
                $table->decimal('sales_price');
                $table->decimal('sales_commission');
                $table->dateTime('sales_date');
                $table->timestamps();
            });
        }


        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::drop('coupon_sales');
        }

    }
