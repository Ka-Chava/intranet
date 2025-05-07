<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class AddressForm extends Component
{
    public $customerId;
    public $submitted = false;
    public $states = [
        ['value' => 'AL', 'label' => 'Alabama'],
        ['value' => 'AK', 'label' => 'Alaska'],
        ['value' => 'AZ', 'label' => 'Arizona'],
        ['value' => 'AR', 'label' => 'Arkansas'],
        ['value' => 'CA', 'label' => 'California'],
        ['value' => 'CO', 'label' => 'Colorado'],
        ['value' => 'CT', 'label' => 'Connecticut'],
        ['value' => 'DE', 'label' => 'Delaware'],
        ['value' => 'DC', 'label' => 'District Of Columbia'],
        ['value' => 'FL', 'label' => 'Florida'],
        ['value' => 'GA', 'label' => 'Georgia'],
        ['value' => 'HI', 'label' => 'Hawaii'],
        ['value' => 'ID', 'label' => 'Idaho'],
        ['value' => 'IL', 'label' => 'Illinois'],
        ['value' => 'IN', 'label' => 'Indiana'],
        ['value' => 'IA', 'label' => 'Iowa'],
        ['value' => 'KS', 'label' => 'Kansas'],
        ['value' => 'KY', 'label' => 'Kentucky'],
        ['value' => 'LA', 'label' => 'Louisiana'],
        ['value' => 'ME', 'label' => 'Maine'],
        ['value' => 'MD', 'label' => 'Maryland'],
        ['value' => 'MA', 'label' => 'Massachusetts'],
        ['value' => 'MI', 'label' => 'Michigan'],
        ['value' => 'MN', 'label' => 'Minnesota'],
        ['value' => 'MS', 'label' => 'Mississippi'],
        ['value' => 'MO', 'label' => 'Missouri'],
        ['value' => 'MT', 'label' => 'Montana'],
        ['value' => 'NE', 'label' => 'Nebraska'],
        ['value' => 'NV', 'label' => 'Nevada'],
        ['value' => 'NH', 'label' => 'New Hampshire'],
        ['value' => 'NJ', 'label' => 'New Jersey'],
        ['value' => 'NM', 'label' => 'New Mexico'],
        ['value' => 'NY', 'label' => 'New York'],
        ['value' => 'NC', 'label' => 'North Carolina'],
        ['value' => 'ND', 'label' => 'North Dakota'],
        ['value' => 'OH', 'label' => 'Ohio'],
        ['value' => 'OK', 'label' => 'Oklahoma'],
        ['value' => 'OR', 'label' => 'Oregon'],
        ['value' => 'PA', 'label' => 'Pennsylvania'],
        ['value' => 'RI', 'label' => 'Rhode Island'],
        ['value' => 'SC', 'label' => 'South Carolina'],
        ['value' => 'SD', 'label' => 'South Dakota'],
        ['value' => 'TN', 'label' => 'Tennessee'],
        ['value' => 'TX', 'label' => 'Texas'],
        ['value' => 'UT', 'label' => 'Utah'],
        ['value' => 'VT', 'label' => 'Vermont'],
        ['value' => 'VA', 'label' => 'Virginia'],
        ['value' => 'WA', 'label' => 'Washington'],
        ['value' => 'WV', 'label' => 'West Virginia'],
        ['value' => 'WI', 'label' => 'Wisconsin'],
        ['value' => 'WY', 'label' => 'Wyoming'],
    ];

    #[Validate('required', message: 'Please fill in the first name')]
    public $firstName = '';
    #[Validate('required', message: 'Please fill in the last name')]
    public $lastName = '';
    #[Validate('required', message: 'Please fill in the shipping address')]
    public string $address1 = '';
    public $address2 = '';
    #[Validate('required', message: 'Please fill in the city')]
    public $city = '';
    #[Validate('required', message: 'Please select the state')]
    public $provinceCode = '';
    #[Validate('required', message: 'Please fill in the zip')]
    public $zip = '';
    #[Validate('required')]
    public $countryCode = 'US';
    public $setAsDefault = false;

    public function submit()
    {
        $repository = app('shopify.repository');

        $this->validate();

        if (!$this->customerId) {
            $this->addError('general', 'Shopify customer not found');
            return;
        }

        try {
            $addressData = [
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'address1' => $this->address1,
                'address2' => $this->address2,
                'city' => $this->city,
                'provinceCode' => $this->provinceCode,
                'countryCode' => $this->countryCode,
                'zip' => $this->zip,
                'phone' => null,
            ];

            $address = $repository->createAddress($addressData, $this->customerId, $this->setAsDefault);
            $this->dispatch('cart:address', $address->id);
            $this->dispatch('cart:refresh');
            $this->reset();
            $this->dispatch('address-saved');
        } catch (\Exception $e) {
            $this->addError('general', $e->getMessage());
        }
    }

    public function changeProvince($province)
    {
        $this->provinceCode = $province;
    }

    public function render()
    {
        return view('livewire.address-form');
    }
}
