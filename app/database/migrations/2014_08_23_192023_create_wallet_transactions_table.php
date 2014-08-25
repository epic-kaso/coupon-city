<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateWalletTransactionsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('wallet_transactions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('transaction_title');
                $table->text('transaction_description');
                $table->decimal('transaction_amount');
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
            Schema::drop('wallet_transactions');
        }

    }
