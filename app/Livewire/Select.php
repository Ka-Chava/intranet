<?php

namespace App\Livewire;

use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Select extends Component
{
    #[Reactive]
    public array $options;
    #[Modelable]
    #[Reactive]
    public ?string $selected;
    public ?string $label;
    public ?string $id;
    public ?string $name;
    public ?string $placeholder;
    public ?string $appearance;
    public ?string $class;

    public function render()
    {
        return view('livewire.select');
    }
}
