<?php

    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/24/14
     * Time: 9:28 PM
     */
    class CouponCategorySeeder extends Seeder
    {

        public function run()
        {
            CouponCategory::truncate();
            CouponCategory::create([
                'name' => 'Fashion'
            ]);

            CouponCategory::create([
                'name' => 'Electronics'
            ]);

            CouponCategory::create([
                'name' => 'Travel'
            ]);

            CouponCategory::create([
                'name' => 'Food Items'
            ]);
        }
    }