<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class AddLogoFieldsToMerchantsTable extends Migration
    {

        /**
         * Make changes to the table.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('merchants', function (Blueprint $table) {

                $table->string("logo_file_name")->nullable();
                $table->integer("logo_file_size")->nullable();
                $table->string("logo_content_type")->nullable();
                $table->timestamp("logo_updated_at")->nullable();

            });

        }

        /**
         * Revert the changes to the table.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('merchants', function (Blueprint $table) {

                $table->dropColumn("logo_file_name");
                $table->dropColumn("logo_file_size");
                $table->dropColumn("logo_content_type");
                $table->dropColumn("logo_updated_at");

            });
        }

    }