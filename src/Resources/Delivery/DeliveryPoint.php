<?php

namespace Mvdnbrk\MyParcel\Resources\Delivery;

use Mvdnbrk\MyParcel\Endpoints\BaseEndpoint;
use Mvdnbrk\MyParcel\Exceptions\InvalidHousenumberException;
use Mvdnbrk\MyParcel\Exceptions\InvalidPostalCodeException;
use Mvdnbrk\MyParcel\Support\Str;

class DeliveryPoint extends BaseEndpoint
{
    public $date;
    public $time;

    public function __construct(array $data) {
        $this->date = $this->validateDate($data['date']);
        $this->time = $this->validateTime(new Time($data['time']));
    }

    private function validateDate($date) {
        $dateTime = \DateTime::createFromFormat('Y-m-d', $date);
        if ($dateTime && $dateTime->format('Y-m-d') === $date) {
            return $date;
        } else {
            throw new \InvalidArgumentException('Invalid date format. Expected format: Y-m-d');
        }
    }

    private function validateTime($time) {
        foreach ($time as $timeObject)
        {
            if (!$timeObject instanceof Time) {
                throw new \InvalidArgumentException('Invalid item in time array. Expected an instance of'. Time::class). 'but got '. get_class($timeObject). '.';
            }
        }
        return $time;
    }
}
