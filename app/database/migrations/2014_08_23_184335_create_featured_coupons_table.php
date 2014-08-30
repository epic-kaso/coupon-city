<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateFeaturedCouponsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('featured_coupons', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('coupon_id');
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
            Schema::drop('featured_coupons');
        }

    }
