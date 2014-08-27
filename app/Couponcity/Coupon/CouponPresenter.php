<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/23/14
     * Time: 8:45 PM
     */

    namespace Couponcity\Coupon;

    use Carbon\Carbon;
    use Laracasts\Presenter\Presenter;

    class CouponPresenter extends Presenter
    {

        public function status()
        {
            switch (strtolower($this->deal_status)) {
                case 'pending':
                    return '<span class="trans-state pending-trans">Pending</span>';
                case 'active':
                    return '<span class="trans-state verified-trans">Active</span>';
                case 'completed':
                    return '<span class="trans-state cancelled-trans">Completed</span>';
                default:
                    return '<span class="trans-state pending-trans">Pending</span>';

            }
        }

        public function creation_date()
        {
            return $this->created_at->toDayDateTimeString();
        }

        public function current_price()
        {
            if (!$this->is_advanced_pricing) {
                return $this->new_price;
            } else {
                return $this->figure_out_price();
            }
        }

        public function current_discount()
        {
            if (!$this->is_advanced_pricing) {
                return $this->discount;
            } else {
                return $this->figure_out_discount();
            }

        }

        public function oldPrice()
        {
            return number_format($this->old_price, 2);
        }

        public function basicNewPrice()
        {
            return number_format($this->new_price, 2);
        }

        public function views_today()
        {
            $today = Carbon::today();
            $tomorrow = $today->tomorrow();

            $views = $this->views->filter(
                function ($entry) use ($today, $tomorrow) {
                    return $entry->created_at >= $today && $entry->created_at < $tomorrow;
                });

            return $views->count();
        }

        public function views_month()
        {
            $today = Carbon::today();
            $monthStart = $today->startOfMonth()->toDateTimeString();
            $monthEnd = $today->endOfMonth()->toDateTimeString();

            $views = $this->views->filter(
                function ($entry) use ($monthStart, $monthEnd) {
                    return $entry->created_at >= $monthStart && $entry->created_at <= $monthEnd;
                });

            return $views->count();
        }

        public function sales_today()
        {
            $today = Carbon::today();
            $tomorrow = $today->tomorrow();

            $views = $this->sales->filter(
                function ($entry) use ($today, $tomorrow) {
                    return $entry->created_at >= $today && $entry->created_at < $tomorrow;
                });

            return $views->count();
        }

        public function sales_month()
        {
            $today = Carbon::today();
            $monthStart = $today->startOfMonth()->toDateTimeString();
            $monthEnd = $today->endOfMonth()->toDateTimeString();

            $views = $this->sales->filter(
                function ($entry) use ($monthStart, $monthEnd) {
                    return $entry->created_at >= $monthStart && $entry->created_at <= $monthEnd;
                });

            return $views->count();
        }

        public function redemption_today()
        {
            $today = Carbon::today();
            $tomorrow = $today->tomorrow();

            $views = $this->redemptions->filter(
                function ($entry) use ($today, $tomorrow) {
                    return $entry->created_at >= $today && $entry->created_at < $tomorrow;
                });

            return $views->count();
        }

        public function redemption_month()
        {
            $today = Carbon::today();
            $monthStart = $today->startOfMonth()->toDateTimeString();
            $monthEnd = $today->endOfMonth()->toDateTimeString();

            $views = $this->redemptions->filter(
                function ($entry) use ($monthStart, $monthEnd) {
                    return $entry->created_at >= $monthStart && $entry->created_at <= $monthEnd;
                });

            return $views->count();
        }

        public function earnings_today()
        {
            $today = Carbon::today();
            $tomorrow = $today->tomorrow();

            $views = $this->sales->filter(
                function ($entry) use ($today, $tomorrow) {
                    return $entry->created_at >= $today && $entry->created_at < $tomorrow;
                });

            $params = $views->toArray();
            $sum = 0;
            foreach ($params as $p) {
                $sum += $p['sales_price'];
            }

            return $sum;

        }

        private function figure_out_price()
        {
            $sales_count = CouponSale::where('coupon_id', $this->id)->count();

            if ($sales_count <= $this->advanced_price_one_quantity) {
                return $this->advanced_price_one_price;
            } elseif ($sales_count <= $this->advanced_price_two_quantity) {
                return $this->advanced_price_two_price;
            } elseif ($sales_count <= $this->advanced_price_three_quantity) {
                return $this->advanced_price_three_price;
            } else {
                return $this->advanced_price_one_price;
            }

        }

        private function figure_out_discount()
        {
            $sales_count = CouponSale::where('coupon_id', $this->id)->count();

            if ($sales_count <= $this->advanced_price_one_quantity) {
                return $this->advanced_price_one_discount;
            } elseif ($sales_count <= $this->advanced_price_two_quantity) {
                return $this->advanced_price_two_discount;
            } elseif ($sales_count <= $this->advanced_price_three_quantity) {
                return $this->advanced_price_three_discount;
            } else {
                return $this->advanced_price_one_discount;
            }
        }

        public function get_sales_commission()
        {
            return 0.2 * $this->current_price();
        }

    }