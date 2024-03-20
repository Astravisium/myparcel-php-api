<?php

namespace Mvdnbrk\MyParcel\Resources\Delivery;

class Price {
    public $currency;
    public $amount;

    public function __construct($item) {
        $this->currency = $item['currency'];
        $this->amount = $item['amount'];
    }
}