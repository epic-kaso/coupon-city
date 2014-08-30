<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateAdminSettingsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('admin_settings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('param');
                $table->text('value');
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
            Schema::drop('admin_settings');
        }

    }
