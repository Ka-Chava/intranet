<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class HelpdeskRequestForm extends Component
{
    use WithFileUploads;

    public $submitted;
    public $request;

    #[Validate('required', message: 'Requester is a required field')]
    public $requester;
    #[Validate('required', message: 'Summary is a required field')]
    public $summary;
    #[Validate('required', message: 'Description is a required field')]
    public $description;
    #[Validate('max:25600')] # 25MB
    public $attachment;

    public function submit()
    {
        $this->validate();
        $this->submitted = true;
    }

    public function clear()
    {
        $this->submitted = false;
        $this->requester = Auth::user()->id;
        $this->summary = null;
        $this->description = null;
        $this->attachment = null;
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function boot()
    {
        $this->submitted = false;
        $this->requester = Auth::user()->id;
    }

    public function render()
    {
        return view('livewire.forms.helpdesk-request-form');
    }
}
