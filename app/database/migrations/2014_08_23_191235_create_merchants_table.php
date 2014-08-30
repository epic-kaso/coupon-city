<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateMerchantsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('merchants', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email');
                $table->string('password');
                $table->string('password_reset_token');
                $table->string('business_name');
                $table->string('contact_name');
                $table->text('address_one');
                $table->text('address_two');
                $table->string('city');
                $table->string('state');
                $table->integer('business_category');
                $table->string('mobile_number');
                $table->text('short_description');
                $table->string('website');
                $table->text('opening_hours');
                $table->boolean('is_profile_complete');
                $table->string('bank_name');
                $table->string('account_type');
                $table->string('account_number');
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
            Schema::drop('merchants');
        }

    }
