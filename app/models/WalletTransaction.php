<?php

    class WalletTransaction extends \Eloquent
    {
        protected $fillable = [];

        protected $table = "wallet_transactions";

        public function user()
        {
            return $this->belongsTo('Couponcity\User\User');
        }
    }