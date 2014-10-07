<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveColumnsOfCouponSalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('coupon_sales', function(Blueprint $table)
		{
			$table->enum('sales_type',['product_purchase','product_reservation']);
		});

		Schema::table('coupons',function(Blueprint $table){
			$table->dropColumn([
				'advanced_price_one_price',
				'advanced_price_one_quantity',
				'advanced_price_one_discount',
				'advanced_price_two_price',
				'advanced_price_two_quantity',
				'advanced_price_two_discount',
				'advanced_price_three_price',
				'advanced_price_three_quantity',
				'advanced_price_three_discount'
			]);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('coupon_sales', function(Blueprint $table)
		{
			$table->dropColumn('sales_type');
		});

		Schema::table('coupons',function(Blueprint $table){
			$table->decimal('advanced_price_one_price');
			$table->integer('advanced_price_one_quantity');
			$table->decimal('advanced_price_one_discount');
			$table->decimal('advanced_price_two_price');
			$table->integer('advanced_price_two_quantity');
			$table->decimal('advanced_price_two_discount');
			$table->decimal('advanced_price_three_price');
			$table->integer('advanced_price_three_quantity');
			$table->decimal('advanced_price_three_discount');
		});
	}

}
