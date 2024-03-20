<?php

namespace Mvdnbrk\MyParcel\Resources\Delivery;

use Mvdnbrk\MyParcel\Exceptions\InvalidTimeException;

class Time {
    public $start;
    public $end;
    public $price;
    public $price_comment;
    public $comment;
    public $type;

    public function __construct(array $time = []) {
        $this->start = $this->setStart($time['start']);
        $this->end = $this->setEnd($time['end']);
        $this->price = $this->validatePrice(new Price($time['price']));
        $this->price_comment = $time['price_comment'];
        $this->comment = $time['comment'];
        $this->type = $time['type'];
    }

    public function setStart($start) {
        if (preg_match('/^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/', $start)) {
            $this->start = $start;
        } else {
            throw new InvalidTimeException('Invalid start time format. Expected format: 00:00:00');
        }
    }
    
    public function setEnd($end) {
        if (preg_match('/^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/', $end)) {
            $this->end = $end;
        } else {
            throw new InvalidTimeException('Invalid end time format. Expected format: 00:00:00');
        }
    }

    public function validatePrice($price) {
        if (!$price instanceof Price) {
            throw new \InvalidArgumentException('Invalid price format. Expected an instance of'. Price::class). 'but got '. get_class($price). '.';
        }
        return $price;
    }
}