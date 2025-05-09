<?php

namespace App\Data;

use Livewire\Wireable;

class Address extends GraphqlModel implements Wireable
{
    public function __construct(array $raw = [])
    {
        parent::__construct($raw);
    }

    public function toLivewire()
    {
        return $this->raw;
    }

    public static function fromLivewire($value)
    {
        return new self($value);
    }

    public function getAddress1()
    {
        return $this->raw['address1'] ?? null;
    }

    public function getAddress2()
    {
        return $this->raw['address2'] ?? null;
    }

    public function getCity()
    {
        return $this->raw['city'] ?? null;
    }

    public function getCompany()
    {
        return $this->raw['company'] ?? null;
    }

    public function getCountry()
    {
        return $this->raw['country'] ?? null;
    }

    public function getFirstName()
    {
        return $this->raw['firstName'] ?? null;
    }

    public function getLastName()
    {
        return $this->raw['lastName'] ?? null;
    }

    public function getPhone()
    {
        return $this->raw['phone'] ?? null;
    }

    public function getProvince()
    {
        return $this->raw['province'] ?? null;
    }

    public function getZip()
    {
        return $this->raw['zip'] ?? null;
    }

    public function getName()
    {
        return $this->raw['name'] ?? null;
    }

    public function getProvinceCode()
    {
        return $this->raw['provinceCode'] ?? null;
    }

    public function getFormatted()
    {
        return $this->raw['formatted'] ?? [];
    }

    public function getFormattedArea()
    {
        return $this->raw['formattedArea'] ?? null;
    }

    public function getTimeZone()
    {
        return $this->raw['timeZone'] ?? null;
    }
}
