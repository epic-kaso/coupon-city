<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateCouponsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('coupons', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('tag_line');
                $table->string('summary');
                $table->string('slug');
                $table->text('description');
                $table->decimal('old_price');
                $table->decimal('new_price');
                $table->decimal('discount');
                $table->string('location');
                $table->integer('category_id');
                $table->integer('merchant_id');
                $table->dateTime('start_date');
                $table->dateTime('end_date');
                $table->string('coupon_code');
                $table->boolean('published');
                $table->enum('deal_status', array('active', 'pending', 'complete'))->default('pending');
                $table->integer('quantity');
                $table->boolean('is_advanced_pricing')->default(FALSE);
                $table->decimal('advanced_price_one_price');
                $table->integer('advanced_price_one_quantity');
                $table->decimal('advanced_price_one_discount');
                $table->decimal('advanced_price_two_price');
                $table->integer('advanced_price_two_quantity');
                $table->decimal('advanced_price_two_discount');
                $table->decimal('advanced_price_three_price');
                $table->integer('advanced_price_three_quantity');
                $table->decimal('advanced_price_three_discount');
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
            Schema::drop('coupons');
        }

    }
