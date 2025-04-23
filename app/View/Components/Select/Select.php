<?php

namespace App\View\Components\Select;

use Illuminate\View\Component;
use Illuminate\View\View;

class Select extends Component
{
    public array $options;
    public ?string $label;
    public ?string $id;
    public ?string $name;
    public ?string $placeholder;
    public ?string $selected;
    public ?string $appearance;

    public function __construct(
        array $options = [],
        ?string $label = null,
        ?string $id = 'select-menu',
        ?string $name = 'select-menu',
        ?string $placeholder = 'Select an option',
        ?string $selected = null,
        ?string $appearance = 'primary'
    ) {
        $this->options = $options;
        $this->label = $label;
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->selected = $selected;
        $this->appearance = $appearance;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.select.select');
    }
}
