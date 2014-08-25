<?php

    class CouponCategory extends \Eloquent
    {
        protected $table = 'coupon_categories';

        protected $fillable = ['name', 'slug'];

        public function setNameAttribute($name)
        {
            $this->attributes['name'] = $name;
            $slug = strtolower(url_title($name));
            $similar = static::where('slug', $slug)->first();
            if (!is_null($similar)) {
                $slug = increment_string($slug);
            }
            $this->attributes['slug'] = $slug;
        }

        public function coupons()
        {
            return $this->hasMany('Couponcity\Coupon\Coupon', 'category_id');
        }
    }