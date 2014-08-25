<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/25/14
     * Time: 12:19 AM
     */

    namespace Couponcity\Coupon;


    use Carbon\Carbon;

    trait TimeSortTrait
    {

        public function today()
        {
            $today = Carbon::today();
            $tomorrow = $today->tomorrow();

            return $this->where('created_at', '>=', $today)->where('created_at', '<', $tomorrow);
        }

        public function thisWeek()
        {
            $today = Carbon::today();
            $weekStart = $today->startOfWeek()->toDateTimeString();
            $weekend = $today->endOfWeek()->toDateTimeString();

            return $this->where('created_at', '>=', $weekStart)->where('created_at', '<=', $weekend);
        }

        public function thisMonth()
        {
            $today = Carbon::today();
            $monthStart = $today->startOfMonth()->toDateTimeString();
            $monthEnd = $today->endOfMonth()->toDateTimeString();

            return $this->where('created_at', '>=', $monthStart)->where('created_at', '<=', $monthEnd);
        }

        public function thisYear()
        {
            $today = Carbon::today();
            $yrStart = $today->startOfYear()->toDateTimeString();
            $yrEnd = $today->endOfYear()->toDateTimeString();

            return $this->where('created_at', '>=', $yrStart)->where('created_at', '<=', $yrEnd);
        }
    }