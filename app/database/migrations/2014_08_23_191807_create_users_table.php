<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateUsersTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email');
                $table->string('password');
                $table->string('remember_token', 100)->nullable();
                $table->string('phone');
                $table->string('active');
                $table->boolean('oauth_enabled');
                $table->string('fb_oauth_id');
                $table->boolean('is_profile_complete');
                $table->decimal('wallet_balance',16);
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
            Schema::drop('users');
        }

    }
