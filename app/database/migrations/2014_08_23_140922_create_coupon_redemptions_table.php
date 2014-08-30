<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateCouponRedemptionsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('coupon_redemptions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->integer('coupon_id');
                $table->decimal('redemption_price');
                $table->decimal('redemption_discount');
                $table->dateTime('redemption_date');
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
            Schema::drop('coupon_redemptions');
        }

    }
