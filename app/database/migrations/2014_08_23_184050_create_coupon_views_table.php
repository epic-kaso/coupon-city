<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateCouponViewsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('coupon_views', function (Blueprint $table) {
                $table->increments('id');
                $table->string('user_id')->default('guest');
                $table->integer('coupon_id');
                $table->dateTime('view_date');
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
            Schema::drop('coupon_views');
        }

    }
