<?php

namespace Mvdnbrk\MyParcel\Resources;

use Mvdnbrk\MyParcel\Types\DeliveryType;
use Mvdnbrk\MyParcel\Types\PackageType;

class ShipmentOptions extends BaseResource
{
    /** @var bool */
    public $age_check;

    /** @var int */
    public $delivery_type;

    /** @var string */
    public $delivery_date;

    /** @var string */
    public $label_description;

    /** @var bool */
    public $large_format;

    /** @var bool */
    public $only_recipient;

    /** @var int */
    public $package_type;

    /** @var bool */
    public $return;

    /** @var bool */
    public $signature;

    /** @var array */
    public $physical_properties;

    public function __construct(array $attributes = [])
    {
        $this->setDefaultOptions();

        parent::__construct($attributes);
    }

    public function setDefaultOptions(): self
    {
        $this->age_check = false;
        $this->return = false;
        $this->signature = false;
        $this->large_format = false;
        $this->package_type = PackageType::PACKAGE;
        $this->delivery_type = DeliveryType::STANDARD;
        $this->only_recipient = false;

        return $this;
    }

    public function getDescriptionAttribute(): string
    {
        return $this->label_description;
    }

    public function setDescriptionAttribute(string $value): void
    {
        $this->label_description = $value;
    }

    public function setPhysicalPropertiesAttribute(array $value): void
    {
        $this->physical_properties = [
            'weight' => $value['weight'],
            'height' => $value['height'],
            'width' => $value['width'],
            'length' => $value['length'],
        ];
    }

    public function toArray(): array
    {
        return collect(parent::toArray())
            ->map(function ($value) {
                if (is_bool($value)) {
                    return (int) $value;
                }

                return $value;
            })
            ->all();
    }
}
