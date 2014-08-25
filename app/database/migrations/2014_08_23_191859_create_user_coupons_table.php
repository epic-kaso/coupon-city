<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateUserCouponsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('coupon_user', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('coupon_id');
                $table->integer('user_id');
                $table->string('user_coupon_code');
                $table->boolean('has_redeemed');
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
            Schema::drop('coupon_user');
        }

    }
